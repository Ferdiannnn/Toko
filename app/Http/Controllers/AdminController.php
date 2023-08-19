<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Produk;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('Admin/index');
    }

    public function akun()
    {
        $admin = Produk::all();
        return view('Admin/admin-akun', ['admin' => $admin]);
    }

    public function item()
    {
        $item = Item::all();
        return view('Admin/admin-item', ['item' => $item]);
    }
}