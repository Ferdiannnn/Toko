<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function index()
    {
        $cart = Cart::with('produk')->get();
        $produk = Produk::all();
        return view('cart', ['cart' => $cart], ['produks' => $produk]);
    }



    public function store(Request $request, $id)
    {
        $cart = Cart::where('user_id', Auth::user()->id)->where('produk_id', $id)->first();
        if ($cart) {
            $cart->increment('jumlah');
        } else {
            Cart::create([
                'user_id' => Auth::user()->id,
                'produk_id' => $id,
                'jumlah' => 1
            ]);
        }
        return redirect('/');
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        if ($cart) {
            Session::flash('status', 'success');
            Session::flash('message', 'Deleted successfully ');
        }

        return redirect('/cart');
    }
}