<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Review;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all();
        $authors = Author::all();
        $books = Book::paginate(6);
        return view('book.index', compact('books', 'genres', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        $authors = Author::all();
        return view('book.create', compact('genres', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'genre_id' => 'required',
                'author_id' => 'required',
                'desc' => 'required',
                'photo' => 'mimes:jpeg,jpg,png'
            ],
            [
                'title.required' => 'Book title can\'t be empty!',
                'genre.required' => 'Please choose book genre!',
                'author.required' => 'Please choose book author!',
                'desc.required' => 'Book description can\'t be empty!',
                'photo.mimes' => 'Allowed photo extension are JPEG, JPG, and PNG!'
            ]
        );

        $photo_file = $request->file('photo');
        if ($photo_file == NULL) {
            Book::create([
                'title' => $request->title,
                'genre_id' => $request->genre_id,
                'author_id' => $request->author_id,
                'desc' => $request->desc
            ]);
        } else {
            $photo_ext = $photo_file->extension();
            $photo_name = date('ymdhis') . "." . $photo_ext;
            $photo_file->move(public_path('photo'), $photo_name);


            Book::create([
                'title' => $request->title,
                'genre_id' => $request->genre_id,
                'author_id' => $request->author_id,
                'desc' => $request->desc,
                'photo' => $photo_name
            ]);
        }

        return redirect('/book');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $books = Book::findOrFail($id);
        $genres = Genre::all();
        $authors = Author::all();
        $reviews = Review::all();
        return view('book.show', compact('books', 'genres', 'authors', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $books = Book::findOrFail($id);
        $genres = Genre::all();
        $authors = Author::all();
        return view('book.edit', compact('books', 'genres', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required',
                'genre_id' => 'required',
                'author_id' => 'required',
                'desc' => 'required',
                'photo' => 'mimes:jpeg,jpg,png'
            ],
            [
                'title.required' => 'Book title can\'t be empty!',
                'genre.required' => 'Please choose book genre!',
                'author.required' => 'Please choose book author!',
                'desc.required' => 'Book description can\'t be empty!',
                'photo.mimes' => 'Allowed photo extension are JPEG, JPG, and PNG!'
            ]
        );

        $photo_file = $request->file('photo');
        if ($photo_file == NULL) {
            $books = Book::findOrFail($id);
            $books_data = [
                'title' => $request->title,
                'genre_id' => $request->genre_id,
                'author_id' => $request->author_id,
                'desc' => $request->desc
            ];

            $books->update($books_data);

            return view('book.show', compact('books'));
        } else {
            $photo_ext = $photo_file->extension();
            $photo_name = date('ymdhis') . "." . $photo_ext;
            $photo_file->move(public_path('photo'), $photo_name);

            $books = Book::findOrFail($id);
            $books_data = [
                'title' => $request->title,
                'genre_id' => $request->genre_id,
                'author_id' => $request->author_id,
                'desc' => $request->desc,
                'photo' => $photo_name
            ];

            $books->update($books_data);

            return view('book.show', compact('books'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $books = Book::findOrFail($id);
        $books->delete();

        return redirect('/book');
    }
}
