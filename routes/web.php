<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\HiddenController;
use Illuminate\Contracts\Session\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/book', [BookController::class, 'index'])->middleware('Loginkah');
Route::get('/book/create', [BookController::class, 'create'])->middleware('Adminkah');
Route::post('/book', [BookController::class, 'store'])->middleware('Loginkah');
Route::get('/book/{books_id}', [BookController::class, 'show'])->middleware('Loginkah');
Route::get('/book/{books_id}/edit', [BookController::class, 'edit'])->middleware('Adminkah');
Route::put('/book/{books_id}', [BookController::class, 'update'])->middleware('Loginkah');
Route::delete('/book/{books_id}', [BookController::class, 'destroy'])->middleware('Loginkah');

Route::get('/genre', [GenreController::class, 'index'])->middleware('Loginkah');
Route::get('/genre/create', [GenreController::class, 'create'])->middleware('Adminkah');
Route::post('/genre', [GenreController::class, 'store'])->middleware('Loginkah');
Route::get('/genre/{genres_id}', [GenreController::class, 'show'])->middleware('Loginkah');
Route::get('/genre/{genres_id}/edit', [GenreController::class, 'edit'])->middleware('Adminkah');
Route::put('/genre/{genres_id}', [GenreController::class, 'update'])->middleware('Loginkah');
Route::delete('/genre/{genres_id}', [GenreController::class, 'destroy'])->middleware('Loginkah');

Route::get('/author', [AuthorController::class, 'index'])->middleware('Loginkah');
Route::get('/author/create', [AuthorController::class, 'create'])->middleware('Adminkah');
Route::post('/author', [AuthorController::class, 'store'])->middleware('Loginkah');
Route::get('/author/{authors_id}', [AuthorController::class, 'show'])->middleware('Loginkah');
Route::get('/author/{authors_id}/edit', [AuthorController::class, 'edit'])->middleware('Adminkah');
Route::put('/author/{authors_id}', [AuthorController::class, 'update'])->middleware('Loginkah');
Route::delete('/author/{authors_id}', [AuthorController::class, 'destroy'])->middleware('Loginkah');

Route::get('/review', [ReviewController::class, 'index'])->middleware('Loginkah');
Route::get('/review/create', [ReviewController::class, 'create'])->middleware('Loginkah');
Route::post('/review', [ReviewController::class, 'store'])->middleware('Loginkah');
Route::get('/review/{reviews_id}/edit', [ReviewController::class, 'edit'])->middleware('Reviewkah');
Route::put('/review/{reviews_id}', [ReviewController::class, 'update'])->middleware('Loginkah');
Route::delete('/review/{reviews_id}', [ReviewController::class, 'destroy'])->middleware('Loginkah');

Route::get('/hidden', [HiddenController::class, 'index'])->middleware('Adminkah');
Route::get('/hidden/create', [HiddenController::class, 'create'])->middleware('Adminkah');
Route::post('/hidden', [HiddenController::class, 'store'])->middleware('Adminkah');
Route::get('/hidden/{users_id}/edit', [HiddenController::class, 'edit'])->middleware('Adminkah');
Route::put('/hidden/{users_id}', [HiddenController::class, 'update'])->middleware('Adminkah');
Route::delete('/hidden/{users_id}', [HiddenController::class, 'destroy'])->middleware('Adminkah');

// Route::get('/sesi', [SessionController::class, 'index']);
// Route::post('/sesi/login', [SessionController::class, 'login']);
// Route::get('/sesi/logout', [SessionController::class, 'logout']);

// Route::resource('book', BookController::class)->middleware('Loginkah');
// Route::resource('genre', GenreController::class)->middleware('Loginkah');
// Route::resource('author', AuthorController::class)->middleware('Loginkah');
// Route::resource('review', ReviewController::class)->middleware('Loginkah');

Route::get('/sesi', [SessionController::class, 'index'])->middleware('Tamukah');
Route::post('/sesi/login', [SessionController::class, 'login'])->middleware('Tamukah');
Route::get('/sesi/logout', [SessionController::class, 'logout']);
Route::get('/sesi/register', [SessionController::class, 'register'])->middleware('Tamukah');
Route::post('/sesi/create', [SessionController::class, 'create'])->middleware('Tamukah');

Route::get('/', function () {
    return view('sesi/welcome');
})->middleware('Tamukah');