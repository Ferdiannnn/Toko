@extends('Master.tamplate');
@section('title', 'Payment Method');
@section('content')

    <div class="container">
        <div class="row">
            @foreach ($channel as $channels)
                <div class="col-4">
                    <form action="/saldo-topup" method="post">
                        @csrf
                        <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                            <button>
                                <input type="hidden" name="id" value="{{ $saldo->id }}">
                                <input type="hidden" name="method_id" value="{{ $channels->code }}">
                                <div class="card-header">{{ $channels->name }}</div>
                                <div class="card-body">
                                    <img src="{{ $channels->icon_url }}" alt="">
                                </div>
                            </button>
                        </div>
                </div>
                </form>
            @endforeach

        </div>
    </div>



@endsection
