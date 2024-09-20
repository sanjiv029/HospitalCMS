<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function(){

    Route::get('dashboard', function(){
        return view('dashboard');
    });
    Route::resource('user', UserController::class)->names('users');
    Route::resource('department', DepartmentController::class)->names('departments');
    Route::resource('doctor', DoctorController::class)->names('doctors');

});

