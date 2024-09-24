<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Experience extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'doctor_id',
        'job_title',
        'healthcare_facilities',
        'location',
        'type_of_employment',
        'start_date',
        'end_date',
        'certification',
        'additional_details',
    ];


    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
