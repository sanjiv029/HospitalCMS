<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'patients';
    protected $fillable = [
    'name',
    'department_id',
    'doctor_id',
    'phone',
    'gender',
    'age',
    'date_of_birth_ad',
    'date_of_birth_bs',
    'province_id',
    'district_id',
    'municipality_type_id',
    'municipality_id',
    'address',
    'ward_no',
    ];

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }

}
