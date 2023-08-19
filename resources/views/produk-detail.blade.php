@extends('Master.tamplate');
@section('title', 'Detail Produk')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-5">
                <img src="{{ asset('storage/Gambar/' . $produk->Gambar) }}" class="img-fluid" alt="">
            </div>
            <div class="col-1 align-self-start">
                <p>Judul</p>
                <p>{{ $produk->Judul }}</h>
            </div>
            <div class="col-1 align-self-start">
                <p>Deskripsi</p>
                <p>{{ $produk->Deskripsi }}</p>
            </div>
            <div class="col-1 align-self-center mt-4" style="position: relative; right: 215px; top:50px">
                <p>Stok</p>
                <p>{{ $produk->Stok }}</p>
            </div>
            <div class="col-1 align-self-center mt-4" style="position: relative; right: 215px; top:50px">
                <p>Harga</p>
                <p>Rp. {{ $produk->Harga }}</p>
            </div>

        </div>
        <div class="row mt-5">
            <div class="col-4">
                <a href="" class="btn btn-outline-danger col-6">Beli</a>
            </div>
            <div class="col-1 ">
                <a href="#"><img class="" src="{!! asset('img/shopping-chart.png') !!} " style="width: 50%" />Keranjang</a>
            </div>
        </div>

    </div>



@endsection
