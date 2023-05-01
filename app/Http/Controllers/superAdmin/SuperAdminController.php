<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
     private $data;
     private $datas;
    public function dashboard(){
        return view('superAdmin.dashboard.dashboard');
    }

}
