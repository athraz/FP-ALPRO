@extends('master')
@include('navbar')
@section('content')
<h1 class="mx-5 mb-3" style="margin-top: 80px">Add book</h1>
<form action="/book" method="POST" enctype="multipart/form-data" class="mx-5">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter Book Title">
                    </div>

                    <div class="form-group mb-3">
                        <label>Genre</label>
                        <select class="form-select form-control" name="genre_id">
                            <option selected value="">-</option>
                            @foreach ($genres as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Author</label>
                        <select class="form-select form-control" name="author_id">
                            <option selected value="">-</option>
                            @foreach ($authors as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Description</label>
                        <textarea type="text" class="form-control" name="desc" placeholder="Enter Book Description"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Photo</label>
                        <input type="file" class="form-control" name="photo" placeholder="Enter Book Photo">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/book" class="btn btn-light"><< Back</a>
                        <button type="submit" class="btn btn-primary" style="border-radius: 3px">
                            <i class="nav-icon fas fa-plus-circle"></i>Add Book
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection