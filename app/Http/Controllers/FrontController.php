<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campus;
use App\Models\Student;
use App\Models\Course;

class FrontController extends Controller
{
    public function index(){
        $campuses = Campus::all(['campus_name', 'map_color', 'address']);
        //$students = Student::with('course_details', 'campus_details', 'scholarship_details')->where('status', 'active')->get(['municipality', 'province', 'campus_id', 'course_id', 'scholarship_id']);
        $students = Student::with('course_details', 'campus_details', 'scholarship_details')
            ->where('status', 'active')
            ->get(['municipality', 'province', 'campus_id', 'course_id', 'scholarship_id'])
            ->groupBy(function($item) {
                return $item->municipality . ', ' . $item->province;
            });
        //dd($students);
        return view('welcome', compact('campuses', 'students'));
    }
    public function campus(){
        $campuses = Campus::all();
        return view('campus', compact('campuses'));
    }
    public function statistics(){
        $campuses = Campus::all();
        return view('statistics', compact('campuses'));
    }
    //
}
