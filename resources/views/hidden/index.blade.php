@extends('master')
@include('navbar')
@section('content')
@if(count($users) == 0)
<div class="text-center" style="margin: 100px 0">
    <h1>No users available!</h1>
</div>
@else
<div class="container">
    <table class="table" style="margin: 100px 0;">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->role }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
                <td>
                    <form action="/hidden/{{$item->id}}" method="POST" enctype="multipart/form-data" class="d-inline-flex">
                        @csrf
                        @method('delete')
                        <div class="d-inline-flex">
                            <a href="/hidden/{{$item->id}}/edit" class="btn btn-warning" style="height:35px;">Edit</a>
                            <input type="submit" class="btn btn-danger mx-2" value="Delete" style="height:35px;">
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$users->links()}}
</div>
@endif
<div class="container">
    <div class="d-flex my-2 justify-content-end">
        <a href="/hidden/create" class="btn btn-primary" style="max-width: 18rem;">+Add More User</a>
    </div>
</div>
@endsection