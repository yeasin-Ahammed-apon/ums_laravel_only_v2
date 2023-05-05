<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\EmployeesNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    private $data;
    private $datas;
    public function dashboard()
    {
        return view('superAdmin.dashboard.dashboard');
    }
    

}
