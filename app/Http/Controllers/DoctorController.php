<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\DataTables\DoctorsDataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use App\Http\Requests\DoctorRequest;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DoctorsDataTable $dataTables, Request $request)
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
        $provinces = DB::table('provinces')->get();
        $districts = DB::table('districts')->get();
        $municipality_types=DB::table('municipality_types')->get();
        $municipalities=DB::table('municipalities')->get();
        return view ('doctors.form', compact('departments','provinces','districts','municipality_types','municipalities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorRequest $request)
    {
        $data= $request->all();
        $doctor =Doctor::create($data);
        // Create a new user for login credentials
        User::create([
        'name' => $data['name'], // Assuming you have a name field
        'email' => $data['email'], // Assuming you have an email field
        'password' => Hash::make($data['password']), // Hash the password
        'doctor_id' => $doctor->id, // Optional: link to the doctor
         ]);
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
        $departments = Department::all();
        $provinces = DB::table('provinces')->get();
        $districts = DB::table('districts')->get();
        $municipality_types=DB::table('municipality_types')->get();
        $municipalities=DB::table('municipalities')->get();

        return view('doctors.form', compact('doctor', 'departments', 'provinces', 'districts', 'municipality_types', 'municipalities'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorRequest $request, string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $data = $request->all();
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

    public function getDoctorsByDepartment($departmentID) {
        $doctors = Doctor::where('department_id',$departmentID)->get();
        return view('departments.department-index', compact('doctors'));
    }
}
