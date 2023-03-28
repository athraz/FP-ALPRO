@extends('master')
@include('navbar')
@section('content')
<h1 class="mx-5 mb-3" style="margin-top: 80px">Add Genre</h1>
<form action="/genre" method="POST" enctype="multipart/form-data" class="mx-5">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Genre's Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter genre's name">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="/genre" class="btn btn-light"><< Back</a>
                        <button type="submit" class="btn btn-primary" style="border-radius: 3px">
                            <i class="nav-icon fas fa-plus-circle"></i>Add Genre
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection