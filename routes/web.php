<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SwapRequestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChatController;



//Books
Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::post('/books', [BookController::class, 'store'])->middleware('auth');

//Login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
   Route::get('admin', [SwapRequestController::class, 'index'])->middleware('auth')->name('admin');
    Route::post('/swap/{book}', [SwapRequestController::class, 'store'])->middleware('auth');
    Route::get('/create', [BookController::class, 'create'])->name('create');
    //DELETE
    Route::post('/crear', [BookController::class, 'crear'])->name('crear');

    Route::post('/delete/{book}', [BookController::class, 'destroy'])->name('delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('/swap/{book}', [SwapRequestController::class, 'store'])->middleware('auth');
    Route::patch('/acceptSwap/{id}', [SwapRequestController::class, 'switch'])->name('acceptSwap');
    Route::patch('NoAcceptSwap', [SwapRequestController::class, 'Noswitch'])->middleware('auth')->name('NoAcceptSwap');

});

//Chat AI
Route::post('/chat', [ChatController::class, 'sendMessage']);


require __DIR__.'/auth.php';
