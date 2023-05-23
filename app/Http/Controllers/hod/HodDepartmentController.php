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
        return view('hod.department.department_list', [
            'datas' => $this->datas,
            'pageData' => $this->pageData
        ]);
    }
    public function active_list($department_id)
    {
        $active_batch = Batch::where('department_id', $department_id)
        ->where('status', 1)
        ->orderBy('created_at', 'desc')
        ->get();
        return view('hod.department.active_batch', [
            'active_batch' => $active_batch,
            'department_id' => $department_id
        ]);
    }
    public function active_batch($department_id, $batch){
        $this->data = Batch::where('department_id',$department_id)->findOrFail($batch);
        $this->data->status = 1;
        $this->data->save();
        return redirect()->route('hod.batch.active.list',$department_id);
    }
    public function admission_list($department_id)
    {
        $admission_batch = Batch::where('department_id', $department_id)
        ->where('status', 0)
        ->orderBy('created_at', 'desc')
        ->get();
        return view('hod.department.admission_batch', [
            'admission_batch' => $admission_batch,
            'department_id' => $department_id
        ]);
    }
    public function completed_list($department_id)
    {
        $completed_batch = Batch::where('department_id', $department_id)->where('status', 2)->get();
        return view('hod.department.completed_batch', [
            'completed_batch' => $completed_batch,
            'department_id' => $department_id
        ]);
    }
    public function completed_batch($department_id, $batch){
        $this->data = Batch::where('department_id',$department_id)->findOrFail($batch);
        $this->data->status = 2;
        $this->data->save();
        return redirect()->route('hod.batch.completed.list',$department_id);
    }

    public function create($department_id)
    {
        return view('hod.department.batch_create', [
            'department_id' => $department_id
        ]);
    }
    public function store(Request $request, $department_id)
    {
        $validatedData = $request->validate([
            'admission_start' => 'required',
            'admission_end' => 'required',
        ]);
        $last_created_batch = Batch::where('department_id', $department_id)->orderBy('created_at', 'desc')->first();
        if ($last_created_batch) {
            $last_created_batch = $last_created_batch->batch_number;
        } else {
            $last_created_batch = 0;
        }
        $this->data = new Batch();
        $this->data->department_id = $department_id;
        $this->data->batch_number = $last_created_batch + 1;
        $this->data->admission_start = $request->admission_start;
        $this->data->admission_end = $request->admission_end;
        $this->data->save();

        fmassage('success', 'batch  created successfully', 'success');
        return redirect()->route('hod.batch.admission.list', $department_id);
    }
}
