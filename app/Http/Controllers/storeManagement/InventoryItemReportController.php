<?php

namespace App\Http\Controllers\storeManagement;

use App\Http\Controllers\Controller;
use App\Models\InventoryItems;
use App\Models\InventoryStockInHistory;
use App\Models\InventoryStockOutHistory;
use App\Models\InventoryStockReturnHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InventoryItemReportController extends Controller
{
    public function report(InventoryItems $item)
    {
        return view('storeManagement.items.report', [
            'data' => $item
        ]);
    }
    public function report_info(InventoryItems $item, $day, $type, Request $request)
    {
        $pageData = 50;
        $datas = null;
        $query = null;
        if ($type === 'stock_all') {
            if ($day === '0') {
                $stockIn = InventoryStockInHistory::where('inventory_item_id', $item->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate($pageData, ['*'], 'stock_in');
                $stockOut = InventoryStockOutHistory::where('inventory_item_id', $item->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate($pageData, ['*'], 'stock_out');
                $stockReturn = InventoryStockReturnHistory::where('inventory_item_id', $item->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate($pageData, ['*'], 'stock_return');
            } else {
                $stockIn = InventoryStockInHistory::where('inventory_item_id', $item->id)
                    ->whereDate('created_at', '>=', Carbon::now()->subDays($day))
                    ->orderBy('created_at', 'desc')
                    ->paginate($pageData, ['*'], 'stock_in');
                $stockOut = InventoryStockOutHistory::where('inventory_item_id', $item->id)
                    ->whereDate('created_at', '>=', Carbon::now()->subDays($day))
                    ->orderBy('created_at', 'desc')
                    ->paginate($pageData, ['*'], 'stock_out');
                $stockReturn = InventoryStockReturnHistory::where('inventory_item_id', $item->id)
                    ->whereDate('created_at', '>=', Carbon::now()->subDays($day))
                    ->orderBy('created_at', 'desc')
                    ->paginate($pageData, ['*'], 'stock_return');
            }
            $stockIn = queryAppend($request, $stockIn, ['stock_in', 'stock_out', 'stock_return']);
            $stockOut = queryAppend($request, $stockOut, ['stock_in', 'stock_out', 'stock_return']);
            $stockReturn = queryAppend($request, $stockReturn, ['stock_in', 'stock_out', 'stock_return']);

            return view('storeManagement.items.report_info_all', [
                'stockIn' => $stockIn,
                'stockOut' => $stockOut,
                'stockReturn' => $stockReturn,
            ]);
        }
        if ($type === 'stock_in') {
            $query = InventoryStockInHistory::where('inventory_item_id', $item->id);
        } elseif ($type === 'stock_out') {
            $query = InventoryStockOutHistory::where('inventory_item_id', $item->id);
        } elseif ($type === 'stock_return') {
            $query = InventoryStockReturnHistory::where('inventory_item_id', $item->id);
        }

        $datas = ($day === '0')
            ? $query->orderBy('created_at', 'desc')->paginate($pageData)
            : $query->whereDate('created_at', '>=', Carbon::now()->subDays($day))
            ->orderBy('created_at', 'desc')->paginate($pageData);

        return view('storeManagement.items.report_info', ['datas' => $datas]);
    }
}
