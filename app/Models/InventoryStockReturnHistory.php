<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryStockReturnHistory extends Model
{
    use HasFactory;
    public function inventory_item(){
        return $this->belongsTo(InventoryItems::class);
    }
}
