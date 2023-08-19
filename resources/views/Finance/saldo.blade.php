@extends('Master.tamplate');
@section('title', 'Saldo topup');
@section('content')

    {{ $saldo }}


    <div class="container">
        <div class="row">
            @foreach ($saldo as $saldos)
                <div class="col-3">
                    <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                        <a href="saldo-topup/{{ $saldos->id }}">
                            <div class="card-header">Top up</div>
                            <div class="card-body">
                                <h5 class="card-title">Rp. {{ $saldos->Judul }} </h5>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
