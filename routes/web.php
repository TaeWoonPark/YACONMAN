<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;


Route::get('/tasks', function () {
    return view('tasks'); // tasks.blade.php を表示
});


// ダッシュボード（認証あり）
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// プロフィール関連
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// タスクページ（Livewire）
Route::get('/tasks', function () {
    return view('tasks'); // Blade で Livewire を呼ぶ
})->name('tasks');

require __DIR__ . '/auth.php';
