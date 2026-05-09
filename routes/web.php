<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfilController;
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
