<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use App\Models\Campus;
use App\Models\Scholarship;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::orderBy('last_name', 'asc')
                        ->orderBy('first_name', 'asc')
                        ->with('course_details')->paginate(200);
       //dd($students);
        return view('students.students', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::where('status', 'active')->get();
        $campuses = Campus::get();
        $scholarships = Scholarship::where('status', 'active')->get();
        return view('students.create', compact('courses', 'scholarships', 'campuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'municipality' => 'required',
            'last_name' => 'required',
            'province' => 'required',
            'course_id' => 'required',
            'campus_id' => 'required',
            'scholarship_id' => 'required',
            'year' => 'required',
            'status' => 'required',
        ]);

        Student::create($request->all());
        return redirect()->route('panel.students.index')->with('success', 'Student created succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.student', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $courses = Course::where('status', 'active')->get();
        $campuses = Campus::get();
        $scholarships = Scholarship::where('status', 'active')->get();
        return view('students.edit', compact('student', 'courses',  'scholarships', 'campuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'required',
            'municipality' => 'required',
            'last_name' => 'required',
            'province' => 'required',
            'course_id' => 'required',
            'campus_id' => 'required',
            'scholarship_id' => 'required',
            'year' => 'required',
            'status' => 'required',
        ]);

        $student->update($request->only(
            [
                'first_name', 
                'middle_name', 
                'last_name', 
                'course_id', 
                'municipality',
                'province',
                'campus_id',
                'scholarship_id',
                'year',
                'status',
                'address'

            ]));

        return redirect()->route('panel.students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
        $student->delete();

        return redirect()->route('panel.students.index')->with('success', 'Student deleted successfully.');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new StudentsImport, $request->file('file'));

        return back()->with('success', 'Students imported successfully!');
    }
    
}
