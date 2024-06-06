<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ShortLinksController;


Route::get('/generate', [ShortLinksController::class, 'generate']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/links', [ShortLinksController::class, 'index']);
    Route::get('/links/create', [ShortLinksController::class, 'store'])->name('links');
    Route::get('/{code}', [ShortLinksController::class, 'show'])->name('links');
    Route::get('/{code}/delete', [ShortLinksController::class, 'delete'])->name('links');
    Route::put('/edit/{code}', [ShortLinksController::class, 'update'])->name('links');
});
