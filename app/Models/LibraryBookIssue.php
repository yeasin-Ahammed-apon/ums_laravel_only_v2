<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryBookIssue extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function taken_by(){
        return $this->belongsTo(User::class,'taken_by_id','id');
    }
    public function library_book(){
        return $this->belongsTo(LibraryBook::class);
    }
    public function library_book_copy(){
        return $this->belongsTo(LibraryBookCopy::class);
    }

}
