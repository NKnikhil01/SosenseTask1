<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

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
    return view('welcome');
});

Auth::routes();

/* Admin Section Routes */
Route::prefix('admin')->middleware(['auth','is.admin'])->group(function(){
    /* user's Sections Route list */
    Route::get('/home', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/add-user', [AdminController::class, 'addUser'])->name('add.user');
    Route::post('/post-user', [AdminController::class, 'postUser'])->name('post.user');
    Route::get('/edit-user/{id}', [AdminController::class, 'editUser'])->name('user.edit');
    Route::post('/update-user/{id}', [AdminController::class, 'updateUser'])->name('user.update');
    Route::get('/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('user.delete');

    /* Category's Sections Route List */
    Route::get('/category', [AdminController::class, 'category'])->name('admin.category');
    Route::get('/add-category', [AdminController::class, 'addCategory'])->name('add.category');
    Route::post('/post-category', [AdminController::class, 'postCategory'])->name('post.category');
    Route::get('/edit-category/{id}', [AdminController::class, 'categoryEdit'])->name('category.edit');
    Route::post('/update-category/{id}', [AdminController::class, 'categoryUpdate'])->name('category.update');
    Route::get('/delete-category/{id}', [AdminController::class, 'categoryDelete'])->name('category.delete');

    /* Post's Sections Route List */
    Route::get('/post', [AdminController::class, 'post'])->name('admin.post');
    Route::get('/add-post', [AdminController::class, 'addPost'])->name('add.post');
    Route::post('/post-post', [AdminController::class, 'postPost'])->name('post.post');
    Route::get('/edit-post/{id}', [AdminController::class, 'postEdit'])->name('post.edit');
    Route::post('/update-post/{id}', [AdminController::class, 'postUpdate'])->name('post.update');
    Route::get('/delete-post/{id}', [AdminController::class, 'postDelete'])->name('post.delete');
});

/* Editors Section Routes */
Route::prefix('user')->name('user.')->middleware('auth')->group(function(){
    /* Dashboard Route */
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    /* Post's Sections Route List */
    Route::get('/post',[HomeController::class, 'post'])->name('post');
    Route::get('/add-post',[HomeController::class, 'addPost'])->name('add-post');
    Route::post('/post-post',[HomeController::class, 'postPost'])->name('post-post');
    Route::get('/edit-post/{id}',[HomeController::class, 'editPost'])->name('edit-post');
    Route::post('/update-post/{id}',[HomeController::class, 'updatePost'])->name('update-post');
    Route::get('/delete-post/{id}',[HomeController::class, 'deletePost'])->name('delete-post');
    
    /* Profile Sections Route List */
    Route::get('/profile',[HomeController::class, 'getUserProfile'])->name('profile');
    Route::get('/edit-profile',[HomeController::class, 'editUserProfile'])->name('edit-profile');
    Route::post('/update-profile/{id}',[HomeController::class, 'updateUserProfile'])->name('update-profile');
});