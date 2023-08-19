@extends('Master.tamplate');
@section('title', 'Payment');
@section('content')



    <div class="container">
        <div class="row my-5">
            <div class="col-2">
            </div>
            <div class="col-2 align-self-end">
                <h1>Rp. {{ number_format($response->amount) }}</h1>
            </div>
            <div class="col-2 align-self-start mb-4">
                <p>{{ $response->reference }}</p>
            </div>
            <div class="col-2"></div>
        </div>

        <div class="row my-4">
            <div class="col-2">
            </div>
            <div class="col">
                <span class="badge rounded-pill text-bg-info">{{ $response->status }}</span>
            </div>
        </div>

        <div class="row">
            <div class="col-7"></div>
            <div class="col-4 flex " style="position: relative; top: -10rem">
                @foreach ($response->instructions as $info)
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    {{ $info->title }}
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                @foreach ($info->steps as $steps)
                                    <div class="accordion-body">{{ $loop->iteration }}. {!! $steps !!}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


@endsection
