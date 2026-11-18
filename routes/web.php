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
use App\Http\Controllers\PriceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $clinic = \App\Models\Clinic::first();
    $serviceSectionsAll = \App\Models\ServiceCategorySectionAll::with(['sections.categories'])->get();
    $servicesFilter = \App\Models\Service::whereHas('results')->get();
    $resultsList = \App\Models\ServiceResult::with('service')->latest()->get();
    $specialities = \App\Models\Speciality::whereHas('specialists')->get();
    $specialists = \App\Models\Specialist::with('specialities')->get();
    $projects = \App\Models\Project::with('images')->latest('date')->get();
    return view('index', compact('clinic', 'serviceSectionsAll', 'servicesFilter', 'resultsList', 'specialities', 'specialists', 'projects'));
});

// Услуги (чистая и логичная структура)
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/section/{slug?}', [ServiceController::class, 'sections'])->name('services.section');
Route::get('/services/category/{slug?}', [ServiceController::class, 'categories'])->name('services.category');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/service/{slug?}', fn($slug = null) => $slug ? redirect()->route('services.show', $slug, 301) : redirect()->route('services.index', [], 301))->name('services.show.alias');

// Алиасы для обратной совместимости старых путей
Route::get('/servicescategorysectionsall', fn() => redirect()->route('services.index', [], 301))->name('servicescategorysectionsalls');
Route::get('/servicescategorysections/{slug?}', fn($slug = null) => $slug ? redirect()->route('services.section', $slug, 301) : redirect()->route('services.index', [], 301))->name('servicescategorysections');
Route::get('/servicescategories/{slug?}', fn($slug = null) => $slug ? redirect()->route('services.category', $slug, 301) : redirect()->route('services.index', [], 301))->name('servicescategories');

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
Route::get('/prices', [PriceController::class, 'index'])->name('prices');
Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');
Route::get('/promotions/{slug}', [PromotionController::class, 'show'])->name('promotions.show');
Route::get('/offers', fn() => redirect()->route('promotions.index', [], 301))->name('offers');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
Route::get('/quesAns', [QuestionAnswerController::class, 'index'])->name('quesAns');
Route::get('/uncos', [UncoController::class, 'index'])->name('uncos');
Route::get('/uncos/{slug}', [UncoController::class, 'show'])->name('uncos.show');
Route::get('/documents', [DocumentController::class, 'index'])->name('documents');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/clinic', [ClinicController::class, 'index'])->name('clinic');

Route::get('/specialists', [SpecialistController::class, 'index'])->name('specialists');
Route::get('/specialists/{slug}', [SpecialistController::class, 'show'])->name('specialists.show');

// Русскоязычные пути art-medica.ru
Route::get('/spetcialisty', [SpecialistController::class, 'index']);
Route::get('/spetcialisty/{slug}', [SpecialistController::class, 'show']);
Route::get('/uslugi', [ServiceController::class, 'index']);
Route::get('/uslugi/{slug}', [ServiceController::class, 'show']);
Route::get('/price', [PriceController::class, 'index']);
Route::get('/aktcii', [PromotionController::class, 'index']);
Route::get('/aktcii/{slug}', [PromotionController::class, 'show']);
Route::get('/otzyvy', [ReviewController::class, 'index']);
Route::get('/o-klinike/dokumenty-kliniki', [DocumentController::class, 'index']);
Route::get('/o-klinike', [ClinicController::class, 'index']);
Route::get('/kontakty', [ContactController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
