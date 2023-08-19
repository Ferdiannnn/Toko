@extends('Master.tamplate');
@section('title', 'Profile')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col my-5 ">
                @if (Session::has('not successful'))
                    <div class="alert alert-danger ">
                        {{ Session::get('message') }}
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-info">
                        {{ Session::get('message') }}
                    </div>
                @endif
                @if (Auth::user()->role_id == 1)
                    <h1>Profile <span class="badge rounded-pill text-bg-info">Admin</span></h1> <br>
                @else
                    <h1>Profile <span class="badge rounded-pill text-bg-info">Member</span></h1> <br>
                @endif

                <form action="change-profile/{{ Auth::user()->id }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ Auth::user()->name }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-3">
                            <input type="email" class="form-control" name="email" id="email"
                                value="{{ Auth::user()->email }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary my-3">Change</button>
                </form>

            </div>
            <div class="col my-5" style="position: relative; top: 50px">
                <form action="change-password/{{ Auth::user()->id }}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label">Old Password</label>
                        <div class="col-sm-3">
                            <input type="password" class="form-control" name="oldpassword" id="password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-3">
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary my-3">Change Password</button>
                </form>
            </div>
        </div>
    </div>

@endsection
