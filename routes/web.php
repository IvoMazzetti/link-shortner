<?php

use App\Livewire\HandleMissingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectUrlController;
use App\Livewire\LinkRedirectController;
use App\Livewire\LinkShortnerForm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ShortLinksController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/dashboard', LinkRedirectController::class)->name('dashboard')->middleware(['auth', 'verified']);
Route::get('redirect/{url_code}', [RedirectUrlController::class, 'redirect']);

Route::get('/404', HandleMissingPageController::class)->name('404-code');
Route::get('/', LinkShortnerForm::class)->name('create-link');

