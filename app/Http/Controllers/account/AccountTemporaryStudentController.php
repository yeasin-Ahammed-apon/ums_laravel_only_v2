<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use App\Http\Traits\temporaryStudentTrait;
use App\Models\TemporaryStudent;
use App\Models\TemporaryStudentPaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountTemporaryStudentController extends Controller
{
    use temporaryStudentTrait;
    public function list(Request $request){
        $this->pageData=pageDataCheck($request);
        $datas = TemporaryStudent::where('status',1)->orderBy('created_at', 'desc')->paginate($this->pageData);
        return view('account.temporaryStudent.list',[
            "datas"=>$datas,
            'pageData'=> $this->pageData
        ]);
    }
    public function edit(TemporaryStudent $temporaryStudent){
        if ($temporaryStudent->admission_fee_given >=$temporaryStudent->admission_fee ) {
            fmassage('Warning','This Student Admission is given, no need to add more','warning');
            return redirect()->back();
        }
        return view('account.temporaryStudent.edit',[
            "data"=>$temporaryStudent,
        ]);
    }
    public function update(Request $request,TemporaryStudent $temporaryStudent){
        $admission_fee_given = $request->admission_fee_given;
        $total_admission_fee_given = $admission_fee_given +$temporaryStudent->admission_fee_given;
        if ($total_admission_fee_given  >= $temporaryStudent->admission_fee) {
            $advance_payment = $total_admission_fee_given - $temporaryStudent->admission_fee;
        }
        $temporaryStudent->admission_fee_given  =  $total_admission_fee_given;
        $temporaryStudent->advance_payment  =  $advance_payment ?? 0;
        $temporaryStudent->save();
        if ($admission_fee_given != 0) {
            $temporaryStudentPaymentHistory  = new TemporaryStudentPaymentHistory();
            $temporaryStudentPaymentHistory->temporary_student_id = $temporaryStudent->id;
            $temporaryStudentPaymentHistory->account_id = Auth::user()->id;
            $temporaryStudentPaymentHistory->account_name = Auth::user()->name;
            $temporaryStudentPaymentHistory->amount = $admission_fee_given;
            $temporaryStudentPaymentHistory->save();
        }
        return view('account.temporaryStudent.print',[
            "data"=>$temporaryStudent,
        ]);
    }
    public function print(TemporaryStudent $temporaryStudent){
        return view('account.temporaryStudent.print',[
            "data"=>$temporaryStudent,
        ]);
    }
    public function history(Request $request){
        return $this->TemporaryStudentList($request);
    }
}
