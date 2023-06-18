<?php

namespace App\Http\Controllers\hr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HrController extends Controller
{
    private $data;
    private $datas;
    public function dashboard()
    {
        return view('hr.dashboard.dashboard');
    }
    public function profile(){
        return view('hr.profile.profile');
    }
}
