@extends('master')
@include('navbar')
@section('content')
<div class="container-fluid bg-dark text-light mt-5">
    <div class="row py-5 px-3">
        <div class="col-3" style="margin-left: 60px">
            @if ($books->photo)
            <img class="img-fluid" src="{{ url('photo').'/'.$books->photo }}" style="width:240px; height:384px;" />
            @else
            <img class="img-fluid" src="{{ url('photo/null.png') }}" style="width:240px; height:384px;" />
            @endif
        </div>

        <div class="col-8 mx-2">
            <h1 style="margin-bottom: 40px">{{$books->title}}</h1>
            <h6 style="font-weight: normal; text-align: justify; margin-bottom: 40px;">{{strlen($books->desc) > 1000 ? substr($books->desc, 0, 1000) . "..." : $books->desc}}</h6>
            <h5>Genre: {{$books->genre->name}}</h5>
            <h5>Author: {{$books->author->name}}</h5>
            @if (\App\Models\Review::where('book_id', $books->id)->avg('rating') > 0)
            <h5>Rating: {{ number_format(\App\Models\Review::where('book_id', $books->id)->avg('rating'), 1) }} ⭐</h5>
            @else
            <h5>Rating: -</h5>
            @endif
            <form action="/book/{{$books->id}}" method="POST" enctype="multipart/form-data" style="margin-top: 15px">
                @csrf
                @method('delete')
                <div class="d-inline-flex justify-content-start">
                    <a href="./" class="btn btn-light mt-3 me-1"><< Back</a>
                    @if(auth()->user()->role === 'admin')
                    <a href="/book/{{$books->id}}/edit" class="btn btn-warning mt-3 mx-1">Edit</a>
                    <input type="submit" class="btn btn-danger mt-3 mx-1" value="Delete">
                    @endif
                    <a href="/review/create" class="btn btn-info mt-3 mx-1">Add Comment</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container mb-5">
    @php $found = false; @endphp
    @foreach ($reviews as $item)
    @if ($item->book_id == $books->id)
    @php $found = true; @endphp
    @php break; @endphp
    @endif
    @endforeach
    @if ($found)
    <h3 class="mt-5 mb-2">Comments:</h3>
    <div class="row justify-content-center">
        @foreach ($reviews as $item)
        @if ($item->book_id == $books->id)
        <div class="col-12 mx-4 my-3 px-3 py-1" style="border:solid 1px black; border-radius:30px;">
            <div class="row">
                <div class="col-1 d-flex justify-content-center ">
                    <img class="img-fluid mt-3" src="{{ url('img/person1.png') }}" style="width:50px; height:50px; border-radius: 50%" />
                </div>
                <div class="col-11">
                    <h3 class="mt-3 fs-5 d-inline-flex">{{$item->user->name}}</h3>
                    <h3 class="mt-3 mx-3 fs-5 d-inline-flex border px-2 py-1" style="border-radius: 15px">{{$item->rating}} ⭐</h3>
                    <div class="data mt-2 mb-3 me-5">
                        <h4 class="fs-6" style="text-align: justify;">{{$item->comment}}</h4>
                    </div>
                    <div class="btn-group mb-2" role="group">
                        <input type="radio" class="btn-check" name="btn{{$item->id}}" id="btn1{{$item->id}}" autocomplete="off">
                        <label class="btn btn-outline-success" for="btn1{{$item->id}}">Upvote</label>
                        <input type="radio" class="btn-check" name="btn{{$item->id}}" id="btn2{{$item->id}}" autocomplete="off">
                        <label class="btn btn-outline-danger" for="btn2{{$item->id}}">Downvote</label>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    @else
    <h3 class="d-flex justify-content-center" style="margin-top: 100px;">No comments available for this book!</h3>
    @endif
</div>
@endsection
