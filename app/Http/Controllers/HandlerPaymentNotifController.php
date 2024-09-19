<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PaymentHistory;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Testing\Fluent\Concerns\Has;
use phpseclib3\Crypt\Hash;

class HandlerPaymentNotifController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $payload = $request->all();

        Log::info('incoming-midtrans', [
            'payload' => $payload
        ]);

        $orderId = $payload['order_id'];
        $statusCode = $payload['status_code'];
        $grossAmount = $payload['gross_amount'];

        $reqSignatureKey = $payload['signature_key'];

        $signature = hash('sha512', $orderId.$statusCode.$grossAmount.config('midtrans.key'));

        if($signature != $reqSignatureKey) {
            return response()->json([
                'message' => 'invalid signature'
            ],401);
        }

        $transactionStatus = $payload['transaction_status'];

        PaymentHistory::create([
            'order_id' => $orderId,
            'status' => $transactionStatus,
            'payload' => json_encode($payload)
        ]);

        $order = Order::find($orderId);
        if (!$order) {
            return response()->json([
                'message' => 'invalid Oreder'
            ],400);
        }

        $transaksi = DB::table('transaksis')
            ->where('id_order', $orderId)
            ->first();

        if (!$transaksi) {
            return response()->json([
                'message' => 'Invalid Order'
            ], 400);
        }

        if ($transactionStatus == 'settlement') {
            $order->status = 'Paid';
            $order->save();

            DB::table('transaksis')
                ->where('id_order', $orderId)
                ->update(['status_pembayaran' => 'Paid']);
        } else if ($transactionStatus == 'expire') {
            $order->status = 'Expired';
            $order->save();

            DB::table('transaksis')
                ->where('id_order', $orderId)
                ->update(['status_pembayaran' => 'Expired']);
        } else if ($transactionStatus == 'cancel') {
            $order->status = 'Cancel';
            $order->save();
            DB::table('transaksis')
                ->where('id_order', $orderId)
                ->update(['status_pembayaran' => 'Batal']);
        }

        return response()->json([
            'message' => 'Success'
        ]);
    }
}
