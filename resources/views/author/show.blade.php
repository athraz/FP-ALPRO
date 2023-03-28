@extends('master')
@include('navbar')
@section('content')
<div class="container-fluid bg-dark text-light py-5 px-5 mt-5">
    <h1 class="d-inline-flex" style="margin-right: 900px;">{{$author->name}}</h1>
    <form action="/author/{{$author->id}}" method="POST" enctype="multipart/form-data" class="d-inline-flex">
        @csrf
        @method('delete')
        <div class="d-inline-flex justify-content-start">
            <a href="{{ url()->previous() }}" class="btn btn-light mt-3 mx-2"><< Back</a>
            @if(auth()->user()->role === 'admin')
            <a href="/author/{{$author->id}}/edit" class="btn btn-warning mt-3">Edit</a>
            <input type="submit" class="btn btn-danger mt-3 mx-2" value="Delete">
            @endif
        </div>
    </form>
</div>
<div class="container-fluid">
    @php $found = false; @endphp
    @foreach ($books as $item)
    @if ($item->author_id == $author->id)
    @php $found = true; @endphp
    @php break; @endphp
    @endif
    @endforeach
    @if (!$found)
    <h3 class="d-flex justify-content-center" style="margin-top: 100px;">No books available for this author!</h3>
    @else
    <div class="row justify-content-center" style="margin: 40px 0">
        @foreach ($books as $item)
        @if ($item->author_id == $author->id)
        <div class="col-5 mx-3 mt-4" style="border:solid 1px black; border-radius: 30px;">
            <div class="row align-items-center px-3 py-3">
                <div class="col-4">
                    @if ($item->photo)
                    <img class="img-fluid" src="{{ url('photo').'/'.$item->photo }}" style="width:160px; height:256px;" />
                    @else
                    <img class="img-fluid" src="{{ url('photo/null.png') }}" style="width:160px; height:256px;" />
                    @endif
                </div>
                <div class="col-8">
                    <h4 class="my-3 fs-5" style="font-weight: bolder">{{$item->title}}</h4>
                    <h6 class="my-3" style="font-weight: normal; text-align: justify;">{{strlen($item->desc) > 200 ? substr($item->desc, 0, 200) . "..." : $item->desc}}</h6>
                    <div class="data my-3">
                        <h5 class="fs-6">Genre: {{$item->genre->name}}</h5>
                        <h5 class="fs-6">Author: {{$item->author->name}}</h5>
                    </div>
                    <div class="d-inline-flex my-2 justify-content-center">
                        <a href="/book/{{$item->id}}" class="btn btn-info" style="max-width: 15rem; font-size: 14px;">Details</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    @endif
</div>
@endsection