<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use App\Models\TemporaryStudent;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function dashboard(){
        return view('account.dashboard.dashboard');
    }
    public function profile(){
        return view('account.profile.profile');
    }
    public function temporary_list_student(Request $request){
        $this->pageData=pageDataCheck($request);
        $datas = TemporaryStudent::where('status',1)->orderBy('created_at', 'desc')->paginate($this->pageData);
        return view('account.batch.temporary_list',[
            "datas"=>$datas,
            'pageData'=> $this->pageData
        ]);
    }
    public function temporary_student_pay_edit(TemporaryStudent $temporaryStudent){
        return view('account.batch.temporary_pay',[
            "data"=>$temporaryStudent,
        ]);
    }
    public function temporary_student_pay_slip(TemporaryStudent $temporaryStudent){
        return view('account.batch.temporary_pay_slip',[
            "data"=>$temporaryStudent,
        ]);
    }
    public function temporary_student_pay_update(Request $request,TemporaryStudent $temporaryStudent){
        $admission_fee_given = $request->admission_fee_given;
        if ($admission_fee_given > $temporaryStudent->admission_fee) {
            $advence_payment = $admission_fee_given - $temporaryStudent->admission_fee;
        }
        $temporaryStudent->admission_fee_given  =  $request->admission_fee_given;
        $temporaryStudent->advance_payment  =  $advence_payment ?? 0;
        $temporaryStudent->save();
        return view('account.batch.temporary_pay_slip',[
            "data"=>$temporaryStudent,
        ]);
    }
}
