@extends('master')
@include('navbar')
@section('content')
<div class="container-fluid">
    @if(count($books) == 0)
    <div class="text-center" style="margin: 100px 0">
        <h1>No books available!</h1>
    </div>
    @else
    <div class="row justify-content-center" style="margin: 80px 0">
        @foreach ($books as $item)
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
        @endforeach 
    </div>
    <div class="container">
        {{$books->links()}}
    </div>
    @endif
</div>
@if(auth()->user()->role === 'admin')
<div class="container">
    <div class="d-flex my-2 justify-content-end">
        <a href="/book/create" class="btn btn-primary" style="max-width: 18rem;">+Add More Book</a>
    </div>
</div>
@endif

@endsection