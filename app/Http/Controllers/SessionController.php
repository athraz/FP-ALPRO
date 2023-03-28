<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    function index()
    {
        return view("sesi/index");
    }

    function login(Request $request)
    {
        Session::flash('email', $request->email);
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email can\'t be empty!',
            'password.required' => 'Password can\'t be empty!',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            return redirect('book')->with('success', 'Login successful');
        } else {
            //return 'gagal';
            return redirect('sesi')->withErrors('Username and password are not valid!');
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Logout success');
    }

    function register()
    {
        return view('sesi/register');
    }

    function create(Request $request)
    {
        Session::flash('name', $request->name);
        Session::flash('email', $request->email);
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

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            return redirect('book')->with('success', Auth::user()->name . 'Login successful');
        } else {
            return redirect('sesi')->withErrors('Username and password are not valid!');
        }
    }
}
