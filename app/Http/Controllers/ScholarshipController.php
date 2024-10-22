<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Scholarship;

class ScholarshipController extends Controller
{
    //
    public function index(){
        $scholarships = Scholarship::all();
        return view('scholarships.scholarships', compact('scholarships'));
    }
    public function create(){
        return view('scholarships.create');
    }
    public function store(Request $request){
        //
        $request->validate([
            'scholarship_name' => 'required',
        ]);

        Scholarship::create($request->all());
        return redirect()->route('panel.scholarships.index')->with('success', 'scholarship created succesfully');
    }
    public function show(Scholarship $scholarship){
        $students = Student::where('course_id', $scholarship->id)->get();
        return view('scholarships.scholarship', compact('scholarship', 'students'));
    }
    public function edit(Scholarship $scholarship){
        return view('scholarships.edit', compact('scholarship'));
    }
    public function update(Request $request, Scholarship $scholarship){
        //
        $request->validate([
            'scholarship_name' => 'required'
        ]);

        $scholarship->update($request->only(['scholarship_name', 'status']));

        return redirect()->route('panel.scholarships.index')->with('success', 'scholarship updated successfully.');
    }
    public function destroy(Scholarship $scholarship){
        //
        $scholarship->delete();

        return redirect()->route('panel.scholarships.index')->with('success', 'scholarship deleted successfully.');
    }


}
