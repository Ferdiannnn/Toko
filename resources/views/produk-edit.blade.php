@extends('Master.tamplate');
@section('title', 'Edit Produk')
@section('content')

    {{ $produk->kategori }}



    <form action="/produk-update/{{ $produk->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="Judul">Judul</label>
            <input type="text" name="Judul" class="form-control" value="{{ $produk->Judul }}" placeholder="Enter Judul">
        </div>
        <div class="form-group " hidden>
            <label for="user_id">user_id</label>
            <input type="text" name="user_id" class="form-control " value="{{ Auth::user()->id }}"
                placeholder="Enter user_id">
        </div>
        <div class="form-group">
            <label for="kategori_id">kategori</label>
            <select name="kategori_id" id="kategori_id" class="form-control">
                <option value="{{ $produk->kategori_id }}">{{ $produk->kategori->nama_kategori }}</option>
                @foreach ($kategori as $katagori)
                    <option value="{{ $katagori->id }}">{{ $katagori->nama_kategori }}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group">
            <label for="Deskripsi">Deskripsi</label>
            <input type="text" name="Deskripsi" class="form-control" value="{{ $produk->Deskripsi }}"
                placeholder="Enter Deskripsi">
        </div>
        <div class="form-group">
            <label for="Harga">Harga</label>
            <input type="number" name="Harga" id="Harga" class="form-control" value="{{ $produk->Harga }}"
                placeholder="Enter Harga">
        </div>
        <div class="form-group">
            <label for="Stok">Stok</label>
            <input type="number" name="Stok" id="Stok" class="form-control" value="{{ $produk->Stok }}"
                placeholder="Enter Harga">
        </div>
        <div class="form-group">
            <label for="Gambar">Gambar</label><br>
            <img src="{{ asset('storage/Gambar/' . $produk->Gambar) }}" alt="" style="width: 10rem">
            <input type="file" name="Gambar" id="Gambar" class="form-control" value=" {{ $produk->Gambar }}">
        </div>
        <button> Submit</button>
    </form>

@endsection
