<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get the number of doctors from the database
        $numberOfDoctors = Doctor::count();
        $numberOfDepartments =Department::count();
        $doctors = Doctor::with('department')->get();
        $departments = Department::all();
        return view('welcome', compact('numberOfDoctors','numberOfDepartments','doctors','departments'));
    }


}
