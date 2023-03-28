@extends('master')
@include('navbar')
@section('content')
@if(count($genres) == 0)
<div class="text-center" style="margin: 100px 0">
    <h1>No genres available!</h1>
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
            @foreach ($genres as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>
                    <a href="/genre/{{$item->id}}" class="btn btn-info" style="max-width: 15rem; font-size: 14px;">Details</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$genres->links()}}
</div>
@endif

@if(auth()->user()->role === 'admin')
<div class="container">
    <div class="d-flex my-2 justify-content-end">
        <a href="/genre/create" class="btn btn-primary" style="max-width: 18rem;">+Add More Genre</a>
    </div>
</div>
@endif

@endsection