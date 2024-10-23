<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor; // Ensure this is the correct path for your Doctor model
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
        // Pass the variable to the view
        return view('welcome', compact('numberOfDoctors','numberOfDepartments','doctors','departments'));
    }
}
