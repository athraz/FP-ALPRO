<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Genre;
use App\Models\Author;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class HiddenController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        $authors = Author::all();
        $books = Book::all();
        $users = User::where('role', 'user')->paginate(10);
        return view('hidden.index', compact('books', 'genres', 'authors', 'users'));
    }

    public function create()
    {
        $genres = Genre::all();
        $authors = Author::all();
        return view('hidden.create', compact('genres', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ], [
            'name.required' => 'Name can\'t be empty!',
            'email.required' => 'Email can\'t be empty!',
            'email.email' => 'Email is not valid!',
            'email.unique' => 'Email already registered!',
            'password.required' => 'Password can\'t be empty!',
            'password.min' => 'The minimum password allowed is 6 characters!'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'user'
        ];
        User::create($data);

        return redirect('/hidden');
    }

    public function edit($id)
    {
        $genres = Genre::all();
        $authors = Author::all();
        $users = User::findOrFail($id);
        return view('hidden.edit', compact('users', 'genres', 'authors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ], [
            'name.required' => 'Name can\'t be empty!',
            'email.required' => 'Email can\'t be empty!',
            'email.email' => 'Email is not valid!',
            'password.min' => 'The minimum password allowed is 6 characters!'
        ]);

        $user = User::findOrFail($id);

        if ($request->email !== $user->email) {
            $request->validate([
                'email' => [
                    'unique:users,email,' . $user->id,
                ],
            ], [
                'email.unique' => 'Email already registered!',
            ]);
        }

        $pass = $request->password;
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($pass !== NULL) {
            $data['password'] = Hash::make($pass);
        }

        $user->update($data);

        return redirect('/hidden');
    }


    public function destroy($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return redirect('/hidden');
    }
}
