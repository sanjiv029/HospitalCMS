<?php

namespace App\Http\Controllers;

use App\DataTables\DepartmentsDataTable;
use App\Http\Requests\DepartmentRequest;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index(DepartmentsDataTable $dataTable)
        {
            return $dataTable->render('common.index', [
                'resourceName' => 'Departments',
                'resourceRoute' => 'departments',
            ]);
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.form');
    }

    public function store(DepartmentRequest $request)
    {

        Department::create($request->all());

        return redirect()->route('departments.index')
                         ->with('Success', 'Department created successfully.');
    }

    public function show(Department $department)
    {
        return view('departments.view', compact('department'));
    }

    public function edit(Department $department)
    {
        return view('departments.form', compact('department'));
    }

    public function update(DepartmentRequest $request, Department $department)
    {

        $department->update($request->all());

        return redirect()->route('departments.index')
                         ->with('Success', 'Department updated successfully.');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')
                         ->with('Success', 'Department deleted successfully.');
    }
}
