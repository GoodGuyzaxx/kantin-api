<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isEmpty;

class OrderPaymentController extends Controller
{
    public function showOrderId($id)
    {
        $dbOrder = DB::table('orders')
            ->where('id',$id)
            ->first();
        if (!$dbOrder){
            return response([
                'success' => false,
                'message' => 'Data Tidak di Temukan'
            ],404);
        } else {
            return response()->json([
                'success' => true,
                'messsage' => 'Berhasil Mengambil Data',
                'data' => $dbOrder
            ],200);
        }
    }
    public function buy(Request $request){

        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
           'name'           => 'required',
           'nama_kantin'    => 'required',
           'email'          => 'required|email',
            'total_harga'   => 'required'
//            'bank' => 'required|in:bca,bni',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors(),
            ]);
        }

//        $makanan=DB::table('menu_makanans')
//            ->where('id_makanan', $request->get('id_makanan'))
//            ->first();
//        if (!$makanan || !isset($makanan->id_makanan)) {
//            return response()->json([
//                'message' => 'Makanan tidak ditemukan',
//                'data'  => ['Makanan Tidak ada di database']
//            ],422);
//        }
//
//        $minuman=DB::table('menu_minumen')
//            ->where('id_minuman', $request->get('id_minuman'))
//            ->first();
//        if (!$minuman || !isset($minuman->id_minuman)){
//            return response()->json([
//                'message' => 'minuman tidak ditemukan',
//                'data'  => ['minuman Tidak ada di database']
//            ],422);
//        } elseif ($minuman->stock == 0 )

        try {
            DB::beginTransaction();
            $serverKey = config('midtrans.key');

            $orderID = $request->order_id;
//            $totalMakanan = $makanan->harga * $request->total_makanan;
//            $totalMinuman = $minuman->harga * $request->total_minuman;
//
            $grossAmount = $request->total_harga;


             $response = Http::withBasicAuth($serverKey, '')
                 ->post('https://api.sandbox.midtrans.com/v2/charge', [
                     'payment_type'         => 'gopay',
                     'transaction_details'  => [
                         'order_id'     => $orderID,
                         'gross_amount' => $grossAmount
                     ],
                     'customer_details' => [
                         'first_name' => $request->nama_kantin,
                         'last_name' => $request->name,
                         'email' => $request->email
                     ],
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
                'total_amount' => $grossAmount,
                'status' => 'Pending',
                'created_at' => now(),
            ]);

             //TODO Penurangan Stock Pada Menu Makan dan Jga Concuring Ketika APlikasi dilakukan Secara Bersamaan
//            DB::table('menu_makanans')->where('id_makanan', $makanan->id_makanan)->update([
//                'stock' => $makanan->stock - $request->total_makanan,
//            ]);
//
//            DB::table('menu_minumen')->where('id_minuman', $minuman->id_minuman)->update([
//                'stock' => $minuman->stock - $request->total_minuman,
//            ]);


            DB::commit();

            return response()->json($response->json());
        }catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getByEmail($email){
        $data = DB::table('orders')
            ->where('email', $email)
            ->get();
        return response()->json([
            'data' => $data
        ]);
    }
}
