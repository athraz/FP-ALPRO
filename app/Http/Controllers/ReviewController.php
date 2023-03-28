<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::all();
        $authors = Author::all();
        $books = Book::all();
        $reviews = Review::paginate(6);
        return view('review.index', compact('reviews', 'books', 'genres', 'authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        $authors = Author::all();
        $books = Book::all();
        $reviews = Review::all();
        return view('review.create', compact('reviews', 'books', 'genres', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $request->validate(
            [
                'book_id' => 'required',
                'comment' => 'required',
                'rating' => 'required',
            ],
            [
                'book_id.required' => 'Book title can\'t be empty!',
                'comment.required' => 'Please insert your comment!',
                'rating.required' => 'Please choose book\'s rating!',
            ]
        );

        Review::create([
            'book_id' => $request->book_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'user_id' => $user->id
        ]);

        return redirect('/review');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $genres = Genre::all();
        $authors = Author::all();
        $books = Book::all();
        $reviews = Review::where('id', $id)->first();
        return view('review/edit', compact('books', 'genres', 'authors'))->with('reviews', $reviews);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'book_id' => 'required',
                'comment' => 'required',
                'rating' => 'required',
            ],
            [
                'book_id.required' => 'Book title can\'t be empty!',
                'comment.required' => 'Please insert your comment!',
                'rating.required' => 'Please choose book\'s rating!',
            ]
        );
        $reviews = Review::findOrFail($id);
        $reviews_data = [
            'book_id' => $request->book_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ];

        $reviews->update($reviews_data);

        return redirect('/review');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reviews = Review::findOrFail($id);
        $reviews->delete();

        return redirect('/review');
    }
}
