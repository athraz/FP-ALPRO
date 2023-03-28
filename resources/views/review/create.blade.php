@extends('master')
@include('navbar')
@section('content')
<h1 class="mb-3 mx-5" style="margin-top: 80px">Add Comment</h1>
<form action="/review" method="POST" enctype="multipart/form-data" class="mx-5">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Book</label>
                        <select class="form-select form-control" name="book_id">
                            <option selected value="">-</option>
                            @foreach ($books as $item)
                            <option value="{{$item->id}}">{{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Comment</label>
                        <textarea type="text" class="form-control" name="comment" placeholder="Enter Comment"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Rating</label>
                        <select class="form-select form-control" name="rating">
                            <option selected value="">-</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ url()->previous() }}" class="btn btn-light"><< Back</a>
                        <button type="submit" class="btn btn-primary" style="border-radius: 3px">
                            <i class="nav-icon fas fa-plus-circle"></i>Add Comment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection