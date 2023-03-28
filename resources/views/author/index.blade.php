@extends('master')
@include('navbar')
@section('content')
@if(count($authors) == 0)
<div class="text-center" style="margin: 100px 0">
    <h1>No authors available!</h1>
</div>
@else
<div class="container">
    <table class="table" style="margin: 100px 0;">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <a href="/author/{{$item->id}}" class="btn btn-info" style="max-width: 15rem; font-size: 14px;">Details</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$authors->links()}}
</div>
@endif
@if(auth()->user()->role === 'admin')
<div class="container">
    <div class="d-flex my-2 justify-content-end">
        <a href="/author/create" class="btn btn-primary" style="max-width: 18rem;">+Add More Author</a>
    </div>
</div>
@endif
@endsection