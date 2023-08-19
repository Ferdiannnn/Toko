@extends('Master.tamplate');
@section('title', 'Cart')
@section('content')

    <div class="container">
        <div class="row">
            @if (Session::has('status'))
                <div class="alert alert-danger">
                    {{ Session::get('message') }}
                </div>
            @endif
            @foreach ($cart as $item)
                <div class="col-3 my-4"><img src="{{ asset('storage/Gambar/' . $item->produk->Gambar) }}" alt=""
                        style="width: 300px"></div>
                <div class="col-2 my-4">{{ $item->produk->Judul }}</div>
                <div class="col-2 my-4">Rp. {{ number_format($item->produk->Harga) }}</div>

                <div class="col-2 my-4">
                    <form action="" method="post" class="jumlah-form">
                        @csrf
                        <input type="number" class="col-2 jumlah-input" value="{{ $item->jumlah }}"
                            data-original-value="{{ $item->jumlah }}">
                        <a href="/update-jumlah-cart/{{ $item->id }}" class="ms-4 btn btn-outline-danger jumlah-button"
                            style="display: none">Jumlah</a>
                    </form>
                </div>
                <div class="col my-4 align-self-center" style="position: relative; right: 598px">
                    <form action="/cart-delete/{{ $item->id }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-outline-danger">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        const jumlahForms = document.querySelectorAll('.jumlah-form');

        jumlahForms.forEach(form => {
            const jumlahInput = form.querySelector('.jumlah-input');
            const jumlahButton = form.querySelector('.jumlah-button');

            let originalValue = jumlahInput.getAttribute('data-original-value');

            jumlahInput.addEventListener('input', function() {
                if (jumlahInput.value !== originalValue) {
                    jumlahButton.style.display = 'inline-block';
                } else {
                    jumlahButton.style.display = 'none';
                }
            });

            form.addEventListener('submit', function(event) {
                originalValue = jumlahInput.value;
                jumlahButton.style.display = 'none';
            });
        });
    </script>

@endsection
