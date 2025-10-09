<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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

// Public Routes (Guest only)
Route::middleware('guest')->group(function () {
    Route::get('/', [UserController::class, 'showLoginForm'])->name('login');
    Route::get('/registerform', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Google OAuth Routes
Route::get('/auth-google-redirect', [AuthController::class, 'google_redirect'])->name('google.redirect');
Route::get('/auth-google-callback', [AuthController::class, 'google_callback'])->name('google.callback');

// Verification Routes (Accessible without full auth)
Route::get('/verify/{unique_id}', [AuthController::class, 'showverifyform'])->name('verify.show');
Route::put('/verify/{unique_id}', [AuthController::class, 'updateStatus'])->name('verify.update');

// Logout Route (Requires auth)
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// User Routes (Requires authentication, user role, and active status)
Route::middleware(['auth', 'check_role:user', 'check_status'])->group(function () {
    Route::get('/home', [UserController::class, 'index'])->name('home');
    Route::get('/trending', [UserController::class, 'trending'])->name('trending');
    Route::get('/community', [UserController::class, 'community'])->name('community');
    
    // Contribution Routes
    Route::post('/fund', [UserController::class, 'store_fund'])->name('fund.store');
    Route::post('/idea', [UserController::class, 'store_ideas'])->name('idea.store');
    Route::post('/designupload', [UserController::class, 'store_design'])->name('design.store');
    Route::post('/codeupload', [UserController::class, 'store_code'])->name('code.store');
    
    // Donation Routes
    Route::post('/donation/store/{id}', [UserController::class, 'donate'])->name('donation.store');
    Route::put('/donation/confirm/{id}', [UserController::class, 'confirmdonate'])->name('donation.confirm');
});

// Admin Routes (Requires authentication and admin role)
Route::middleware(['auth', 'check_role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/donation', [AdminController::class, 'donationpage'])->name('donation');
    Route::get('/contribution', [AdminController::class, 'contributionpage'])->name('contribution');
    Route::get('/user', [AdminController::class, 'userpage'])->name('user');
    Route::post('/donation/{id}/confirm', [AdminController::class, 'confirmPayment'])->name('donation.confirm');
});