<?php

namespace App\Http\Controllers\admission;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\TemporaryStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmissionBatchController extends Controller
{
    public function list(Request $request){
        $this->pageData = pageDataCheck($request); // make paginate data default
        $datas = Batch::where('status', 0)->orderBy('created_at', 'desc')->paginate($this->pageData);
        return view('admission.batch.list',[
            'datas' =>$datas,
            "pageData"=>$this->pageData
        ]);
    }
    public function show(Batch $batch)
    {
        return view('admission.batch.show', ['data' => $batch]);
    }
}
