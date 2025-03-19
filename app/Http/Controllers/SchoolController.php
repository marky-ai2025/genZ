<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schools = School::all(); // Fetch all records from the schools table
        return view('school.index', compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('school.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'abbr' => 'required|string|max:255',
            'brgy' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'prov' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'type',
        ]);

        School::create([
            'name' => $request->name,
            'abbr' => $request->abbr,
            'brgy' => $request->brgy,
            'city' => $request->city,
            'prov' => $request->prov,
            'contact' => $request->contact,
            'type' => $request->type,
        ]);
        return redirect('/school')->with('success', 'School Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(School $school)
    {
        return view('school.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School $school)
    {
        return view('school.edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, School $school)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'abbr' => 'required|string|max:255',
            'brgy' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'prov' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'type' ,
        ]);
        $school->update([
            'name' => $request->name,
            'abbr' => $request->abbr,
            'brgy' => $request->brgy,
            'city' => $request->city,
            'prov' => $request->prov,
            'contact' => $request->contact,
            'type' => $request->type,
        ]);
        return redirect('/school')->with('success', 'School Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {
        return view('school.destroy');
    }
}
