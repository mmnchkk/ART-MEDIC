<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionAnswerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UncoController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PromotionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// Услуги (чистая и логичная структура)
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/section/{id?}', [ServiceController::class, 'sections'])->name('services.section');
Route::get('/services/category/{id?}', [ServiceController::class, 'categories'])->name('services.category');
Route::get('/service/{id?}', [ServiceController::class, 'show'])->name('services.show');

// Алиасы для обратной совместимости старых путей
Route::get('/servicescategorysectionsall', fn() => redirect()->route('services.index'))->name('servicescategorysectionsalls');
Route::get('/servicescategorysections/{id?}', fn($id = null) => $id ? redirect()->route('services.section', $id) : redirect()->route('services.index'))->name('servicescategorysections');
Route::get('/servicescategories/{id?}', fn($id = null) => $id ? redirect()->route('services.category', $id) : redirect()->route('services.index'))->name('servicescategories');
Route::get('/services/{id}', fn($id) => redirect()->route('services.show', $id))->name('services');

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');
Route::get('/promotions/{id}', [PromotionController::class, 'show'])->name('promotions.show');
Route::get('/offers', fn() => redirect()->route('promotions.index'))->name('offers');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
Route::get('/quesAns', [QuestionAnswerController::class, 'index'])->name('quesAns');
Route::get('/uncos', [UncoController::class, 'index'])->name('uncos');
Route::get('/uncos/{id}', [UncoController::class, 'show'])->name('uncos.show');
Route::get('/documents', [DocumentController::class, 'index'])->name('documents');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/clinic', [ClinicController::class, 'index'])->name('clinic');

Route::get('/specialists', [SpecialistController::class, 'index'])->name('specialists');
Route::get('/specialists/{id}', [SpecialistController::class, 'show'])->name('specialists.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
