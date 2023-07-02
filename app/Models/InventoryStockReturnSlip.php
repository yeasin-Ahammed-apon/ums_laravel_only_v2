<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryStockReturnSlip extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function inventoryStockReturnHistory(){
        return $this->hasMany(InventoryStockReturnHistory::class,'stock_return_slip_id','id');
    }
}
