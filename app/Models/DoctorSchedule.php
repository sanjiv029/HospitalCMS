<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    use HasFactory;
    protected $table = 'doctor_schedules';
    protected $fillable = [
        'doctor_id',
        'department_id',
        'day_of_week'
,       'start_time',
        'end_time',
    ];
    public $time_slots = []; // Add this line to define time_slots

    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }
    public function appointments()
{
    return $this->hasMany(Appointment::class);
}


}
