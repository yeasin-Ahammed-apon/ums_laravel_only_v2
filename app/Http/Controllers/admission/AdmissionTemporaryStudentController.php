<?php

namespace App\Http\Controllers\admission;

use App\Http\Controllers\Controller;
use App\Http\Traits\temporaryStudentTrait;
use App\Models\Batch;
use App\Models\TemporaryStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmissionTemporaryStudentController extends Controller
{
    use temporaryStudentTrait;

    public function list(Request $request){
        $this->pageData=pageDataCheck($request);
        $datas = TemporaryStudent::where('status',1)->orderBy('created_at', 'desc')->paginate($this->pageData);
        return view('admission.temporaryStudent.list',[
            "datas"=>$datas,
            'pageData'=> $this->pageData
        ]);
    }
    public function history(Request $request){
        return $this->TemporaryStudentList($request);
    }
    public function show(TemporaryStudent $temporaryStudent){
        return view('admission.temporaryStudent.show',[
             'data' =>$temporaryStudent
        ]);

    }
    public function create(Batch $batch)
    {
        return view('admission.temporaryStudent.create', ['data' => $batch]);
    }
    public function store(Request $request, Batch $batch)
    {
        $batch_admission_fee = $batch->batchPaymentInfo->admission_fee;
        $student_name = $request->name;
        $admission_discount = $request->admission_discount;
        $student_admission_fee = $batch_admission_fee - $admission_discount;

        if ($admission_discount > $batch_admission_fee || $admission_discount < 0 ) {
            fmassage('Fail', 'admission discount can not be eqaul or bigger then batch admission fee', 'error');
            return redirect()->back();
        }
        $last_created_temporary_student = TemporaryStudent::orderBy('created_at', 'desc')->first();
        if ($last_created_temporary_student) {
            $last_created_temporary_student = $last_created_temporary_student->id;
        } else {
            $last_created_temporary_student = 0;
        }
        $temporary_id = ($batch->department_id . $batch->id . $last_created_temporary_student) + 1;
        $data = new TemporaryStudent();
        $data->name = $student_name;
        $data->temporary_id = $temporary_id;
        $data->batch_id = $batch->id;
        $data->created_by = Auth::user()->id;
        $data->admission_discount = $admission_discount ?? 0;
        $data->admission_fee = $student_admission_fee;
        $data->save();
        if($data){
            return redirect()->route("admission.temporaryStudent.show",$data->id);
        }

    }
    public function print(TemporaryStudent $temporaryStudent){
        return view("admission.temporaryStudent.print",[
            'data' =>$temporaryStudent
       ]);
    }
}
