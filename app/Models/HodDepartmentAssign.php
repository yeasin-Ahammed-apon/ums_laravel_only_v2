<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HodDepartmentAssign extends Model
{
    use HasFactory;
    public function hod(){
        return $this->belongsTo(Hod::class);
    }
    public function department(){
        return $this->belongsTo(Deparment::class);
    }
}
