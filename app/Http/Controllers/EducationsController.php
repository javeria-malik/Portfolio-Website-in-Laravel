<?php
namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationsController extends Controller
{
    // Show all education entries (Admin view)
    public function index(Request $request)
{
    $filter = $request->query('filter', 'without-trash'); // Default filter is 'without-trash'

    if ($filter === 'with-trash') {
        // Get only trashed (soft-deleted) records
        $educations = Education::onlyTrashed()->get();
    } else {
        // Get only non-trashed records
        $educations = Education::all();
    }

    return view('admin.educations.index', compact('educations', 'filter'));
}


    // Show the form to create a new education entry
    public function create()
    {
        return view('admin.educations.create');
    }

    // Store the new education entry
    public function store(Request $request)
    {
        $validated =$request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'start_year' => 'required|string|max:4',
            'end_year' => 'nullable|string|max:4',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean', // Allow `is_active` to be optional
        ]);

        Education::create([
            'degree' => $validated["degree"],
            'institution' => $validated["institution"],
            'start_year' => $validated ["start_year"],
            'end_year' => $validated["end_year"],
            'description' =>$validated["description"],
            'is_active' => $validated['is_active'], // Convert checkbox input
        ]);

        return redirect()->route('educations.index')->with('success', 'Education added successfully!');
    }

    // Show the form to edit an existing education entry
    public function edit($id)
{
    $education = Education::findOrFail($id);
    return view('admin.educations.edit', compact('education'));
}

    // Update an existing education entry
    public function update(Request $request, $id)
{
    $request->validate([
        'degree' => 'required|string|max:255',
        'institution' => 'required|string|max:255',
        'start_year' => 'required|string|max:4',
        'end_year' => 'nullable|string|max:4',
        'description' => 'nullable|string',
        'is_active' => 'required|boolean', // Corrected 'require' to 'required'
    ]);

    $education = Education::findOrFail($id);

    $education->degree = $request->degree;
    $education->institution = $request->institution;
    $education->start_year = $request->start_year;
    $education->end_year = $request->end_year;
    $education->description = $request->description;
    $education->is_active = $request->is_active;

    $education->save();

    return redirect()->route('educations.index')->with('success', 'Education updated successfully.');
}


    // Toggle the 'is_active' status
    public function toggleStatus($id)
{
    $education = Education::findOrFail($id);
    $education->is_active = !$education->is_active; // Toggle the status
    $education->save();

    return redirect()->route('educations.index')->with('success', 'Status updated successfully.');
}

 // Restore Method
public function restore($id)
{
    $education = Education::onlyTrashed()->findOrFail($id);
    $education->restore();

    return redirect()->route('educations.index', ['filter' => 'with-trash'])
                     ->with('success', 'Record restored successfully.');
}

// Force Delete Method
public function forceDelete($id)
{
    $education = Education::onlyTrashed()->findOrFail($id);
    $education->forceDelete();

    return redirect()->route('educations.index', ['filter' => 'with-trash'])
                     ->with('success', 'Record permanently deleted.');
}



    // Delete an education entry
    public function destroy($id)
{
    $education = Education::findOrFail($id);
    $education->delete();

    return redirect()->route('educations.index')->with('success', 'Education deleted successfully.');
}


}
