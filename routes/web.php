<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', [BlogController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blog.create');
    Route::get('blogs/{blog}', [BlogController::class, 'show'])->name('detail');
    Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('edit');
    Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('update');
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('destroy');

});

require __DIR__.'/auth.php';
