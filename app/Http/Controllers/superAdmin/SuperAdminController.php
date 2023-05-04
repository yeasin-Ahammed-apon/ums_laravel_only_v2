<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\EmployeesNotification;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    private $data;
    private $datas;
    public function dashboard()
    {
        return view('superAdmin.dashboard.dashboard');
    }
    public function notification_superAdmin()
    {
        $this->datas = EmployeesNotification::where('role', 'superAdmin')
            ->where('seen', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('superAdmin.notifications.superAdmin', [
            'datas' => $this->datas
        ]);
    }
}
