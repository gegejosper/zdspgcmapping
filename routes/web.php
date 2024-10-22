<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ScholarshipController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/campus', [FrontController::class, 'campus']);
Route::get('/', [FrontController::class, 'index']);
Route::get('/statistics', [FrontController::class, 'statistics']);

Route::middleware('auth')->name('panel.')->prefix('panel/')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('students', StudentController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('campuses', CampusController::class);
    Route::resource('scholarships', ScholarshipController::class);
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
