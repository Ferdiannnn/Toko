@extends('Master.admintamplate');
@section('title', 'Admin Akun')
@section('content')

    <table class="table table-striped table-dark">
        @if (Session::has('status'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
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
            @foreach ($admin as $admins)
                @if (Auth::user()->id == $admins->user_id)
                    @if ($admins->id != 10)
                        <tr>
                            <th scope="row">{{ $admins->id }}</th>
                            <td>{{ $admins->Judul }}</td>
                            <td>{{ $admins->Deskripsi }}</td>
                            <td>{{ $admins->Stok }}</td>
                            <td>Rp. {{ $admins->Harga }}</td>
                            <form method="post" action="/produk-delete/{{ $admins->id }}">
                                <td>
                                    <a href="admin-akun-edit/{{ $admins->id }}" class="btn btn-primary">Edit</a>
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">Delete</button>
                                </td>
                            </form>
                        </tr>
                    @else
                    @endif
                @endif
            @endforeach
        </tbody>
    </table>

@endsection
