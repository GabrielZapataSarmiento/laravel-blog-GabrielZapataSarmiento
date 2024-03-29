<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

use App\Models\BlogPost;
use App\Models\Comments;

Auth::routes();

Route::get('/', [BlogPostController::class, 'blogs'])->name('blogs.index');
Route::get( '/view/{id}', [BlogPostController::class, 'getOneBlog'])->name('blogs.show');

Route::get('/home', function () { return view('home');});

Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
    Route::get('add', [FormController::class, 'add'])->name('add');
    Route::post('store', [BlogPost::class, 'addBlog'])->name('store');

    Route::post('edit', [FormController::class, 'edit'])->name('edit');
    Route::post('update', [BlogPost::class, 'editBlog'])->name('update');

    Route::post('delete', [BlogPost::class, 'deleteBlog'])->name('delete');

    Route::post('repost', [BlogPostController::class, 'repost'])->name('repost');
});




Route::get('/login', function () {return view('auth.login');})->name('login');

Route::get('/register', function () {return view('auth.register');})->name('register');

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::group(['prefix' => '/view', 'as' => 'view.'], function () {
    Route::post('comment-add', [Comments::class, 'add'])->name('comment.add');
    Route::delete('comment-delete', [Comments::class, 'deleteComment'])->name('comment.delete');
    Route::post('like-add', [LikeController::class, 'addLike'])->name('like.add');
});

Route::get('/myblogs', [BlogPostController::class, 'myBlogs'])->name('myblogs');






