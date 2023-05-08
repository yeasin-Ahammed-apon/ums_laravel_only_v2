<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;

class SuperAdminController extends Controller
{
    private $data;
    private $datas;
    public function dashboard()
    {
        return view('superAdmin.dashboard.dashboard');
    }


}
