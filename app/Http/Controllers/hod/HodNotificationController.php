<?php

namespace App\Http\Controllers\hod;

use App\Http\Controllers\Controller;
use App\Http\Traits\notification;
use Illuminate\Http\Request;

class HodNotificationController extends Controller
{
    use notification;

    public function notification_superAdmin(Request $request)
    {
        return $this->notification($request, 'superAdmin');
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
}
