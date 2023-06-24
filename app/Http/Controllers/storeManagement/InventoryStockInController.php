<?php

namespace App\Http\Controllers\storeManagement;

use App\Http\Controllers\Controller;
use App\Models\InventoryItems;
use Illuminate\Http\Request;

class InventoryStockInController extends Controller
{
    public function stock_in(){
        return view('storeManagement.stockIn.index');
    }
    public function search(Request $request)
    {
        // Perform the search based on the input value
        $datas = InventoryItems::where('name', 'LIKE', "%{$request->search}%")->get();
        // Return the search results as a JSON response
        return response()->json($datas);
    }
}
