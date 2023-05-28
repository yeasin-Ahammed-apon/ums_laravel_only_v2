<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryStudent extends Model
{
    use HasFactory;
    public function batch(){
        return $this->belongsTo(Batch::class);
    }
}
