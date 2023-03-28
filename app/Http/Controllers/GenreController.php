<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::paginate(10);
        $authors = Author::all();
        $books = Book::all();
        return view('genre.index', compact('books', 'genres', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        $authors = Author::all();
        return view('genre.create', compact('genres', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Genre\'s name can\'t be empty!',
            ]
        );

        Genre::create([
            'name' => $request->name,
        ]);

        return redirect('/genre');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $books = Book::all();
        $genre = Genre::findOrFail($id);
        $genres = Genre::all();
        $authors = Author::all();
        return view('genre.show', compact('genre', 'books', 'authors', 'genres'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $genre = Genre::findOrFail($id);
        $genres = Genre::all();
        $authors = Author::all();
        return view('genre.edit', compact('genre', 'genres', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
            ],
            [
                'name.required' => 'Genre\'s name can\'t be empty!',
            ]
        );

        $genres = Genre::findOrFail($id);
        $genres_data = [
            'name' => $request->name,
        ];

        $genres->update($genres_data);
        return redirect('/genre');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $genres = Genre::findOrFail($id);
        $genres->delete();

        return redirect('/genre');
    }
}
