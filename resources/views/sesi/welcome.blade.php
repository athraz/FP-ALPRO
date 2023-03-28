@extends('layout/aplikasi')

@section('content')
    <div class="w-50 text-center border rounded px-3 py-3 mx-auto">
        <h1>Welcome</h1>
        <p>Please login or register</p>
        <a href="/sesi" class="btn btn-primary btn-lg">LOGIN</a>
        <a href="/sesi/register" class="btn btn-success btn-lg">REGISTER</a> 
    </div>
@endsection