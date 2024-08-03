<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderPaymentController extends Controller
{
    public function buy(Request $request){

        $validator = Validator::make($request->all(), [
           'name' => 'required',
           'email' =>  'required|email',
            'total' => 'required|int',
            'id_makanan' => 'required',
//            'bank' => 'required|in:bca,bni',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors(),
            ]);
        }

        $makanan=DB::table('menu_makanans')
            ->where('id', $request->get('id_makanan'))
            ->first();
        if (!$makanan){
            return response()->json([
                'message' => 'Makanan tidak ditemukan',
                'data'  => ['Makanan Tidak ada di database']
            ],422);
        }

        try {
            DB::beginTransaction();
            $serverKey = config('midtrans.key');

            $orderID = Str::uuid()->toString();
            $grossAmount = $makanan->harga * $request->total + 500;


             $response = Http::withBasicAuth($serverKey, '')
                 ->post('https://api.sandbox.midtrans.com/v2/charge', [
                     'payment_type'         => 'gopay',
                     'transaction_details'  => [
                         'order_id'     => $orderID,
                         'gross_amount' => $grossAmount
                     ],
//                     'bank_transfer' => [
//                         'bank' => $request->bank
//                     ]
                 ]);

             if ($response->failed()) {
                 return response()->json([
                     'message' => 'faild charge'
                 ],500);
             }
             $result = $response->json();
             if ($result['status_code'] != 201){
                 return response()->json([
                     'message' => $result['status_message']
                 ],500);
             }

            DB::table('orders')->insert([
                'id' => $orderID,
                'nama' => $request->name,
                'email' => $request->email,
                'id_makanan' => $makanan->id,
                'total_amount' => $grossAmount,
                'status' => 'Pending',
                'created_at' => now(),
            ]);

             //TODO Penurangan Stock Pada Menu Makan dan Jga Concuring Ketika APlikasi dilakukan Secara Bersamaan
            DB::table('menu_makanans')->where('id', $makanan->id)->update([
                'stock' => $makanan->stock - $request->total,
            ]);


            DB::commit();

            return response()->json($response->json());
        }catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
