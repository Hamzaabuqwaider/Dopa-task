<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GenerateLinkController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/generate-link', [GenerateLinkController::class, 'generateLink']);
Route::get('/secure-content/{token}', [GenerateLinkController::class, 'validateSignedLink'])
    ->middleware(['used.links'])
    ->name('secure.content');
