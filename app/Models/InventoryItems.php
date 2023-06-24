<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItems extends Model
{
    use HasFactory;
    public function inventory_categories()
    {
        return $this->belongsTo(InventoryCategories::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
