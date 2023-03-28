@extends('master')
@include('navbar')
@section('content')
<h1 class="mb-3 mx-5" style="margin-top: 80px">Edit comment: </h1>
<form action="/review/{{$reviews->id}}" method="POST" enctype="multipart/form-data" class="mx-5">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Book</label>
                        <select class="form-select form-control" name="book_id">
                            <option selected value="">-</option>
                            @foreach ($books as $item)
                            <option value="{{$item->id}}" @if($item->id == $reviews->book_id)
                                selected
                                @endif
                                >{{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="comment">Comment</label>
                        <textarea id="comment" class="form-control" name="comment" placeholder="Enter Comment">{{ $reviews->comment }}</textarea>
                    </div>


                    <div class="form-group mb-3">
                        <label for="rating">Rating</label>
                        <select id="rating" name="rating" class="form-select form-control">
                            @for($i = 1; $i <= 5; $i++) @if($reviews->rating == $i)
                                <option selected value="{{ $i }}">{{ $i }}</option>
                                @else
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endif
                                @endfor
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="/review" class="btn btn-light">
                            << Back</a>
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