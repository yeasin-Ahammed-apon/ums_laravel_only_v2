<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryStudentPaymentHistory extends Model
{
    use HasFactory;
    public function temporary_student(){
        return $this->belongsTo(TemporaryStudent::class);
    }
}
