<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'gender',
        'age',
        'phone_number',
        'address',
        'email',
        'medical_history',
    ];

    // Relationship with Appointments
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
