<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\VerifyCompleteController;


Route::get('/', [PostController::class, 'index'])->name('post.index');



// Route::get('post', [PostController::class, 'index'])->name('post.index');

// Route::get('/dashboard', [PostController::class, 'index'])->middleware('auth')->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('post', PostController::class)->except('index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/post/{post}/comment/create', [CommentController::class, 'create'])->name('comment.create');
    Route::post('/post/{post}/comment', [CommentController::class, 'store'])->name('comment.store');

    Route::resource('comments', CommentController::class)->except(['index', 'show', 'create']);
    Route::get('/mypage', [PostController::class, 'mypage'])->name('post.mypage');
});



require __DIR__ . '/auth.php';

// Language Switcher Route 言語切替用ルートだよ
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);


    return redirect()->back();
});

Route::middleware(['auth'])->group(function () {
    // メール確認画面
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    // メール認証処理
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('verification.success');
    })->middleware(['signed'])->name('verification.verify');

    // 認証メールの再送 (POST)
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', '認証メールを再送しました！');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

Route::get('/email/verify/success', [VerifyCompleteController::class, 'show'])
    ->name('verification.success');