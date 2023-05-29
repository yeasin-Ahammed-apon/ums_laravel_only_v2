<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deparment extends Model
{
    use HasFactory;
    public function faculty(){
        return $this->belongsTo(Faculty::class);
    }
    public function program(){
        return $this->belongsTo(Program::class);
    }
    public function hodDepartmentAssign()
    {
        return $this->hasMany(HodDepartmentAssign::class);
    }
    public function departmentCourseFeeInfo()
    {
        return $this->hasOne(DepartmentCourseFeeInfo::class);
    }
    public function departmentWaiver()
    {
        return $this->hasOne(DepartmentWaiver::class,'department_id','id');
    }
}
