<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MenuController;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModuleController;

Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/doctor', [PageController::class, 'doctor'])->name('doctor');
Route::get('/about', [PageController::class, 'aboutUs'])->name('about');

// Booking Routes
Route::get('/appointments/book', [AppointmentController::class, 'showDepartments'])->name('appointments.book');
Route::get('/appointments/doctors', [AppointmentController::class, 'selectDoctor'])->name('appointments.doctors.select');
Route::post('/appointments/time-slots/select', [AppointmentController::class, 'selectTimeSlots'])->name('appointments.time.slots.select'); // Changed to GET
Route::post('/appointments/patient-info/store', [AppointmentController::class, 'storeInfo'])->name('appointments.store.info');
Route::get('/appointments/patient-info', [AppointmentController::class, 'patientInfo'])->name('appointments.patient.info'); // Changed to GET


Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function() {

    Route::get('dashboard', function() {
        return view('dashboard');
    });

    Route::resource('user', UserController::class)->names('users');
    Route::resource('department', DepartmentController::class)->names('departments');
    Route::resource('doctor', DoctorController::class)->names('doctors');
    Route::resource('schedule', ScheduleController::class)->names('schedules');
    Route::resource('appointment', AppointmentController::class)->names('appointment');
    Route::resource('menus', MenuController::class)->names('menus');
    Route::get('/dynamic/menus/', [MenuController::class, 'showMenu'])->name('dynamic.menus.showMenu');
    Route::resource('modules', ModuleController::class)->names('modules');
    Route::resource('pages', PageController::class)->names('pages');

    Route::get('/schedules/bulk-edit/{doctorId}', [ScheduleController::class, 'bulkEdit'])->name('schedules.bulkEdit');
    Route::put('/schedules/bulk-update/{doctorId}', [ScheduleController::class, 'bulkUpdate'])->name('schedules.bulkUpdate');
    Route::delete('/schedules/bulk-delete/{doctorId}', [ScheduleController::class, 'bulkDestroy'])->name('schedules.bulkDestroy');
});


Route::get('/departments/{id}/doctors', [DoctorController::class, 'getDoctorsByDepartment'])->name('departments.doctors.index');
