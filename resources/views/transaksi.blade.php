@extends('Master.tamplate');
@section('title', 'Transaksi')
@section('content')

    <div class="container">
        @if (session('success'))
            <div class="alert alert-success col-2">
                {{ session('success') }} <br>
            </div>
        @endif
        <div class="row">
            <div class="col-2">
                <table class="table">
                    @foreach ($balances as $balance)
                        @if (Auth::user()->id == $balance->user_id)
                            <tr>
                                <td>Saldo</td>
                                <td>Rp. {{ number_format($balance->saldo) }}</td>
                                <td><a href="saldo" class="btn btn-outline-primary">Top Up</a></td>
                            </tr>
                        @else
                        @endif
                    @endforeach
                </table>
            </div>
        </div>


        <div class="row my-4">
            <div class="col text-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Item</th>
                            <th scope="col">Reference</th>
                            <th scope="col">Merchent Ref</th>
                            <th scope="col">Harga </th>
                            <th scope="col">Status </th>
                            <th scope="col">Tanggal Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $item)
                            @if ($item->user_id == Auth::user()->id)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $item->produk->Judul }}</td>
                                    <td>{{ $item->reference }}</td>
                                    <td>{{ $item->merchent_ref }}</td>
                                    <td>{{ $item->total_amount }}</td>
                                    <td><span class="badge text-bg-info">{{ $item->status }}</span></td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                            @else
                            @endif
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

@endsection
