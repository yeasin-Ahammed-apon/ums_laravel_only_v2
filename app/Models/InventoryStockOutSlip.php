<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryStockOutSlip extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function inventoryStockOutHistory(){
        return $this->hasMany(InventoryStockOutHistory::class,'stock_out_slip_id','id');
    }
}
