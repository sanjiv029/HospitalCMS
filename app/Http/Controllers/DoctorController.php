<?php

namespace App\Http\Controllers;

use App\DataTables\DoctorsDataTable;
use App\Http\Requests\DoctorRequest;
use App\Models\Doctor;

use App\Models\Department;
class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DoctorsDataTable $dataTables)
    {
        return $dataTables->render('common.index', [
            'resourceName'=>'Doctors',
            'resourceRoute'=>'doctors',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view ('doctors.form', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorRequest $request)
    {
        $data= $request->all();
        if($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('profile_images'.'public');
        }
        Doctor::create($data);
        return redirect()->route('doctors.index')->with('Success','Doctor created Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctors.view', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $departments=Department::all();
        return view('doctors.form',compact('doctor','departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorRequest $request, string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $data = $request->all();
        if($request->hasFile('profile_image')){
            $data['profile_image']=$request->file('profile_image')->store('profile_image','public');
        }
        $doctor->update($data);
        return redirect()->route('doctors.index')->with('Success','Doctor Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctors.index')->with('Success','Doctor details deleted successfully');

    }
}
