<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campus;
use App\Models\Student;
use App\Models\Course;

class FrontController extends Controller
{
    public function index(){

        return view('welcome');
    }
    public function campus(){
        $campuses = Campus::all();
        return view('campus', compact('campuses'));
    }
    //
}
