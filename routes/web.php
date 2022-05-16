<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //author routes
    Route::get('/author', App\Http\Livewire\Author\Listing::class)->name('author.listing');
    Route::get('/author/create', App\Http\Livewire\Author\Form::class)->name('author.create');
    Route::get('/author/edit/{id}', App\Http\Livewire\Author\Form::class)->name('author.edit');

    //post routes
    Route::get('/post', App\Http\Livewire\Post\Listing::class)->name('post.listing');
    Route::get('/post/create', App\Http\Livewire\Post\Form::class)->name('post.create');
    Route::get('/post/edit/{id}', App\Http\Livewire\Post\Form::class)->name('post.edit');


});
