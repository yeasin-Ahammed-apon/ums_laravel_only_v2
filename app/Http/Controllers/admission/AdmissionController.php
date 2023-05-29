<?php

namespace App\Http\Controllers\admission;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\TemporaryStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AdmissionController extends Controller
{
    private $pageData;

    public function dashboard()
    {
        $datas = Batch::where('status', 0)->orderBy('created_at', 'desc')->get();
        return view('admission.dashboard.dashboard', ['datas' => $datas]);
    }
    public function admission_open_list(Request $request){
        $this->pageData = pageDataCheck($request); // make paginate data default
        $datas = Batch::where('status', 0)->orderBy('created_at', 'desc')->paginate($this->pageData);
        return view('admission.batch.batch_admission_open_list',[
            'datas' =>$datas,
            "pageData"=>$this->pageData
        ]);
    }
    public function profile()
    {
        return view('admission.profile.profile');
    }
    public function batch_info(Batch $batch)
    {
        return view('admission.batch.batch_info', ['data' => $batch]);
    }
    public function temporary_add_student(Batch $batch)
    {
        return view('admission.batch.temporary_add', ['data' => $batch]);
    }
    public function temporary_list_student(Request $request){
        $this->pageData=pageDataCheck($request);
        $datas = TemporaryStudent::where('status',1)->paginate($this->pageData);
        return view('admission.batch.temporary_list',[
            "datas"=>$datas,
            'pageData'=> $this->pageData
        ]);
    }
    public function temporary_store_student(Request $request, Batch $batch)
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
        $data->admission_discount = $admission_discount;
        $data->admission_fee = $student_admission_fee;
        $data->save();
        if($data){
            return redirect()->route("admission.batch.temporary.view.student",$data->id);
        }

    }
    public function temporary_student_view(TemporaryStudent $temporaryStudent){
        return view('admission.batch.temporary_payment_view',[
             'temporaryStudent' =>$temporaryStudent
        ]);

    }
    public function temporary_student_view_print(TemporaryStudent $temporaryStudent){
        $data = ["name"=>$temporaryStudent->name];
        $pdf = Pdf::loadView('admission.batch.temporary_payment_view_print',$data);
        return $pdf->stream('invoice.pdf');
    }
}
