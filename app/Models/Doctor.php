<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $table = 'doctors';
    protected $fillable = [
    'name',
    'department_id',
    'email',
    'phone',
    'address',
    'date_of_birth',
    'profile_image',
    'status',
    ];


    public function department() {
        return $this->belongsTo(Department::class);
    }

   /*  public function province() {
        return $this->belongsTo(Province::class);
    }
    public function district(){
        return $this->belongsTo(District::class);
    }
    public function municipality() {
        return $this->belongsTo(Municipality::class);
    } */



    /* public function experience() {
        return $this->hasMany(Experience::class);
    }

    public function education(){
        return $this->hasMany(Education::class);
    } */
}

