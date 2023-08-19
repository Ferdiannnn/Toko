@extends('Master.tamplate');
@section('title', 'Items add')
@section('content')

    {{ $kategori }}

    <form action="item-store" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div class="form-group">
            <label for="Judul">Judul</label>
            <input type="text" name="Judul" class="form-control" placeholder="Enter Judul">
        </div>
        <div class="form-group " hidden>
            <label for="user_id">user_id</label>
            <input type="text" name="User_id" class="form-control " value="{{ Auth::user()->id }}"
                placeholder="Enter user_id">
        </div>
        <div class="form-group">
            <label for="Kategori_id">kategori</label>
            <select name="Kategori_id" id="Kategori_id" class="form-control">
                <option value="">Select one</option>
                @foreach ($kategori as $katagori)
                    <option value="{{ $katagori->id }}">{{ $katagori->nama_kategori }}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group">
            <label for="Deskripsi">Deskripsi</label>
            <input type="text" name="Deskripsi" class="form-control" placeholder="Enter Deskripsi">
        </div>
        <div class="form-group">
            <label for="Harga">Harga</label>
            <input type="number" name="Harga" id="Harga" class="form-control" placeholder="Enter Harga">
        </div>
        <div class="form-group">
            <label for="Stok">Stok</label>
            <input type="number" name="Stok" id="Stok" class="form-control" placeholder="Enter Harga">
        </div>
        <div class="form-group">
            <label for="Gambar">Gambar</label>
            <input type="file" name="Gambar" id="Gambar" class="form-control">
        </div>
        <button> Submit</button>
    </form>



@endsection
