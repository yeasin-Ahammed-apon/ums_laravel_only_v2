<?php

namespace App\Http\Traits;


use App\Models\TemporaryStudentPaymentHistory;

trait temporaryStudentTrait
{
    public function TemporaryStudentList($request){
        $this->pageData=pageDataCheck($request);
        $datas = TemporaryStudentPaymentHistory::orderBy('created_at', 'desc')->paginate($this->pageData);
        return view('account.temporaryStudent.history',[
            "datas"=>$datas,
            'pageData'=> $this->pageData
        ]);
    }
}
