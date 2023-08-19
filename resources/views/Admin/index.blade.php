@extends('Master.admintamplate');
@section('title', 'Admin')
@section('content')

    <div class="container">
        <h1>Selamat Datang {{ Auth::user()->name }}</h1>
    </div>
@endsection
