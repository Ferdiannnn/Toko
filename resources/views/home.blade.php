@extends('Master.tamplate');
@section('title', 'Home')
@section('content')
    <div class="container">
        {{ $produklist }}
        {{-- @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif --}}
        <div id="carouselExampleDark" class="carousel carousel-dark slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="{!! asset('img/bg1.jpg') !!}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="{!! asset('img/bg1.jpg') !!}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{!! asset('img/bg1.jpg') !!}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="container">
        <div class="row my-5 " style="background-color: white; ">
            <div class="col offset-md-1">
                <img src="{{ asset('img/user.png') }}" alt="" style="width: 100px">
            </div>
            <div class="col">
                <img src="{{ asset('img/user.png') }}" alt="" style="width: 100px">
            </div>
            <div class="col">
                <img src="{{ asset('img/user.png') }}" alt="" style="width: 100px">
            </div>
            <div class="col">
                <img src="{{ asset('img/user.png') }}" alt="" style="width: 100px">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @foreach ($produklist as $produks)
                @if ($produks->id != 10)
                    <div class="col-sm-3 col-md-3 mt-4">
                        <a href="#">
                            <div class="card carditem" style="width: 18rem; ">
                                <img src="{{ asset('storage/Gambar/' . $produks->Gambar) }}" class="card-img-top"
                                    alt="...">
                                <div class="card-body ">
                                    <h5 class="card-title">{{ $produks->Judul }}</h5>
                                    <a class="card-title btn btn-outline-success ms-3 col-4"
                                        href="produk-detail/{{ $produks->id }}">Detail</a>
                                    <a class="card-title btn btn-outline-danger ms-5 col-4"
                                        href="checkout/{{ $produks->id }}">Beli</a>

                                    <form action="/cart/{{ $produks->id }}" method="post">
                                        @csrf
                                        @method('post')
                                        <button class="btn btn-danger  col-12" type="submit"><img
                                                src="{!! asset('img/shopping-chart.png') !!}" style="width: 20px" /></button>

                                    </form>
                                </div>
                            </div>
                        </a>
                    </div>
                @else
                @endif
            @endforeach
        </div>
    </div>

    @include('sweetalert::alert')

@endsection
