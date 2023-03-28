@extends('master')
@include('navbar')
@section('content')
<h1 class="mb-3 mx-5" style="margin-top: 80px">Edit user:</h1>
<form action="/hidden/{{$users->id}}" method="POST" enctype="multipart/form-data" class="mx-5">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{$users->name}}" placeholder="Enter user name">
                    </div>

                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="{{$users->email}}" placeholder="Enter user email">
                    </div>

                    <div class="form-group mb-3">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter user password">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/hidden" class="btn btn-light"><< Back</a>
                        <button type="submit" class="btn btn-primary" style="border-radius: 3px">
                            <i class="nav-icon fas fa-plus-circle"></i>Save Update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection