<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Http\Traits\notification;
use Illuminate\Http\Request;



class SuperAdminNotificationController extends Controller
{
    use notification;

    public function notification_superAdmin(Request $request)
    {
        return $this->notification($request, 'superAdmin');
    }
    public function notification_admin(Request $request)
    {
        return $this->notification($request, 'admin');
    }
    public function notification_hod(Request $request)
    {
        return $this->notification($request, 'hod');
    }
    public function notification_cod(Request $request)
    {
        return $this->notification($request, 'cod');
    }
    public function notification_teacher(Request $request)
    {
        return $this->notification($request, 'teacher');
    }
    public function notification_account(Request $request)
    {
        return $this->notification($request, 'account');
    }
    public function notification_admission(Request $request)
    {
        return $this->notification($request, 'admission');
    }
}
