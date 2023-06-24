<?php

namespace App\Http\Controllers\storeManagement;

use App\Http\Controllers\Controller;
use App\Models\InventoryItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $data;
    protected $datas;
    protected $request;
    public function index(Request $request)
    {
        $this->request = $request;
        $this->pageData = pageDataCheck($this->request);
        $this->datas = InventoryItems::query()
            ->when($this->request->status === '1', function ($query) {
                $query->where('status', 1);
            })
            ->when($this->request->status === '0', function ($query) {
                $query->where('status', 0);
            })
            ->when($this->request->search, function ($query) {
                $query->where('name', 'LIKE', "%{$this->request->search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->pageData);

        $this->datas = queryAppend($this->request, $this->datas, ['pageData', 'seen', 'unseen', 'search']);
        return view(
            'storeManagement.items.list',
            [
                'datas' => $this->datas,
                'pageData' => $this->pageData
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('storeManagement.items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'max:255',
            'code' => 'string|max:255',
            'inventory_categories_id'=>'required'
        ]);
        $this->data = new InventoryItems();
        $this->data->name = $request->name;
        $this->data->description = $request->description;
        $this->data->code = $request->code;
        $this->data->inventory_categories_id = $request->inventory_categories_id;
        // $this->data->status = 1;
        $this->data->user_id = Auth::user()->id;
        $this->data->save();
        if (!$this->data) {
            fmassage('Fail', 'Inventory item is not save', 'error');
            return redirect()->back();
        }
        fmassage('Success', 'Inventory item is save', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data = InventoryItems::findOrFail($id);
        return view('storeManagement.items.show', ['data' => $this->data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data = InventoryItems::findOrFail($id);
        return view('storeManagement.items.edit', ['data' => $this->data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string|max:255',
        ]);
        $this->data = InventoryItems::findOrFail($id);
        $this->data->name = $request->name;
        $this->data->description = $request->description;
        $this->data->description = $request->description;
        $this->data->inventory_categories_id = $request->inventory_categories_id;
        $this->data->status = $request->status;
        $this->data->save();
        if (!$this->data) {
            fmassage('Fail', 'Inventory item is not save', 'error');
            return redirect()->back();
        }
        fmassage('Success', 'Inventory item is save', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->data = InventoryItems::findOrFail($id);
        $this->data->delete();
        if ($this->data) {
            fmassage('Success', 'Inventory Item Status deleted successfully', 'success');
            return redirect()->route('superAdmin.inventory.item.index');
        }
    }
    public function status($id)
    {
        $this->data = InventoryItems::findOrFail($id);
        $this->data->status = !$this->data->status;
        $this->data->save();
        fmassage('Success', 'Inventory item Status updated successfully', 'success');
        return redirect()->back();
    }
}
