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
    private $pageData;
    // private $pageData;
    public function pageDataCheck($request)
    {
        if ($request->pageData) $this->pageData = intval($request->pageData);
        else $this->pageData = 10;
    }
    public function selectedValues($request)
    {
        if ($request->selectedValues) {
            foreach ($request->selectedValues as  $value) {
                $this->data = EmployeesNotification::findOrFail($value);
                $this->data->seen = 1;
                $this->data->seen_by = Auth::user()->id;
                $this->data->save();
            }
            fmassage('Read', 'Message read successfully', 'success');
            return response()->json(['status' => 'success']);
        }
    }
    public function markAsRead($request)
    {
        if ($request->type === 'read') {
            $this->datas = EmployeesNotification::find($request->id);
            $this->datas->seen = 1;
            $this->datas->seen_by = Auth::user()->id;
            $this->datas->save();
            fmassage('Read', 'Message read successfully', 'success');
            return redirect()->back();
        }
    }
    public function unseen($request, $role, $viewUrl)
    {
        if ($request->seen === '0') {
            $this->datas = EmployeesNotification::where('role', $role)
                ->where('seen', 0)
                ->orderBy('created_at', 'desc')
                ->paginate($this->pageData);
            return view($viewUrl, [
                'datas' => $this->datas,
                'pageData' => $this->pageData
            ]);
        }
    }
    public function seen($request, $role, $viewUrl)
    {
        if ($request->seen === '1') {
            $this->datas = EmployeesNotification::where('role', $role)
                ->where('seen', 1)
                ->orderBy('created_at', 'desc')
                ->paginate($this->pageData);
            return view($viewUrl, [
                'datas' => $this->datas,
                'pageData' => $this->pageData
            ]);
        }
    }
    public function searchResult($request, $role, $viewUrl)
    {
        if ($request->search) {
            $this->data = $request->search;
            $this->datas = EmployeesNotification::where('action', 'LIKE', "%{$this->data}%")
                ->orWhere('description', 'LIKE', "%{$this->data}%")
                ->where('role', $role)
                ->orderBy('created_at', 'desc')
                ->paginate($this->pageData);
            return view($viewUrl, [
                'datas' => $this->datas,
                'pageData' => $this->pageData
            ]);
        }
    }
    public function normalRrturn($role, $viewUrl)
    {
        $this->datas = EmployeesNotification::where('role', $role)
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->paginate($this->pageData);
        return view($viewUrl, [
            'datas' => $this->datas,
            'pageData' => $this->pageData
        ]);
    }
    public function notification_superAdmin(Request $request)
    {
        $this->pageDataCheck($request);
        $view = $this->selectedValues($request);
        if ($view) return $view;
        $view = $this->markAsRead($request);
        if ($view) return $view;
        $view = $this->unseen($request, 'superAdmin', 'superAdmin.notifications.superAdmin')
            ?: $this->seen($request, 'superAdmin', 'superAdmin.notifications.superAdmin')
            ?: $this->searchResult($request, 'superAdmin', 'superAdmin.notifications.superAdmin')
            ?: $this->normalRrturn('superAdmin', 'superAdmin.notifications.superAdmin');
        if ($view) {
            return $view;
        }
    }
    public function notification_admin(Request $request)
    {
        $this->pageDataCheck($request);
        $view = $this->selectedValues($request);
        if ($view) return $view;
        $view = $this->markAsRead($request);
        if ($view) return $view;
        $view = $this->unseen($request, 'admin', 'superAdmin.notifications.admin')
            ?: $this->seen($request, 'admin', 'superAdmin.notifications.admin')
            ?: $this->searchResult($request, 'admin', 'superAdmin.notifications.admin')
            ?: $this->normalRrturn('admin', 'superAdmin.notifications.admin');
        if ($view) {
            return $view;
        }
    }
    public function notification_hod(Request $request)
    {
        $this->pageDataCheck($request);
        $view = $this->selectedValues($request);
        if ($view) return $view;
        $view = $this->markAsRead($request);
        if ($view) return $view;
        $view = $this->unseen($request, 'hod', 'superAdmin.notifications.hod')
            ?: $this->seen($request, 'hod', 'superAdmin.notifications.hod')
            ?: $this->searchResult($request, 'hod', 'superAdmin.notifications.hod')
            ?: $this->normalRrturn('hod', 'superAdmin.notifications.hod');
        if ($view) {
            return $view;
        }
    }
    public function notification_cod(Request $request)
    {
        $this->pageDataCheck($request);
        $view = $this->selectedValues($request);
        if ($view) return $view;
        $view = $this->markAsRead($request);
        if ($view) return $view;
        $view = $this->unseen($request, 'cod', 'superAdmin.notifications.cod')
            ?: $this->seen($request, 'cod', 'superAdmin.notifications.cod')
            ?: $this->searchResult($request, 'cod', 'superAdmin.notifications.cod')
            ?: $this->normalRrturn('cod', 'superAdmin.notifications.cod');
        if ($view) {
            return $view;
        }
    }
    public function notification_teacher(Request $request)
    {
        $this->pageDataCheck($request);
        $view = $this->selectedValues($request);
        if ($view) return $view;
        $view = $this->markAsRead($request);
        if ($view) return $view;
        $view = $this->unseen($request, 'teacher', 'superAdmin.notifications.teacher')
            ?: $this->seen($request, 'teacher', 'superAdmin.notifications.teacher')
            ?: $this->searchResult($request, 'teacher', 'superAdmin.notifications.teacher')
            ?: $this->normalRrturn('teacher', 'superAdmin.notifications.teacher');
        if ($view) {
            return $view;
        }
    }
    public function notification_account(Request $request)
    {
        $this->pageDataCheck($request);
        $view = $this->selectedValues($request);
        if ($view) return $view;
        $view = $this->markAsRead($request);
        if ($view) return $view;
        $view = $this->unseen($request, 'account', 'superAdmin.notifications.account')
            ?: $this->seen($request, 'account', 'superAdmin.notifications.account')
            ?: $this->searchResult($request, 'account', 'superAdmin.notifications.account')
            ?: $this->normalRrturn('account', 'superAdmin.notifications.account');
        if ($view) {
            return $view;
        }
    }
    public function notification_admission(Request $request)
    {
        $this->pageDataCheck($request);
        $view = $this->selectedValues($request);
        if ($view) return $view;
        $view = $this->markAsRead($request);
        if ($view) return $view;
        $view = $this->unseen($request, 'admission', 'superAdmin.notifications.admission')
            ?: $this->seen($request, 'admission', 'superAdmin.notifications.admission')
            ?: $this->searchResult($request, 'admission', 'superAdmin.notifications.admission')
            ?: $this->normalRrturn('admission', 'superAdmin.notifications.admission');
        if ($view) {
            return $view;
        }
    }
}
