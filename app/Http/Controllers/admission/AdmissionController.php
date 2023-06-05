<?php

namespace App\Http\Controllers\admission;

use App\Http\Controllers\Controller;
use App\Models\Batch;


class AdmissionController extends Controller
{

    public function dashboard()
    {
        $datas = Batch::where('status', 0)->orderBy('created_at', 'desc')->get();
        return view('admission.dashboard.dashboard', ['datas' => $datas]);
    }
    public function profile()
    {
        return view('admission.profile.profile');
    }
}
