<?php

use App\Monuments\Contacts\Controllers\ContactController;
use App\Monuments\Gallery\Controllers\GalleryController;
use App\Monuments\Reviews\Controllers\ReviewsController;
use App\Monuments\Services\Controllers\ServicesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'contact' => ContactController::class,
    'services' => ServicesController::class,
    'gallery' => GalleryController::class,
    'reviews' => ReviewsController::class,
]);
