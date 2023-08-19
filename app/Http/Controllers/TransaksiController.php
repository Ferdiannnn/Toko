<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\SaldoController;

class TransaksiController extends Controller
{
    public function transaksi()
    {

        $balances = Saldo::with('user')->get();
        $transaksi = Transaction::with('produk')->get();
        return view('transaksi', ['transaksi' => $transaksi, 'balances' => $balances]);
    }
}