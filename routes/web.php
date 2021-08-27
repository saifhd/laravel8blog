<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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




require __DIR__.'/auth.php';

//Routes for Laravel Socialite
Route::get('login/google', 'App\Http\Controllers\Auth\LoginController@redirectToGoogle')->name('google.login');
Route::get('login/google/callback', 'App\Http\Controllers\Auth\LoginController@handleGoogleCallback');
//end of laravel socialite

// email verification
Route::get('/email/verify',[App\Http\Controllers\Auth\EmailVerificationNotificationController::class,'index'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}',[App\Http\Controllers\Auth\EmailVerificationNotificationController::class,'verify'])->middleware(['auth','signed'])->name('verification.verify');
Route::post('/email/verification-notification',[App\Http\Controllers\Auth\EmailVerificationNotificationController::class,'verificationSend'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
// end of email verification

//Posts Before Authentication DashBoard
Route::get('/',[App\Http\Controllers\PostController::class , 'index'])->name('posts');
Route::get('preview/{id:slug}',[App\Http\Controllers\PostController::class ,'preview'])->name('posts.preview');
//end of Posts Before Authentication DashBoard

//Route protection for auth and must verify email
Route::middleware(['auth','verified','status'])->group(function () {
//Posts Routes After Authentication
    Route::get('/posts/create/',[App\Http\Controllers\PostController::class ,'create'])->name('posts.create.view');
    Route::post('/posts',[App\Http\Controllers\PostController::class ,'store'])->name('posts.store');
    Route::get('/posts',[App\Http\Controllers\PostController::class ,'UsersPosts'])->name('posts.myposts');
    //protect posts route from Other Users action
    Route::middleware(['posts'])->group(function () {
        Route::get('/posts/{slug}',[App\Http\Controllers\PostController::class ,'edit'])->name('posts.edit');
        Route::put('/posts/{id}',[App\Http\Controllers\PostController::class ,'update'])->name('posts.update');
        Route::delete('/posts/{id}',[App\Http\Controllers\PostController::class ,'delete'])->name('posts.delete');
    });
//End Posts Routes

//Category Routes After Authentication
    Route::get('/categories',[App\Http\Controllers\CategoryController::class ,'index'])->name('categories');
    Route::get('/categories/create',[App\Http\Controllers\CategoryController::class ,'create'])->name('categories.create');
    Route::post('/categories',[App\Http\Controllers\CategoryController::class ,'store'])->name('categories.store');

    Route::middleware(['is_admin'])->group(function () {
        Route::get('/categories/{slug}',[App\Http\Controllers\CategoryController::class ,'edit'])->name('categories.edit');
        Route::put('/categories/{id}',[App\Http\Controllers\CategoryController::class ,'update'])->name('categories.update');
        Route::delete('/categories/{id}',[App\Http\Controllers\CategoryController::class ,'delete'])->name('categories.delete');
    });
//End Category Routes
});
//end of Route protection for auth and must verify email


//Belove Routes are accessible only for admin=1,status=1,email verified,authenticated users
Route::middleware(['is_admin','auth','verified','status'])->group(function () {
//newsletters
    Route::get('/newsletter',[App\Http\Controllers\NewsLetterController::class ,'index'])->name('newsletter');
    Route::post('/newsletter',[App\Http\Controllers\NewsLetterController::class ,'store'])->name('newsletter.store');
    Route::delete('/newsletter/{id}',[App\Http\Controllers\NewsLetterController::class ,'delete'])->name('newsletter.delete');
//end newsletters

//users
    Route::get('/users',[App\Http\Controllers\UserController::class ,'index'])->name('users');
    Route::put('/users/status/{id}',[App\Http\Controllers\UserController::class ,'statusUpdate'])->name('users.status');
    Route::put('/users/admin/{id}',[App\Http\Controllers\UserController::class ,'adminUpdate'])->name('users.admin');
//endusers
//Profile Page Routes
    Route::get('/profile/show',[App\Http\Controllers\UserController::class , 'showProfile'])->name('profile.show');
    Route::Post('/profile/update',[App\Http\Controllers\UserController::class , 'updateProfile'])->name('profile.update');
//End Profile Page
});





