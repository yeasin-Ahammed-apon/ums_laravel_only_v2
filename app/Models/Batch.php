<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    public function batchPaymentInfo(){
        return $this->hasOne(BatchPaymentInfo::class);
    }
    public function department(){
        return $this->hasOne(Deparment::class,'id','department_id');
    }

}
