<?php

namespace App\Http\Controllers\admission;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;

class AdmissionBatchController extends Controller
{
    public function list(Request $request)
    {
        $this->pageData = pageDataCheck($request); // make paginate data default
        $datas = Batch::where(/* 0 mean open , 1 mean close*/'admission_close', 0)
                        ->orderBy('created_at', 'desc')
                        ->paginate($this->pageData);
        return view('admission.batch.list', [
            'datas' => $datas,
            "pageData" => $this->pageData
        ]);
    }
    public function show(Batch $batch)
    {
        return view('admission.batch.show', ['data' => $batch]);
    }
}
