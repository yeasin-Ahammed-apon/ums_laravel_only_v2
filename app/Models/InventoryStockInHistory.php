<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryStockInHistory extends Model
{
    use HasFactory;
    public function inventory_item(){
        return $this->belongsTo(InventoryItems::class);
    }
    // public function inventoryStockInSlip(){
    //     return $this->hasMany(InventoryStockInSlip::class,'stock_in_slip_id');
    // }
}
