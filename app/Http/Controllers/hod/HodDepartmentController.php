<?php

namespace App\Http\Controllers\hod;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\HodDepartmentAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HodDepartmentController extends Controller
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
    public function batch($department_id){
        $this->datas = Batch::where('department_id',$department_id)->get();
        return view('hod.department.batch',[
            'datas' => $this->datas,
            'department_id' =>$department_id
        ]);
    }
    public function create($department_id){
        return view('hod.department.batch_create',[
            'department_id' =>$department_id
        ]);
    }
    public function store(Request $request,$department_id){
        $validatedData = $request->validate([
            'admission_start' => 'required',
            'admission_end' => 'required',
        ]);
        $last_created_batch = Batch::where('department_id',$department_id)->orderBy('created_at', 'desc')->first();
        if ($last_created_batch) {
            $last_created_batch = $last_created_batch->batch_number;
        }else {
            $last_created_batch = 0 ;
        }
        $this->data = new Batch();
        $this->data->department_id = $department_id;
        $this->data->batch_number = $last_created_batch+1;
        $this->data->admission_start = $request->admission_start;
        $this->data->admission_end = $request->admission_end;
        $this->data->save();

        fmassage('success','batch  created successfully','success');
        return redirect()->route('hod.batch.list',$department_id);
    }
}
