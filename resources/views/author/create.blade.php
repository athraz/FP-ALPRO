@extends('master')
@include('navbar')
@section('content')
<h1 class="mb-3 mx-5" style="margin-top: 80px">Add Author</h1>
<form action="/author" method="POST" enctype="multipart/form-data" class="mx-5">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Author's Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter author's name">
                        @error('name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="/author" class="btn btn-light"><< Back</a>
                        <button type="submit" class="btn btn-primary" style="border-radius: 3px">
                            <i class="nav-icon fas fa-plus-circle"></i>Add Author
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection