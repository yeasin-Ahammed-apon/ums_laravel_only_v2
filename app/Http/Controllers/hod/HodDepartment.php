<?php

namespace App\Http\Controllers\hod;

use App\Http\Controllers\Controller;
use App\Models\HodDepartmentAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HodDepartment extends Controller
{
    private $data;
    private $datas;
    private $pageData;
    public function department(Request $request)
    {
        $this->pageData = pageDataCheck($request); // make paginate data default
        $hod_id = Auth::user()->hod->id;
        $this->datas = HodDepartmentAssign::where('hod_id', $hod_id)
                            ->where('status', 1)
                            ->orderBy('created_at', 'desc')
                            ->paginate($this->pageData);
        return view('hod.department.list',[
            'datas' => $this->datas,
            'pageData' => $this->pageData
        ]);
    }
    public function batch(){

        return view('hod.department.batch');
    }
}
