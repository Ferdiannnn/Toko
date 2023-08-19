<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FV Store | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="{!! asset('assets/css/app.css') !!}">
</head>

<body>
    <nav class="navbar navbar-expand-lg "data-bs-theme="dark">
        <div class="container navbar">
            <a class="navbar-brand" href="#">FV Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                    <a class="nav-link" href="#">Features</a>
                    <a class="nav-link" href="#">Pricing</a>
                    @if (Auth::user() != null)
                    @else
                        <a class="nav-link" href="login">Login</a>
                    @endif
                    @if (Auth::user() == null)
                    @else
                        <a href="cart"><img class="chart" src="{!! asset('img/shopping-chart.png') !!}" /></a>
                        <div class="dropdown ">
                            <a class="btn  dropdown-toggle col-2" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{!! asset('img/profile.png') !!}" class="profile" alt="">
                            </a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/profile">Profile</a></li>
                                <li><a class="dropdown-item" href="/transaksi">Trancastion</a></li>
                                <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            </ul>
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </nav>

    <div class="container">

        @yield('content')

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
</body>

</html>
