<?php

namespace App\Http\Controllers\hod;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\BatchPaymentInfo;
use App\Models\BatchWaiver;
use App\Models\Deparment;
use App\Models\DepartmentWaiver;
use App\Models\HodDepartmentAssign;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HodDepartmentController extends Controller
{
    private $data;
    private $datas;
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
    public function batch_info($department_id,Batch $batch)
    {
        return view('hod.department.batch_info', [
            'data' => $batch,
            'department_id' => $department_id
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

    public function completed_list($department_id)
    {
        $completed_batch = Batch::where('department_id', $department_id)->where('status', 2)->get();
        return view('hod.department.completed_batch', [
            'completed_batch' => $completed_batch,
            'department_id' => $department_id
        ]);
    }
    public function admission_close_batch($department_id,Batch $batch){
        $batch->admission_close = !$batch->admission_close;
        $batch->save();
        fmassage('success','admission status updated','success');
        return redirect()->back();
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
        $batch = new Batch();
        $batch->department_id = $department_id;
        $batch->batch_number = $last_created_batch + 1;
        $batch->admission_start = $request->admission_start;
        $batch->admission_end = $request->admission_end;
        $batch->save();
        if($batch){
            $waiver = DepartmentWaiver::where('department_id',$department_id)->first();
            $batchWaiver =  new BatchWaiver();
            $batchWaiver->batch_id = $batch->id;
            $batchWaiver->level1 = $waiver->level1;
            $batchWaiver->level2 = $waiver->level2;
            $batchWaiver->level3 = $waiver->level3;
            $batchWaiver->level4 = $waiver->level4;
            $batchWaiver->level5 = $waiver->level5;
            $batchWaiver->save();
        }else {
                fmassage('Fail', 'batch  create fail', 'error');
                return redirect()->route('hod.batch.admission.list', $department_id);
        }
        if ($batch) {
                $department = Deparment::findOrFail($department_id);
                $batch_payment_info = new BatchPaymentInfo();
                $batch_payment_info->batch_id = $batch->id;
                $batch_payment_info->duration_year = $department->departmentCourseFeeInfo->duration_year;
                $batch_payment_info->duration_semester = $department->departmentCourseFeeInfo->duration_semester;
                $batch_payment_info->credit = $department->departmentCourseFeeInfo->credit;
                $batch_payment_info->admission_fee = $department->departmentCourseFeeInfo->admission_fee;
                $batch_payment_info->session_fee = $department->departmentCourseFeeInfo->session_fee;
                $batch_payment_info->per_credit_fee = $department->departmentCourseFeeInfo->per_credit_fee;
                $batch_payment_info->total_fee = $department->departmentCourseFeeInfo->total_fee;
                $batch_payment_info->save();
                if ($batch_payment_info) {
                    fmassage('success', 'batch  created successfully', 'success');
                    return redirect()->route('hod.batch.admission.list', $department_id);
                }
                fmassage('Fail', 'batch  create fail', 'error');
                return redirect()->route('hod.batch.admission.list', $department_id);
        }
    }
    public function student_list(Request $request,$department_id,$batch){
    $this->pageData = pageDataCheck($request);
        // $datas = Student::where('admit_batch_id',$batch)->orderBy('created_at', 'desc')->paginate(10);
    $datas = DB::table('students') // something fishy going on with model , that whay using query builder
    ->join('users', 'students.user_id', '=', 'users.id')
    ->select('students.*', 'users.*')
    ->where('students.admit_batch_id', $batch)
    ->orderBy('students.created_at', 'desc')
    ->paginate($this->pageData);

        return view('hod.student.list',[
            'datas'=>$datas,
            'department_id'=>$department_id,
            'batch'=>$batch,
            'pageData'=>$this->pageData
        ]);
    }
}
