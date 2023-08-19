@extends('Master.tamplate');
@section('title', 'Payment')
@section('content')

    <div class="container">
        <div class="row">

            @foreach ($channel as $channel)
                <div class="col-3">
                    <form action="/checkout-store" method="post">
                        @csrf
                        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                        <input type="hidden" name="method_id" value="{{ $channel->code }}">
                        <button class="card" style="width: 18rem;">
                            <img src="{{ $channel->icon_url }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $channel->name }}</h5>
                            </div>
                        </button>
                    </form>

                </div>
            @endforeach
        </div>
    </div>

@endsection
