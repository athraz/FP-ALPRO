<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all();
        $authors = Author::paginate(10);
        $books = Book::all();
        return view('author.index', compact('books', 'genres', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        $authors = Author::all();
        return view('author.create', compact('genres', 'authors'));
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
                'name.required' => 'Author\'s name can\'t be empty!',
            ]
        );

        Author::create([
            'name' => $request->name,
        ]);

        return redirect('/author');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $books = Book::all();
        $genres = Genre::all();
        $author = Author::findOrFail($id);
        $authors = Author::all();
        return view('author.show', compact('author', 'genres', 'books', 'authors'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $genres = Genre::all();
        $authors = Author::all();
        $author = Author::findOrFail($id);
        return view('author.edit', compact('genres', 'author', 'authors'));
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

        $authors = Author::findOrFail($id);
        $authors_data = [
            'name' => $request->name,
        ];

        $authors->update($authors_data);
        return redirect('/author');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $authors = Author::findOrFail($id);
        $authors->delete();

        return redirect('/author');
    }
}
