<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $filter = $request->query('filter', 'without-trash'); // Default filter is 'without-trash'

    if ($filter === 'with-trash') {
        // Get only trashed (soft-deleted) records
        $skills = Skill::onlyTrashed()->get();
    } else {
        // Get only non-trashed records
        $skills = Skill::all();
    }

    return view('admin.skills.index', compact('skills', 'filter'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.skills.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
            'is_active' => 'required|boolean', // Ensure `is_active` is required
        ]);

        // Store the validated data
        Skill::create([
            'title' => $validated['title'],
            'percentage' => $validated['percentage'],
            'is_active' => $validated['is_active'], // Handle the checkbox input
        ]);

        return redirect()->route('skills.index')->with('success', 'Skill added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $skill = Skill::findOrFail($id);
        return view('admin.skills.edit', compact('skill')); // Display the edit form
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'percentage' => 'required|integer|min:0|max:100',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean', // Ensure the dropdown value is valid
    ]);

    // Update the skill attributes
    $skill->update([
        'title' => $request->title,
        'percentage' => $request->percentage,
        'description' => $request->description,
        'is_active' => $request->is_active, // Directly set `is_active` from the request
    ]);

    return redirect()->route('skills.index')->with('success', 'Skill updated successfully.');
}

    /**
     * Toggle the 'is_active' status.
     */
    public function toggleStatus($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->is_active = !$skill->is_active;
        $skill->save();

        return redirect()->route('skills.index')->with('success', 'Skill status updated successfully.');
    }

    /**
     * Restore a soft-deleted skill.
     */
    public function restore($id)
{
    $skill = Skill::onlyTrashed()->findOrFail($id);
    $skill->restore();

    return redirect()->route('skills.index', ['filter' => 'with-trash'])
                     ->with('success', 'Record restored successfully.');
}

    /**
     * Permanently delete a skill.
     */
    public function forceDelete($id)
{
    $skill = Skill::onlyTrashed()->findOrFail($id);
    $skill->forceDelete();

    return redirect()->route('skills.index', ['filter' => 'with-trash'])
                     ->with('success', 'Record permanently deleted.');
}


    /**
     * Soft delete a skill.
     */
    public function destroy($id)
{
    $skill = Skill::findOrFail($id);
    $skill->delete();

    return redirect()->route('skills.index')->with('success', 'Skills deleted successfully.');
}
}
