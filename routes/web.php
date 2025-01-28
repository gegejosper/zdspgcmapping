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


Route::get('/campuses/{campus_id}', [FrontController::class, 'campus']);
Route::get('/campuses', [FrontController::class, 'campuses']);
Route::get('/', [FrontController::class, 'index']);
Route::post('/filter_campus', [FrontController::class, 'filter_campus']);
Route::get('/statistics', [FrontController::class, 'statistics']);

Route::middleware('auth')->name('panel.')->prefix('panel/')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/filter_campus', [AdminController::class, 'filter_campus']);
    Route::resource('students', StudentController::class);
    Route::post('students/search', [AdminController::class, 'search_students']);
    Route::post('students/import', [StudentController::class, 'import'])->name('students.import');
    Route::resource('courses', CourseController::class);
    Route::resource('campuses', CampusController::class);
    Route::resource('scholarships', ScholarshipController::class);
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('statistics', [AdminController::class, 'statistics']);
});

require __DIR__.'/auth.php';
