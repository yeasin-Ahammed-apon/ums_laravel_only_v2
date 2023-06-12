<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function student_infos(){
        return $this->hasOne(StudentInfo::class);
    }
    public function student_admint_infos(){
        return $this->hasOne(StudentAdmitInfo::class);
    }
    public function student_advance_amounts(){
        return $this->hasOne(StudentAdvanceAmount::class);
    }
    public function student_payment_histories(){
        return $this->hasOne(StudentPaymentHistory::class);
    }
    public function admit_batch(){
        return $this->hasOne(Batch::class,'id','admit_batch_id');
    }
    public function active_batch(){
        return $this->hasOne(Batch::class,'id','active_batch_id');
    }

}
