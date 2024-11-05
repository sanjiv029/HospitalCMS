<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use App\DataTables\ModulesDataTable;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ModulesDataTable $dataTables)
    {
        return $dataTables->render('common.index', [
            'resourceName' => 'Modules',
            'resourceRoute' => 'modules',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.form', );
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:modules,slug',
        ]);

        // Create the module
        Module::create($request->only('title', 'slug'));

        return redirect()->route('modules.index')->with('success', 'Module created successfully.');
    }

    // Show the form for editing the specified module
    public function edit(Module $module)
    {
        return view('modules.form', compact('module')); // Return the edit view with the module data
    }

    // Update the specified module in storage
    public function update(Request $request, Module $module)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:modules,slug,' . $module->id,
        ]);

        // Update the module
        $module->update($request->only('title', 'slug'));

        return redirect()->route('modules.index')->with('success', 'Module updated successfully.');
    }

    // Remove the specified module from storage
    public function destroy(Module $module)
    {
        $module->delete(); // Delete the module

        return redirect()->route('modules.index')->with('success', 'Module deleted successfully.');
    }
}
