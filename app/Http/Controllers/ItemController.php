<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Katagori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
    public function index()
    {
        $kategori = Katagori::all();
        return view('item', ['kategori' => $kategori]);
    }

    public function store(Request $request)
    {
        $item = Item::create($request->all());
        if ($request->hasFile('Gambar')) {
            $name = $request->file('Gambar')->storeAs('Gambar', $request->Judul . '-' . $request->user_id . '-' . now()->timestamp . '-' . $request->file('Gambar')->getClientOriginalName());
            $item->Gambar = $request->Judul . '-' . $request->user_id . '-' . now()->timestamp . '-' . $request->file('Gambar')->getClientOriginalName();
            $item->save();
        }
        if ($item) {
            Session::flash('status', 'success');
            Session::flash('message', 'item successfully added');
        }

        return redirect('/');
    }
}