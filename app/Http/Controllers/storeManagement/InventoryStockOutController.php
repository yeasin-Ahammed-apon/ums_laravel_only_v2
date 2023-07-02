<?php

namespace App\Http\Controllers\storeManagement;

use App\Http\Controllers\Controller;
use App\Models\InventoryItems;
use App\Models\InventoryStockInHistory;
use App\Models\InventoryStockInSlip;
use App\Models\InventoryStockOutHistory;
use App\Models\InventoryStockOutSlip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryStockOutController extends Controller
{

    private $data;
    private $datas;
    private $request;

    public function stock_out_user(Request $request)
    {
        $this->request = $request;
        $this->pageData = pageDataCheck($this->request);
        $this->datas = User::query()
            ->when($this->request->user, function ($query) {
                $query->where("login_id", 'LIKE', "%{$this->request->user}%")
                      ->orWhere("name", 'LIKE', "%{$this->request->user}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->pageData);
            $this->datas = queryAppend($this->request, $this->datas, ['pageData', 'search']);
            return view('storeManagement.stockOut.user', [
                'datas' => $this->datas,
                'pageData' => $this->pageData
            ]);
    }
    public function stock_out(Request $request)
    {
        $user = User::findOrFail($request->id);
        return view('storeManagement.stockOut.index', [
            'slipNumber' => time(),
            'user' => $user,

        ]);
    }
    public function stock_out_store(Request $request)
    {
        $items = json_decode($request->datas, true);
        $items = json_decode($items, true);
        $slipNumber = $request->slipNumber;
        $userId = $request->userId;
        $item_not_found = [];
        $item_not_updated = [];
        $item_not_save_in_history = [];
        $item_saved = [];
        // make new slip
        $slip = new InventoryStockOutSlip();
        $slip->user_id = Auth::user()->id;
        $slip->slip_number = $slipNumber;
        $slip->stock_out_for = $userId;
        $slip->save();
        if ($slip) { // slip created
            foreach ($items as $item) {
                $inventoryItems = InventoryItems::find($item['id']);
                if ($inventoryItems) {
                    $inventoryItems->quantity = $inventoryItems->quantity - intval($item['quantity']);
                    $inventoryItems->total_out = $inventoryItems->total_out + intval($item['quantity']);
                    $inventoryItems->save();
                    // dd($inventoryItems);
                    if ($inventoryItems) {
                        $inventoryStockOutHistory  =  new InventoryStockOutHistory();
                        $inventoryStockOutHistory->stock_out_slip_id  = $slip->id;
                        $inventoryStockOutHistory->inventory_item_id  = $item['id'];
                        $inventoryStockOutHistory->quantity  = intval($item['quantity']);
                        $inventoryStockOutHistory->save();
                        if ($inventoryStockOutHistory) {
                            $item_saved[] = $item['name'];
                        } else { // item that in insert history
                            $item_not_save_in_history[] = $item['name'];
                        }
                    } else { // item that not  saved
                        $item_not_updated[] = $item['name'];
                    }
                } else {
                    // item that not find found
                    $item_not_found[] = $item['name'];
                }
            }
        } else { // slip was not save , plz try agian later
            return response()->json([
                "status" =>  400,
                "massage" => "slip was not saved",
            ]);
        }
        return response()->json([
            "status" =>  200,
            "massage" => "Success",
            "item_not_found" => json_encode($item_not_found),
            "item_not_updated" => json_encode($item_not_updated),
            "item_not_save_in_history" => json_encode($item_not_save_in_history),
            "item_saved" => json_encode($item_saved),
        ]);
    }
    public function stock_out_history(Request $request)
    {
        $this->request = $request;
        $this->pageData = pageDataCheck($this->request); // make paginate data default
        $this->datas = InventoryStockOutSlip::query()
            ->when($this->request->search, function ($query) {
                $query->where('slip_number', 'LIKE', "%{$this->request->search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->pageData);

        $this->datas = queryAppend($this->request, $this->datas, ['pageData', 'seen', 'unseen', 'search']);
        return view("storeManagement.stockOut.history",
            [
                'datas' => $this->datas,
                'pageData' => $this->pageData
            ]
        );
    }
    public function stock_out_history_info(Request $request)
    {
        $this->datas =InventoryStockOutHistory::with('inventory_item')->where('stock_out_slip_id', $request->id)->get();
        // dd($this->datas);
        return response()->json($this->datas);
    }
    public function user_stock_out(Request $request)
    {
        $this->request = $request;
        $this->pageData = pageDataCheck($this->request);
        $this->datas = User::query()
            ->when($this->request->user, function ($query) {
                $query->where("login_id", 'LIKE', "%{$this->request->user}%")
                    ->orWhere("name", 'LIKE', "%{$this->request->user}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->pageData);
        $this->datas = queryAppend($this->request, $this->datas, ['pageData', 'search']);
        return view("storeManagement.stockOut.stockOutUser", [
            'datas' => $this->datas,
            'pageData' => $this->pageData
        ]);
    }
    public function user_stock_out_info(Request $request)
    {
        $id = $request->id;
        $this->request = $request;
        $this->pageData = 30;
        $user = User::findOrFail($id);
        $this->datas = InventoryStockOutSlip::where('user_id',$id)
            ->orderBy('created_at', 'desc')
            ->paginate($this->pageData);
        $this->datas = queryAppend($this->request, $this->datas, ['pageData', 'search','id']);
        return view('storeManagement.stockOut.stockOutUserHistory',[
            'user'=>$user,
            'datas'=>$this->datas,
            'pageData' => $this->pageData

        ]);

    }

}
