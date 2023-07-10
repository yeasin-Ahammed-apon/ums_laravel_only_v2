<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryBook extends Model
{
    use HasFactory;
    public function library_categorie(){
        return $this->belongsTo(LibraryCategories::class);
    }
    public function department(){
        return $this->belongsTo(deparment::class);
    }
    // public function library_book(){
    //     return $this->hasMany(LibraryBookCopy::class);
    // }
}
