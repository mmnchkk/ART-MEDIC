<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionAnswerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UncoController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});


Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
Route::get('/quesAns', [QuestionAnswerController::class, 'index'])->name('quesAns');
Route::get('/uncos', [UncoController::class, 'index'])->name('uncos');
Route::get('/documents', [DocumentController::class, 'index'])->name('documents');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
