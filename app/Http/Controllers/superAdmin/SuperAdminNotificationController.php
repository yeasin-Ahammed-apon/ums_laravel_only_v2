<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\EmployeesNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminNotificationController extends Controller
{
    private $data;
    private $datas;
    public function notification_superAdmin(Request $request)
    {
        if ($request->checkboxData) {
             return $request->checkboxData;
        }
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
            $this->datas = EmployeesNotification::where('role', 'superAdmin')
                ->where('action', 'LIKE', "%{$this->data}%")
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
    public function notification_admin(Request $request)
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
            $this->datas = EmployeesNotification::where('role', 'admin')
                ->where('seen', 0)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('superAdmin.notifications.admin', [
                'datas' => $this->datas
            ]);
        }
        if ($request->seen === '1') {
            $this->datas = EmployeesNotification::where('role', 'admin')
                ->where('seen', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('superAdmin.notifications.admin', [
                'datas' => $this->datas
            ]);
        }
        if ($request->search) {
            $this->data = $request->search;
            $this->datas = EmployeesNotification::where('role', 'admin')
                ->where('action', 'LIKE', "%{$this->data}%")
                ->orWhere('description', 'LIKE', "%{$this->data}%")->paginate(10);

            return view('superAdmin.notifications.admin', [
                'datas' => $this->datas,
                'title' => "Admin Search Result List"
            ]);
        }
        $this->datas = EmployeesNotification::where('role', 'admin')
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->paginate(10);
        return view('superAdmin.notifications.admin', [
            'datas' => $this->datas
        ]);
    }
    public function notification_hod(Request $request)
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
            $this->datas = EmployeesNotification::where('role', 'hod')
                ->where('seen', 0)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('superAdmin.notifications.hod', [
                'datas' => $this->datas
            ]);
        }
        if ($request->seen === '1') {
            $this->datas = EmployeesNotification::where('role', 'hod')
                ->where('seen', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('superAdmin.notifications.hod', [
                'datas' => $this->datas
            ]);
        }
        if ($request->search) {
            $this->data = $request->search;
            $this->datas = EmployeesNotification::where('role', 'hod')
                ->where('action', 'LIKE', "%{$this->data}%")
                ->orWhere('description', 'LIKE', "%{$this->data}%")->paginate(10);

            return view('superAdmin.notifications.hod', [
                'datas' => $this->datas,
                'title' => "Admin Search Result List"
            ]);
        }
        $this->datas = EmployeesNotification::where('role', 'hod')
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->paginate(10);
        return view('superAdmin.notifications.hod', [
            'datas' => $this->datas
        ]);
    }
    public function notification_cod(Request $request)
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
            $this->datas = EmployeesNotification::where('role', 'cod')
                ->where('seen', 0)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('superAdmin.notifications.cod', [
                'datas' => $this->datas
            ]);
        }
        if ($request->seen === '1') {
            $this->datas = EmployeesNotification::where('role', 'cod')
                ->where('seen', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('superAdmin.notifications.cod', [
                'datas' => $this->datas
            ]);
        }
        if ($request->search) {
            $this->data = $request->search;
            $this->datas = EmployeesNotification::where('role', 'cod')
                ->where('action', 'LIKE', "%{$this->data}%")
                ->orWhere('description', 'LIKE', "%{$this->data}%")->paginate(10);

            return view('superAdmin.notifications.cod', [
                'datas' => $this->datas,
                'title' => "Admin Search Result List"
            ]);
        }
        $this->datas = EmployeesNotification::where('role', 'cod')
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->paginate(10);
        return view('superAdmin.notifications.cod', [
            'datas' => $this->datas
        ]);
    }
    public function notification_teacher(Request $request)
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
            $this->datas = EmployeesNotification::where('role', 'teacher')
                ->where('seen', 0)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('superAdmin.notifications.teacher', [
                'datas' => $this->datas
            ]);
        }
        if ($request->seen === '1') {
            $this->datas = EmployeesNotification::where('role', 'teacher')
                ->where('seen', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('superAdmin.notifications.teacher', [
                'datas' => $this->datas
            ]);
        }
        if ($request->search) {
            $this->data = $request->search;
            $this->datas = EmployeesNotification::where('role', 'teacher')
                ->where('action', 'LIKE', "%{$this->data}%")
                ->orWhere('description', 'LIKE', "%{$this->data}%")->paginate(10);

            return view('superAdmin.notifications.teacher', [
                'datas' => $this->datas,
                'title' => "Admin Search Result List"
            ]);
        }
        $this->datas = EmployeesNotification::where('role', 'teacher')
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->paginate(10);
        return view('superAdmin.notifications.teacher', [
            'datas' => $this->datas
        ]);
    }
}
