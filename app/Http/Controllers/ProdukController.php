<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Katagori;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\ProdukRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PembayaranController;


class ProdukController extends Controller
{
    public function index()
    {
        $kategori = Katagori::all();
        return view('produk', ['kategori' => $kategori]);
    }

    public function store(ProdukRequest $request)
    {
        $produk = Produk::create($request->all());
        if ($request->hasFile('Gambar')) {
            $name = $request->file('Gambar')->storeAs('Gambar', $request->Judul . '-' . $request->user_id . '-' . now()->timestamp . '-' . $request->file('Gambar')->getClientOriginalName());
            $produk->Gambar = $request->Judul . '-' . $request->user_id . '-' . now()->timestamp . '-' . $request->file('Gambar')->getClientOriginalName();
            $produk->save();
        }
        if ($produk) {
            Session::flash('status', 'success');
            Session::flash('message', 'account successfully added');
        }

        return redirect('/admin-akun');

    }

    public function detail($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk-detail', ['produk' => $produk]);
    }

    public function edit(Request $request, $id)
    {
        $produk = Produk::with('kategori')->findOrFail($id);
        $kategori = Katagori::with('namakategori')->get();
        return view('produk-edit', ['produk' => $produk, 'kategori' => $kategori]);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->update($request->all());
        if ($request->hasFile('Gambar')) {
            $name = $request->file('Gambar')->storeAs('Gambar', $request->Judul . '-' . $request->user_id . '-' . now()->timestamp . '-' . $request->file('Gambar')->getClientOriginalName());
            $produk->Gambar = $request->Judul . '-' . $request->user_id . '-' . now()->timestamp . '-' . $request->file('Gambar')->getClientOriginalName();
            $produk->save();
        }
        if ($produk) {
            Session::flash('status', 'success');
            Session::flash('message', 'produk successfully added');
        }

        return redirect('/');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        if ($produk) {
            Session::flash('status', 'success');
            Session::flash('message', 'account successfully deleted');
        }

        return redirect('/admin-akun');
    }

    public function checkout($id)
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
        $produk = Produk::findOrFail($id);
        return view('payment', ['produk' => $produk, 'channel' => $channel]);
    }

    public function store_payment(Request $request)
    {
        $produk = Produk::findOrFail($request->produk_id);
        $apiKey = env('TRIPAY_API_KEY');
        $privateKey = env('TRIPAY_PRIVATE_KEY');
        $merchantCode = env('TRIPAY_MERCHANT_CODE');
        $merchantRef = 'FV.' . time();
        $user = auth()->user();
        $data = [

            'method' => $request->method_id,
            'merchant_ref' => $merchantRef,
            'amount' => $produk->Harga,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'order_items' => [
                [
                    'name' => $produk->Judul,
                    'price' => $produk->Harga,
                    'quantity' => 1,
                    'product_url' => 'https://tokokamu.com/product/nama-produk-1',
                    'image_url' => 'https://tokokamu.com/product/nama-produk-1.jpg',
                ],
            ],
            'expired_time' => (time() + (24 * 60 * 60)),
            // 24 jam
            'signature' => hash_hmac('sha256', $merchantCode . $merchantRef . $produk->Harga, $privateKey)
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
            'produk_id' => $produk->id,
            'reference' => json_decode($response)->data->reference,
            'merchent_ref' => json_decode($response)->data->merchant_ref,
            'total_amount' => $produk->Harga,
            'status' => json_decode($response)->data->status,
        ]);

        return redirect()->route('detail_payment.detail_payment', ['reference' => json_decode($response)->data->reference]);
    }

    public function detail_payment($reference)
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
        return view('detail-payment', ['response' => $response]);
    }

}