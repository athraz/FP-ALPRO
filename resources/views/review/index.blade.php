@extends('master')
@include('navbar')
@section('content')
@if(auth()->user()->role === 'admin')
    @if(count($reviews) == 0)
    <div class="text-center" style="margin: 100px 0">
        <h1>No reviews available!</h1>
    </div>
    @else
    <div class="container">
        <table class="table" style="margin: 100px 0 50px;">
            <thead>
                <tr>
                    <th>id</th>
                    <th>book</th>
                    <th>author</th>
                    <th>comment</th>
                    <th>rating</th>
                    <th>user</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->book->title }}</td>
                    <td>{{ $item->book->author->name }}</td>
                    <td>{{ $item->comment }}</td>
                    <td>{{ $item->rating }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>
                        <form action="/review/{{$item->id}}" method="POST" enctype="multipart/form-data" class="d-inline-flex">
                            @csrf
                            @method('delete')
                            <div class="d-inline-flex">
                                <a href="/review/{{$item->id}}/edit" class="btn btn-warning" style="height:35px;">Edit</a>
                                <input type="submit" class="btn btn-danger mx-2" value="Delete" style="height:35px;">
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$reviews->links()}}
    </div>
    @endif
@else
    @php $found = false; @endphp
    @foreach ($reviews as $item)
    @if ($item->user_id == auth()->user()->id)
    @php $found = true; @endphp
    @php break; @endphp
    @endif
    @endforeach
    @if (!$found)
    <div class="text-center" style="margin: 100px 0">
        <h1>No reviews available from you!</h1>
    </div>
    @else
    <div class="container">
        <table class="table" style="margin: 100px 0 50px;">
            <thead>
                <tr>
                    <th>id</th>
                    <th>book</th>
                    <th>author</th>
                    <th>comment</th>
                    <th>rating</th>
                    <th>user</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $item)
                @if ($item->user_id == auth()->user()->id)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->book->title }}</td>
                    <td>{{ $item->book->author->name }}</td>
                    <td>{{ $item->comment }}</td>
                    <td>{{ $item->rating }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>
                        <form action="/review/{{$item->id}}" method="POST" enctype="multipart/form-data" class="d-inline-flex">
                            @csrf
                            @method('delete')
                            <div class="d-inline-flex">
                                <a href="/review/{{$item->id}}/edit" class="btn btn-warning" style="height:35px;">Edit</a>
                                <input type="submit" class="btn btn-danger mx-2" value="Delete" style="height:35px;">
                            </div>
                        </form>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        {{$reviews->links()}}
    </div>
    @endif
@endif
<div class="container">
    <div class="d-flex my-2 justify-content-end">
        <a href="/review/create" class="btn btn-primary" style="max-width: 18rem;">+Add New Comment</a>
    </div>
</div>
@endsection