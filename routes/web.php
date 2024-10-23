<?php

use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/booking',[HomeController::class,'booking'])->name('booking');

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function(){

    Route::get('dashboard', function(){
        return view('dashboard');
    });
    Route::resource('user', UserController::class)->names('users');
    Route::resource('department', DepartmentController::class)->names('departments');
    Route::resource('doctor', DoctorController::class)->names('doctors');
    Route::resource('schedule',ScheduleController::class)->names('schedules');
    Route::get('/schedules/bulk-edit/{doctorId}', [ScheduleController::class, 'bulkEdit'])->name('schedules.bulkEdit');
    Route::put('/schedules/bulk-update/{doctorId}', [ScheduleController::class, 'bulkUpdate'])->name('schedules.bulkUpdate');
    Route::delete('/schedules/bulk-delete/{doctorId}', [ScheduleController::class, 'bulkDestroy'])->name('schedules.bulkDestroy');
});

Route::get('/departments/{id}/doctors', [DoctorController::class, 'getDoctorsByDepartment'])->name('departments.doctors.index');
