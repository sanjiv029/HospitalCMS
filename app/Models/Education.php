<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'education';

    protected $fillable = [
        'doctor_id',
        'degree',
        'institution',
        'field_of_study',
        'start_year',
        'end_year',
        'certification',
        'additional_details',
    ];


    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
