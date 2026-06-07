<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminChapterController;
use App\Http\Controllers\Admin\AdminLevelController;
use App\Http\Controllers\Admin\AdminQuestionController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminSubChapterController;
use Illuminate\Support\Facades\Route;

// ── Public routes ────────────────────────────────────────────
Route::get('/',         [PageController::class, 'landing'])->name('landing');
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthController::class, 'register']);
Route::get('/privasi',  [PageController::class, 'privasi'])->name('privasi');

// ── Auth required ────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/home',      [PageController::class, 'home'])->name('home');
    Route::get('/chapter/{id}', [PageController::class, 'showChapter'])->name('chapter.show'); // ← BARU
    Route::get('/level/{id}', [PageController::class, 'showLevel'])->name('level.show');
    Route::post('/level/{id}/complete', [PageController::class, 'completeLevel'])->name('level.complete');
    Route::get('/materi',    [PageController::class, 'materi'])->name('materi');
    Route::get('/materi/aksara',  [PageController::class, 'materiAksara'])->name('materi.aksara');
    Route::get('/materi/ngoko',   [PageController::class, 'materiNgoko'])->name('materi.ngoko');
    Route::get('/materi/krama',   [PageController::class, 'materiKrama'])->name('materi.krama');
    Route::get('/materi/kosakata',[PageController::class, 'kosakata'])->name('materi.kosakata');
    Route::get('/materi/cerita',  [PageController::class, 'materiCerita'])->name('materi.cerita');
    Route::get('/peringkat', [PageController::class, 'peringkat'])->name('peringkat');

    Route::get('/profil',        [ProfilController::class, 'show'])->name('profil');
    Route::get('/profil/edit',   [ProfilController::class, 'edit'])->name('profil.edit');
    Route::post('/profil/update',[ProfilController::class, 'update'])->name('profil.update');
    Route::post('/profil/delete',[ProfilController::class, 'destroy'])->name('profil.delete');
    Route::get('/api/profil',    [ProfilController::class, 'apiGet'])->name('api.profil');
});

// ── Admin routes ─────────────────────────────────────────────
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Chapters CRUD
        Route::resource('chapters', AdminChapterController::class);

        // Sub-Chapters CRUD (nested, pakai chapter_id dari URL)
        Route::post('/chapters/{chapter}/sub-chapters',          [AdminSubChapterController::class, 'store'])->name('sub-chapters.store');
        Route::put('/chapters/{chapter}/sub-chapters/{sc}',      [AdminSubChapterController::class, 'update'])->name('sub-chapters.update');
        Route::delete('/chapters/{chapter}/sub-chapters/{sc}',   [AdminSubChapterController::class, 'destroy'])->name('sub-chapters.destroy');

        // Levels CRUD
        Route::resource('levels', AdminLevelController::class);

        // Questions CRUD
        Route::resource('questions', AdminQuestionController::class);

        // User management
        Route::get('/users',                         [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}',                  [AdminUserController::class, 'show'])->name('users.show');
        Route::patch('/users/{user}/toggle',         [AdminUserController::class, 'toggleStatus'])->name('users.toggle');
    });