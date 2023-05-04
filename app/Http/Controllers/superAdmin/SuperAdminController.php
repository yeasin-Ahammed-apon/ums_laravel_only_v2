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
    public function notification_superAdmin(Request $request)
    {

        if ($request->type === 'read') {
            $this->datas = EmployeesNotification::find($request->id);
            $this->datas->seen = 1;
            $this->datas->seen_by = Auth::user()->id;
            $this->datas->save();
            fmassage('Read', 'Message read successfully', 'success');
            return redirect()->back();
        }
        if ($request->seen === '0') {
            $this->datas = EmployeesNotification::where('role', 'superAdmin')
                ->where('seen', 0)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('superAdmin.notifications.superAdmin', [
                'datas' => $this->datas
            ]);
        }
        if ($request->seen === '1') {
            $this->datas = EmployeesNotification::where('role', 'superAdmin')
                ->where('seen', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('superAdmin.notifications.superAdmin', [
                'datas' => $this->datas
            ]);
        }
        if ($request->search) {
            $this->data = $request->search;
            $this->datas = EmployeesNotification::where('action', 'LIKE', "%{$this->data}%")
                ->orWhere('description', 'LIKE', "%{$this->data}%")->paginate(10);

            return view('superAdmin.notifications.superAdmin', [
                'datas' => $this->datas,
                'title' => "Admin Search Result List"
            ]);
        }
        $this->datas = EmployeesNotification::where('role', 'superAdmin')
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->paginate(10);
        return view('superAdmin.notifications.superAdmin', [
            'datas' => $this->datas
        ]);
    }
    
}
