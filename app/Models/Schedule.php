<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
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

    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }

}
