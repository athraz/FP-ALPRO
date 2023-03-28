@extends('master')
@include('navbar')
@section('content')
<h1 class="mx-5 mb-3" style="margin-top: 80px">Edit genre: {{$genre->name}}</h1>
<form action="/genre/{{$genre->id}}" method="POST" enctype="multipart/form-data" class="mx-5">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Genre's Name</label>
                        <input type="text" class="form-control" name="name" value="{{$genre->name}}" placeholder="Enter genre's name">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="./" class="btn btn-light"><< Back</a>
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