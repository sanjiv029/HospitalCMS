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
    'date_of_birth_ad',
    'date_of_birth_bs',
    'gender',
    'marital_status',
    'profile_image',
    'status',
    'province_id',
    'district_id',
    'municipality_type_id',
    'municipality_id',
    'temporary_province_id',
    'temporary_district_id',
    'temporary_municipality_type_id',
    'temporary_municipality_id',
    ];


    public function department() {
        return $this->belongsTo(Department::class);
    }

   public function province() {
        return $this->belongsTo(Province::class);
    }
    public function district(){
        return $this->belongsTo(District::class);
    }
    public function municipality() {
        return $this->belongsTo(Municipality::class);
    }

    public function municipality_type() {
        return $this->belongsTo(Municipality_type::class);
    }
        public function temporaryProvince()
    {
        return $this->belongsTo(Province::class, 'temporary_province_id');
    }

    public function temporaryDistrict()
    {
        return $this->belongsTo(District::class, 'temporary_district_id');
    }

    public function temporaryMunicipality()
    {
        return $this->belongsTo(Municipality::class, 'temporary_municipality_id');
    }
    public function temporaryMunicipalityType()
    {
        return $this->belongsTo(Municipality::class, 'temporary_municipality_type_id');
    }


     public function experience() {
        return $this->hasMany(Experience::class);
    }

    public function education(){
        return $this->hasMany(Education::class);
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function schedules() {
        return $this->hasMany(DoctorSchedule::class);
    }
}

