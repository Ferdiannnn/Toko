<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Models\Saldotopup;
use App\Models\Transaction;
use Illuminate\Http\Request;

class SaldoController extends Controller
{
    public function index()
    {

        $saldo = Saldotopup::all();
        return view('Finance.saldo', ['saldo' => $saldo]);
    }

    public function getPaymentChannel($id)
    {
        $apiKey = env('TRIPAY_API_KEY');

        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_FRESH_CONNECT => true,
                CURLOPT_URL => 'https://tripay.co.id/api-sandbox/merchant/payment-channel',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $apiKey],
                CURLOPT_FAILONERROR => false,
                CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4
            )
        );

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);
        $channel = json_decode($response)->data;

        $saldo = Saldotopup::findOrFail($id);

        return view('Finance.saldochannel', ['channel' => $channel, 'saldo' => $saldo]);
    }

    public function getRequestTransaction(Request $request)
    {
        $saldo = Saldotopup::findOrFail($request->id);

        $apiKey = env('TRIPAY_API_KEY');
        $privateKey = env('TRIPAY_PRIVATE_KEY');
        $merchantCode = env('TRIPAY_MERCHANT_CODE');
        $merchantRef = 'FV-' . time();

        $user = auth()->user();
        $data = [
            'method' => $request->method_id,
            'merchant_ref' => $merchantRef,
            'amount' => $saldo->Harga,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'order_items' => [
                [
                    'name' => $saldo->Judul,
                    'price' => $saldo->Harga,
                    'quantity' => 1,
                    'product_url' => 'https://tokokamu.com/product/nama-produk-1',
                    'image_url' => 'https://tokokamu.com/product/nama-produk-1.jpg',
                ],
            ],
            'expired_time' => (time() + (24 * 60 * 60)),
            // 24 jam
            'signature' => hash_hmac('sha256', $merchantCode . $merchantRef . $saldo->Harga, $privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_URL => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4
        ]);



        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        Transaction::create([
            'user_id' => $user->id,
            'produk_id' => 10,
            'reference' => json_decode($response)->data->reference,
            'merchent_ref' => json_decode($response)->data->merchant_ref,
            'total_amount' => $saldo->Harga,
            'status' => json_decode($response)->data->status,
        ]);

        return redirect()->route('detail_payment', ['reference' => json_decode($response)->data->reference]);
    }

    public function getDetailTransaction($reference)
    {
        $apiKey = env('TRIPAY_API_KEY');

        $payload = ['reference' => $reference];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_URL => 'https://tripay.co.id/api-sandbox/transaction/detail?' . http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR => false,
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response)->data;
        if ($response && isset($response->data)) {
            $status = strtoupper($response->data->status);

            // Update status in your database based on $status
            $transaction = Transaction::where('reference', $reference)->first();

            if ($transaction) {
                $transaction->update(['status' => $status]);
            }
        } else {
            // Handle error or invalid response from Tripay
            // You can log an error or take appropriate actions
        }


        $user = auth()->user();
        $transaksi = Transaction::where('reference', $response->reference)->first();
        if ($transaksi->status == 'PAID') {
            $saldo = Saldo::where('user_id', $user->id)->first();
            $saldo->update([
                'saldo' => $saldo->saldo + $transaksi->total_amount
            ]);
            return redirect()->route('transaksi')->withHeader('Refresh', '10')->with('success', 'Topup ' . $transaksi->total_amount . ' Berhasil');


        }
        return view('detail-payment', ['response' => $response]);
    }


}