<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlacesController;
use App\Http\Controllers\StripeController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('reviews', [PlacesController::class, 'getReviews']);
Route::post('create-payment-intent', [StripeController::class, 'createPaymentIntent']);
