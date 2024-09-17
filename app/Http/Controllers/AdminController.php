<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campus;
use App\Models\Student;
use App\Models\Course;

class AdminController extends Controller
{
    //
    public function index() {
        $courses = Course::all();
        $students = Student::all();
        $campuses = Campus::all();
        return view('dashboard', compact('courses', 'students', 'campuses'));
    }
}
