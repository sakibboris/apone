<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/blogs',[BlogController::class, 'index'])->name('blogs.index');
Route::get('/blog/create',[BlogController::class, 'create'])->name('blogs.create');
Route::post('/blog/store',[BlogController::class, 'store'])->name('blogs.store');
Route::get('/blogs/trashed',[BlogController::class, 'trashedIndex'])->name('blogs.trashedIndex');
Route::get('/blog/edit/{id}',[BlogController::class, 'edit'])->name('blogs.edit');
Route::put('/blog/update/{id}',[BlogController::class, 'update'])->name('blogs.update');
Route::get('/blog/recover/{id}',[BlogController::class, 'recover'])->name('blogs.recover');
Route::delete('/blog/trash/{id}',[BlogController::class, 'trash'])->name('blogs.trash');
Route::delete('/blog/{id}',[BlogController::class, 'delete'])->name('blogs.delete');
