<?php

use App\Http\Middleware\Authenticate;
use App\Monuments\Contacts\Controllers\Admin\ContactController;
use App\Monuments\Gallery\Controllers\Admin\GalleryController;
use App\Monuments\Reviews\Controllers\Admin\ReviewsController;
use App\Monuments\Services\Controllers\Admin\ServicesController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');

Route::middleware(Authenticate::class)
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::name('contact.')->prefix('contact')->group(function () {
            Route::get('/', [ContactController::class, 'index'])->name('index');
            Route::post('/', [ContactController::class, 'store'])->name('store');
            Route::get('/{id}', [ContactController::class, 'show'])->name('show');
            Route::put('/{id}', [ContactController::class, 'update'])->name('update');
            Route::delete('/{id}', [ContactController::class, 'delete'])->name('delete');
        });
        Route::name('services.')->prefix('services')->group(function () {
            Route::get('/', [ServicesController::class, 'index'])->name('index');
            Route::post('/', [ServicesController::class, 'store'])->name('store');
            Route::get('/{id}', [ServicesController::class, 'show'])->name('show');
            Route::put('/{id}', [ServicesController::class, 'update'])->name('update');
            Route::delete('/{id}', [ServicesController::class, 'delete'])->name('delete');
        });
        Route::name('gallery.')->prefix('gallery')->group(function () {
            Route::get('/', [GalleryController::class, 'index'])->name('index');
            Route::post('/', [GalleryController::class, 'store'])->name('store');
            Route::get('/{id}', [GalleryController::class, 'show'])->name('show');
            Route::put('/{id}', [GalleryController::class, 'update'])->name('update');
            Route::delete('/{id}', [GalleryController::class, 'delete'])->name('delete');
        });
        Route::name('reviews.')->prefix('reviews')->group(function () {
            Route::get('/', [ReviewsController::class, 'index'])->name('index');
            Route::post('/', [ReviewsController::class, 'store'])->name('store');
            Route::get('/{id}', [ReviewsController::class, 'show'])->name('show');
            Route::put('/{id}', [ReviewsController::class, 'update'])->name('update');
            Route::delete('/{id}', [ReviewsController::class, 'delete'])->name('delete');
        });
    });
