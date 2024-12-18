<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperiencesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $filter = $request->query('filter', 'without-trash'); // Default filter is 'without-trash'

    if ($filter === 'with-trash') {
        // Get only trashed (soft-deleted) records
        $experiences = Experience::onlyTrashed()->get();
    } else {
        // Get only non-trashed records
        $experiences = Experience::all();
    }

    return view('admin.experiences.index', compact('experiences', 'filter'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.experiences.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'required|boolean',
        ]);

        Experience::create([
            'title' => $validated['title'],
            'company' => $validated['company'],
            'position'=> $validated['position'],
            'description' =>$validated['description'],
            'start_date' =>$validated['start_date'],
            'end_date' =>$validated['end_date'],
            'is_active' => $validated['is_active'], // Handle the checkbox input
        ]);

        return redirect()->route('experiences.index')->with('success', 'Experience added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $experience = Experience::findOrFail($id);
    return view('admin.experiences.edit', compact('experience'));
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_active' => 'required|boolean',
        ]);
        $experience = Experience::findOrFail($id);

        
            $experience->title = $request->title;
            $experience->company=$request->company;
            $experience->position=$request->position;
            $experience->description=$request->description;
            $experience->start_date=$request->start_date;
            $experience->end_date=$request->end_date;
            $experience->is_active=$request->is_active;
            $experience->save();

       

        return redirect()->route('experiences.index')->with('success', 'Experience updated successfully!');
    }

    /**
     * Toggle the 'is_active' status.
     */
    public function toggleStatus($id)
    {
        $experience = Experience::findOrFail($id);
        $experience->is_active = !$experience->is_active;
        $experience->save();

        return redirect()->route('experiences.index')->with('success', 'Experience status updated successfully.');
    }

    /**
     * Restore a soft-deleted experience.
     */
    public function restore($id)
{
    $experiences = Experience::onlyTrashed()->findOrFail($id);
    $experiences->restore();

    return redirect()->route('experiences.index', ['filter' => 'with-trash'])
                     ->with('success', 'Record restored successfully.');
}


    /**
     * Permanently delete an experience.
     */
    public function forceDelete($id)
{
    $experiences = Experience::onlyTrashed()->findOrFail($id);
    $experiences->forceDelete();

    return redirect()->route('experiences.index', ['filter' => 'with-trash'])
                     ->with('success', 'Record permanently deleted.');
}

    /**
     * Soft delete an experience.
     */
    public function destroy($id)
    {
        $experiences = Experience::findOrFail($id);
        $experiences->delete();

        return redirect()->route('experiences.index')->with('success', 'Experience soft deleted successfully.');
    }
}
