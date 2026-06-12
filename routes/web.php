<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminChapterController;
use App\Http\Controllers\Admin\AdminLevelController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\AdminLibraryController;
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
Route::get('/forgot-password',  [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password',  [AuthController::class, 'resetPassword'])->name('password.update');
Route::get('/privasi',  [PageController::class, 'privasi'])->name('privasi');

// ── Auth required ────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/home',      [PageController::class, 'home'])->name('home');
    Route::get('/chapter/{id}', [PageController::class, 'showChapter'])->name('chapter.show');
    Route::get('/level/{id}', [PageController::class, 'showLevel'])->name('level.show');
    Route::post('/level/{id}/complete', [PageController::class, 'completeLevel'])->name('level.complete');
    Route::get('/materi',        [PageController::class, 'materi'])->name('materi');
    Route::get('/materi/{slug}', [PageController::class, 'materiShow'])->name('materi.show');
    Route::get('/peringkat', [PageController::class, 'peringkat'])->name('peringkat');

    // ── Profile ───────────────────────────────────────────────
    Route::get('/profil',          [ProfilController::class, 'show'])->name('profil');
    Route::get('/profil/edit',     [ProfilController::class, 'edit'])->name('profil.edit');
    Route::post('/profil/update',  [ProfilController::class, 'update'])->name('profil.update');
    Route::post('/profil/avatar',  [ProfilController::class, 'uploadAvatar'])->name('profil.avatar');
    Route::post('/profil/delete',  [ProfilController::class, 'destroy'])->name('profil.delete');
    Route::get('/api/profil',      [ProfilController::class, 'apiGet'])->name('api.profil');

    // ── Notifications API ─────────────────────────────────────
    Route::get('/api/notifications',               [NotificationController::class, 'index'])->name('api.notifications');
    Route::post('/api/notifications/read-all',     [NotificationController::class, 'markAllRead'])->name('api.notifications.read-all');
    Route::post('/api/notifications/{id}/read',    [NotificationController::class, 'markRead'])->name('api.notifications.read');

    // ── Guru (Teacher) routes ─────────────────────────────────
    Route::middleware(['guru'])->prefix('guru')->name('guru.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Guru\GuruDashboardController::class, 'index'])->name('dashboard');
        Route::post('/classrooms', [\App\Http\Controllers\Guru\GuruDashboardController::class, 'store'])->name('classrooms.store');
        Route::get('/classrooms/{id}', [\App\Http\Controllers\Guru\GuruDashboardController::class, 'show'])->name('classrooms.show');
        Route::delete('/classrooms/{id}', [\App\Http\Controllers\Guru\GuruDashboardController::class, 'destroy'])->name('classrooms.destroy');
        Route::get('/classrooms/{classId}/students/{studentId}', [\App\Http\Controllers\Guru\GuruDashboardController::class, 'studentProgress'])->name('classrooms.student-progress');
    });

    // ── Student classroom routes ──────────────────────────────
    Route::get('/classrooms', [\App\Http\Controllers\Student\StudentClassroomController::class, 'index'])->name('student.classrooms.index');
    Route::post('/classrooms/join', [\App\Http\Controllers\Student\StudentClassroomController::class, 'join'])->name('student.classrooms.join');
    Route::get('/classrooms/{id}', [\App\Http\Controllers\Student\StudentClassroomController::class, 'show'])->name('student.classrooms.show');
    Route::post('/classrooms/{id}/leave', [\App\Http\Controllers\Student\StudentClassroomController::class, 'leave'])->name('student.classrooms.leave');
});

// ── Admin routes ─────────────────────────────────────────────
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Chapters CRUD
        Route::resource('chapters', AdminChapterController::class);

        // Sub-Chapters CRUD
        Route::post('/chapters/{chapter}/sub-chapters',          [AdminSubChapterController::class, 'store'])->name('sub-chapters.store');
        Route::put('/chapters/{chapter}/sub-chapters/{sc}',      [AdminSubChapterController::class, 'update'])->name('sub-chapters.update');
        Route::delete('/chapters/{chapter}/sub-chapters/{sc}',   [AdminSubChapterController::class, 'destroy'])->name('sub-chapters.destroy');

        // Levels CRUD
        Route::resource('levels', AdminLevelController::class);

        // Questions CRUD
        Route::resource('questions', AdminQuestionController::class);

        // Libraries CRUD
        Route::resource('libraries', AdminLibraryController::class);

        // User management
        Route::get('/users',                         [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}',                  [AdminUserController::class, 'show'])->name('users.show');
        Route::patch('/users/{user}/toggle',         [AdminUserController::class, 'toggleStatus'])->name('users.toggle');

        // Notifications
        Route::get('/notifications',                 [AdminNotificationController::class, 'index'])->name('notifications.index');
        Route::get('/notifications/create',          [AdminNotificationController::class, 'create'])->name('notifications.create');
        Route::post('/notifications',                [AdminNotificationController::class, 'store'])->name('notifications.store');
        Route::delete('/notifications/{notification}', [AdminNotificationController::class, 'destroy'])->name('notifications.destroy');
    });