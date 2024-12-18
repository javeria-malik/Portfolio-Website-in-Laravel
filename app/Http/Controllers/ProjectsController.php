<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import the Storage facade

class ProjectsController extends Controller
{
    // Display all projects
    
    public function index(Request $request)
{
    $filter = $request->query('filter', 'without-trash'); // Default filter is 'without-trash'

    if ($filter === 'with-trash') {
        // Get only trashed (soft-deleted) records
        $projects = Project::onlyTrashed()->get();
    } else {
        // Get only non-trashed records
        $projects = Project::all();
    }

    return view('admin.projects.index', compact('projects', 'filter'));
}

    // Show the form for creating a new project
    public function create()
    {
        return view('admin.projects.create');
    }
    protected function handleFileUpload(Request $request, $existingImage = null)
{
    // Check if a new image is uploaded
    if ($request->hasFile('image')) {
        // Delete the existing image if provided
        if ($existingImage && Storage::disk('public')->exists(str_replace('/storage/', '', $existingImage))) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $existingImage));
        }

        // Upload the new image
        $file = $request->file('image');
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                    . '_' . date('y-m-d_His')
                    . '.' . $file->getClientOriginalExtension();
        $imagePath = $file->storeAs('projects', $filename, 'public');

        return '/storage/' . $imagePath;
    }

    // Return the existing image if no new image is uploaded
    return $existingImage;
}


    // Store a new project
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'is_active' => 'required|boolean',
    ]);

    // Handle image upload
    $imagePath = $this->handleFileUpload($request);

    // Create the project
    $project = new Project();
    $project->title = $request->title;
    $project->category = $request->category;
    $project->image = $imagePath;
    $project->is_active = $request->is_active;
    $project->save();

    return redirect()->route('projects.index')->with('success', 'Project created successfully!');
}


    // Show the form for editing a project
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.edit', compact('project')); // Display the edit form
    }


    // Update a project
    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'is_active' => 'required|boolean',
    ]);

    $project = Project::find($id);
    if (!$project) {
        return redirect()->route('projects.index')->with('error', 'Project not found!');
    }

    // Handle image upload
    $imagePath = $this->handleFileUpload($request, $project->image);

    // Update the project
    $project->title = $request->title;
    $project->category = $request->category;
    $project->image = $imagePath;
    $project->is_active = $request->is_active;
    $project->save();

    return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
}



    public function toggleStatus($id)
    {
        $project = Project::findOrFail($id);
        $project->is_active = !$project->is_active;
        $project->save();
    
        return redirect()->route('projects.index')->with('success', 'Project status updated successfully.');    
    }


    public function restore($id)
{
    $project = Project::onlyTrashed()->findOrFail($id);
    $project->restore();

    return redirect()->route('projects.index', ['filter' => 'with-trash'])
                     ->with('success', 'Record restored successfully.');
}


public function forceDelete($id)
{
    $project = Project::onlyTrashed()->findOrFail($id);
    $project->forceDelete();

    return redirect()->route('projects.index', ['filter' => 'with-trash'])
                     ->with('success', 'Record permanently deleted.');
}



    // Delete a project
    /*public function destroy(Project $project)
    {
        // Delete image if it exists
        if ($project->image && Storage::disk('public')->exists(str_replace('/storage/', '', $project->image))) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $project->image));
        }
        

        // Delete the project
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }*/
    public function destroy($id)
{
   $project = Project::findOrFail($id);
   $project->delete();

    return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
}
    private function validateProject(Request $request)
{
    return $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'is_active' => 'required|boolean',
    ]);
}

}
