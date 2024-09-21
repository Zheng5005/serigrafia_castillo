<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::get('/home', [HomeController::class, 'index'])
->middleware(['auth', 'active'])
->name('home');

Route::get('/tazas', [HomeController::class, 'tazasindex'])
->middleware(['auth', 'active']);

Route::get('/banners', [HomeController::class, 'bannersindex'])
->middleware(['auth', 'active']);

Route::get('/camisas', [HomeController::class, 'camisasindex'])
->middleware(['auth', 'active']);

/*Route::get('post', [HomeController::class, 'post'])->middleware(['auth','admin']) */
Route::resource('/user',UserController::class)
->middleware(['auth','admin']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
