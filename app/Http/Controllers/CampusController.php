<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use App\Models\Campus;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campuses = Campus::all();
        return view('campuses.campuses', compact('campuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('campuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'campus_name' => 'required',
            'address' => 'required',
            'map_color' => 'required',
        ]);

        Campus::create($request->all());
        return redirect()->route('panel.campuses.index')->with('success', 'Campus created succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Campus $campus){
        $students = Student::where('campus_id', $campus->id)->get();
        return view('campuses.campus', compact('campus', 'students'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campus $campus)
    {
        return view('campuses.edit', compact('campus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campus $campus)
    {
        $request->validate([
            'campus_name' => 'required',
            'address' => 'required',
            'map_color' => 'required',
        ]);

        $campus->update($request->only(['course_name', 'address', 'map_color']));

        return redirect()->route('panel.campuses.index')->with('success', 'Campus updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campus $campus)
    {
        $campus->delete();

        return redirect()->route('panel.campuses.index')->with('success', 'Campus deleted successfully.');
    }
}
