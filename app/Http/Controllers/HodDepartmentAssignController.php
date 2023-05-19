<?php

namespace App\Http\Controllers;

use App\Models\HodDepartmentAssign;
use Illuminate\Http\Request;

class HodDepartmentAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $data;
    private $datas;
    private $pageData;
    private $request;
    public function index(Request $request)
    {
        $this->request = $request;
        $this->pageData = pageDataCheck($request); // make paginate data default
        $query = HodDepartmentAssign::with('hod');
        $query->whereHas('hod', function ($hod) {
            if ($this->request->status === '1') $hod->where('status', 1);
            elseif ($this->request->status === '0') $hod->where('status', 0);
            elseif ($this->request->search) {
                $hod->whereHas('user',function ($user){
                    $user->where('name', 'LIKE', "%{$this->request->search}%")
                    ->orWhere('login_id', 'LIKE', "%{$this->request->search}%");
                });
            }
        });
        $datas = $query->orderBy('created_at', 'desc')->paginate($this->pageData);
        return view('hodDepartmentAssign.list', [
            'datas' => $datas,
            'pageData' => $this->pageData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hodDepartmentAssign.create');
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
            'department_id' => 'required',
            'hod_id' => 'required',
        ]);
        $this->data = new HodDepartmentAssign();
        $this->data->department_id = $request->department_id;
        $this->data->hod_id = $request->hod_id;
        $this->data->save();
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HodDepartmentAssign  $hodDepartmentAssign
     * @return \Illuminate\Http\Response
     */
    public function show(HodDepartmentAssign $hodDepartmentAssign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HodDepartmentAssign  $hodDepartmentAssign
     * @return \Illuminate\Http\Response
     */
    public function edit(HodDepartmentAssign $hodDepartmentAssign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HodDepartmentAssign  $hodDepartmentAssign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HodDepartmentAssign $hodDepartmentAssign)
    {
        //
    }
    public function status(HodDepartmentAssign $hodDepartmentAssign){
        $this->data = $hodDepartmentAssign;
        $this->data->status = !$this->data->status;
        $this->data->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HodDepartmentAssign  $hodDepartmentAssign
     * @return \Illuminate\Http\Response
     */
    public function destroy(HodDepartmentAssign $hodDepartmentAssign)
    {
        //
    }
}
