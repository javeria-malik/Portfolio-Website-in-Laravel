<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $filter = $request->query('filter', 'without-trash'); // Default filter is 'without-trash'

    if ($filter === 'with-trash') {
        // Get only trashed (soft-deleted) records
        $services = Service::onlyTrashed()->get();
    } else {
        // Get only non-trashed records
        $services = Service::all();
    }

    return view('admin.services.index', compact('services', 'filter'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create'); // Display the create view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate input data
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'icon_class' => 'nullable|string|max:255',
        'is_active' => 'required|boolean', // Ensure is_active is required and boolean
    ]);

    // Create new service
    Service::create([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'icon_class' => $validated['icon_class'],
        'is_active' => $validated['is_active'], // Use validated data
    ]);

    return redirect()->route('services.index')->with('success', 'Service created successfully.');
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service')); // Display the edit form
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validate input data
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'icon_class' => 'nullable|string|max:255',
        'is_active' => 'required|boolean', // Allow `is_active` to be optional
    ]);
    
    // Find and update the service
    $service = Service::findOrFail($id);
    $service->title = $request->title;  // Correct assignment
    $service->description = $request->description;  // Correct assignment
    $service->icon_class = $request->icon_class;  // Correct assignment
    $service->is_active = $request->is_active;  // Correct assignment
    $service->save();  // Save changes to the database

    return redirect()->route('services.index')->with('success', 'Service updated successfully.');
}


    /**
     * Toggle the 'is_active' status.
     */
    public function toggleStatus($id)
    {
        $service = Service::findOrFail($id);
        $service->is_active = !$service->is_active;
        $service->save();
    
        return redirect()->route('services.index')->with('success', 'Service status updated successfully.');    }

    /**
     * Restore a soft-deleted service.
     */
    public function restore($id)
{
    $services = Service::onlyTrashed()->findOrFail($id);
    $services->restore();

    return redirect()->route('services.index', ['filter' => 'with-trash'])
                     ->with('success', 'Record restored successfully.');
}
     
    /**
     * Permanently delete a service.
     */
    public function forceDelete($id)
{
    $services = Service::onlyTrashed()->findOrFail($id);
    $services->forceDelete();

    return redirect()->route('services.index', ['filter' => 'with-trash'])
                     ->with('success', 'Record permanently deleted.');
}


    /**
     * Soft delete a service.
     */
    public function destroy($id)
{
    $services = Service::findOrFail($id);
    $services->delete();

    return redirect()->route('services.index')->with('success', 'Education deleted successfully.');
}
}
