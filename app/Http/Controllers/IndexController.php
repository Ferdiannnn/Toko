<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('home', ['produklist' => $produk]);
    }


}