@extends('Master.admintamplate');
@section('title', 'Admin Akun')
@section('content')

    <table class="table table-striped table-dark">
        <a href="/produk" class="btn btn-outline-danger mb-4 ms-auto ">Tambah</a>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Judul</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Stok</th>
                <th scope="col">Harga</th>
                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($item as $admins)
                @if (Auth::user()->id == $admins->User_id)
                    <tr>
                        <th scope="row">{{ $admins->id }}</th>
                        <td>{{ $admins->Judul }}</td>
                        <td>{{ $admins->Deskripsi }}</td>
                        <td>{{ $admins->Stok }}</td>
                        <td>Rp. {{ $admins->Harga }}</td>
                        <td>
                            <a href="admin-akun-edit/{{ $admins->id }}" class="btn btn-primary">Edit</a>
                            <a href="admin-akun-delete/{{ $admins->id }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>



@endsection
