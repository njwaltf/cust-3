<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TypeController;
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

// Route::get('/', function () {
//     return view('login');
// });
// Route::get('/register', function () {
//     return view('register');
// });
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'auth']);
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/logout', [RegisterController::class, 'logout']);
Route::get('/dashboard', [DashboardController::class, 'index']);

Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::resource('/books', BookController::class);
    Route::resource('/bookings', BookingController::class);
    Route::resource('/types', TypeController::class);
    Route::get('/bookings/{id}', [BookingController::class, 'show']);
    Route::post('/bookings', [BookingController::class, 'store']);
    // profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('user-profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('user-profile-edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('user-profile-update');
});
Route::get('/qr/export/books', [BookController::class, 'exportPDF']);
Route::get('/qr/export/bookings', [BookingController::class, 'exportPDF']);
