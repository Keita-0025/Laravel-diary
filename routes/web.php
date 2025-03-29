<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Models\Post;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/mypage', [PostController::class, 'mypage'])
->name('post.mypage')
->middleware('auth');


Route::get('post', [PostController::class, 'index'])->name('post.index');

Route::get('/dashboard', [PostController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('post', PostController::class)->except('index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/post/{post}/comment/create', [CommentController::class, 'create'])->name('comment.create');
    Route::post('/post/{post}/comment', [CommentController::class, 'store'])->name('comment.store');
    
    Route::resource('comments', CommentController::class)->except(['index', 'show', 'create']);
});

require __DIR__ . '/auth.php';

// Language Switcher Route 言語切替用ルートだよ
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);


    return redirect()->back();
});
