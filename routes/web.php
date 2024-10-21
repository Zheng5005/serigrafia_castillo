<?php

use App\Http\Controllers\EmployeeOrderController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\CarsController;
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

/*User filter based on usertype*/
Route::get('/home', [HomeController::class, 'index'])
->middleware(['auth', 'active'])
->name('home');

/*--------------------------------------------------------------------------------------------------------------------------------------*/

/*Products view*/
Route::get('/tazas', [CarsController::class, 'tazasindex'])
->middleware(['auth', 'active'])
->name('tazas');

Route::get('/banners', [CarsController::class, 'bannersindex'])
->middleware(['auth', 'active'])
->name('banners');

Route::get('/camisas', [CarsController::class, 'camisasindex'])
->middleware(['auth', 'active'])
->name('camisas');

Route::controller(
    CarsController::class)->group(function () {
       Route::get('cars', 'index');
       Route::post('cars/createtazas', 'storetazas');

       Route::get('cars/{id}/edit', 'edit');
       Route::put('cars/{id}/edit', 'update');

       Route::get('cars/{id}/delete', 'destroy');
   });

/*History*/
Route::resource('/historial',HistorialController::class)
->middleware(['auth', 'active']);

/*--------------------------------------------------------------------------------------------------------------------------------------*/

/*User management*/
Route::resource('/user',UserController::class)
->middleware(['auth','admin']);

/*Order management (Admin)*/
Route::resource('/order',OrderController::class)
->middleware(['auth','admin']);

/*Order management (employee)*/
Route::resource('/order_employee',EmployeeOrderController::class)
->middleware(['auth', 'employee']);

/*--------------------------------------------------------------------------------------------------------------------------------------*/

/*Login with Breeze*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*Login with Google*/
Route::get('/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

require __DIR__.'/auth.php';
