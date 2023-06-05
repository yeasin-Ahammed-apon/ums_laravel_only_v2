<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use App\Models\TemporaryStudent;
use Illuminate\Http\Request;

class AccountTemporaryStudentController extends Controller
{
    public function list(Request $request){
        $this->pageData=pageDataCheck($request);
        $datas = TemporaryStudent::where('status',1)->orderBy('created_at', 'desc')->paginate($this->pageData);
        return view('account.temporaryStudent.list',[
            "datas"=>$datas,
            'pageData'=> $this->pageData
        ]);
    }
    public function edit(TemporaryStudent $temporaryStudent){
        return view('account.temporaryStudent.edit',[
            "data"=>$temporaryStudent,
        ]);
    }
    public function print(TemporaryStudent $temporaryStudent){
        return view('account.temporaryStudent.print',[
            "data"=>$temporaryStudent,
        ]);
    }
    public function update(Request $request,TemporaryStudent $temporaryStudent){
        $admission_fee_given = $request->admission_fee_given;
        if ($admission_fee_given > $temporaryStudent->admission_fee) {
            $advence_payment = $admission_fee_given - $temporaryStudent->admission_fee;
        }
        $temporaryStudent->admission_fee_given  =  $request->admission_fee_given;
        $temporaryStudent->advance_payment  =  $advence_payment ?? 0;
        $temporaryStudent->save();
        return view('account.temporaryStudent.print',[
            "data"=>$temporaryStudent,
        ]);
    }
}
