<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentsController;
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

Route::get('/home',[App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/comments',[CommentsController::class,'index'])->name('comments');
Route::get('/create',[CommentsController::class,'create'])->name('create');
Route::post('/create',[CommentsController::class,'store'])->name('store');
Route::get('/delete/{id}',[CommentsController::class,'destroy'])->name('delete');
Route::get('/edit/{id}', [CommentsController::class,'edit'])->name('edit');
Route::put('/update/{id}', [CommentsController::class,'update'])->name('update');


Route::get('/thread/{id}',[CommentsController::class,'create_thread'])->name('create_thread');
Route::post('/thread/{id}',[CommentsController::class,'store_thread'])->name('store_thread');
Route::get('/edit_thread/{id}', [CommentsController::class,'edit_thread'])->name('edit_thread');
Route::put('/update_thread/{id}', [CommentsController::class,'update_thread'])->name('update_thread');
Route::get('/delete_thread/{id}',[CommentsController::class,'destroy_thread'])->name('delete_thread');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
