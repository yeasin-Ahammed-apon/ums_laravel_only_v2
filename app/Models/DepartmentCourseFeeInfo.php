<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentCourseFeeInfo extends Model
{
    use HasFactory;
    public function department(){
        return $this->belongsTo(Deparment::class);
    }
}
