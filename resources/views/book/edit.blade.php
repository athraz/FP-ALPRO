@extends('master')
@include('navbar')
@section('content')
<h1 class="mb-3 mx-5" style="margin-top: 80px">Edit book: {{$books->title}}</h1>
<form action="/book/{{$books->id}}" method="POST" enctype="multipart/form-data" class="mx-5">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="{{$books->title}}" placeholder="Enter Book Title">
                    </div>

                    <div class="form-group mb-3">
                        <label>Genre</label>
                        <select class="form-select form-control" name="genre_id">
                            <option selected value="">-</option>
                            @foreach ($genres as $item)
                            <option value="{{$item->id}}"
                                @if($item->id == $books->genre_id)
                                selected
                                @endif
                            >{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Author</label>
                        <select class="form-select form-control" name="author_id">
                            <option selected value="">-</option>
                            @foreach ($authors as $item)
                            <option value="{{$item->id}}"
                                @if($item->id == $books->author_id)
                                selected
                                @endif
                            >{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="desc">Description</label>
                        <textarea id="desc" class="form-control" name="desc" placeholder="Enter Book Description">{{ $books->desc }}</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Photo</label>
                        <input type="file" class="form-control" name="photo" placeholder="Enter Book Photo">
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