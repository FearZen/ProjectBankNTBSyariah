<?php
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccessFormController;
use App\Http\Controllers\DashboardController;
Route::get('/', function () {
    return view('create');
});

Route::get('/access_forms', [AccessFormController::class, 'index'])->name('access_forms.index');
Route::post('/access_forms', [AccessFormController::class, 'store'])->name('access_forms.store');
Route::get('/visitors', [VisitorController::class, 'index'])->name('visitors.index');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/visitors/{visitor}/edit', [VisitorController::class, 'edit'])->name('visitors.edit');
Route::put('/visitors/{visitor}', [VisitorController::class, 'update'])->name('visitors.update');
Route::delete('/visitors/{visitor}', [VisitorController::class, 'destroy'])->name('visitors.destroy');
// Menampilkan formulir
Route::get('/form/create', [AccessFormController::class, 'create'])->name('forms.create');

// Menyimpan formulir
Route::post('/form/store', [AccessFormController::class, 'store'])->name('forms.store');

