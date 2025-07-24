<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPortfolioController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{portfolio}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

// Contact & About
Route::view('/contact', 'contact.index')->name('contact');
Route::view('/about', 'about.index')->name('about');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('home');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Booking Routes
    Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/history', [BookingController::class, 'history'])->name('booking.history');
    Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('booking.show');
    Route::patch('/booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');

    // Chat Routes
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Portfolio Management
    Route::resource('portfolios', AdminPortfolioController::class);
    Route::post('portfolios/{portfolio}/toggle-featured', [AdminPortfolioController::class, 'toggleFeatured'])
        ->name('portfolios.toggle-featured');

    // Booking Management
    Route::resource('bookings', AdminBookingController::class)->only(['index', 'show', 'update']);
    Route::patch('bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])
        ->name('bookings.update-status');

    // Service Management
    Route::resource('services', AdminServiceController::class);

    // Chat Management
    Route::get('chat', [ChatController::class, 'adminIndex'])->name('chat.index');
    Route::get('chat/{user}', [ChatController::class, 'adminShow'])->name('chat.show');
    Route::post('chat/{user}', [ChatController::class, 'adminReply'])->name('chat.reply');
});

require __DIR__.'/auth.php';
