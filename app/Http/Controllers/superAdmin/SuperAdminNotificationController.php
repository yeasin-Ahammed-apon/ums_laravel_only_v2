<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\EmployeesNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SuperAdminNotificationController extends Controller
{
    private $data;
    private $datas;
    private $pageData;
    private $url = 'superAdmin.notifications.';
    // private $pageData;
    public function pageDataCheck($request)
    {
        if ($request->pageData) $this->pageData = intval($request->pageData);
        else $this->pageData = 10;
    }
    public function selectedValues($request)
    {
        try {
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
        } catch (ModelNotFoundException $e) {
            return view('exception.index',[
                "title"=>"Notification Not Found",
                "description"=>"Notification Not Found",
            ]);
        }catch(\Exception $e){
            return view('exception.index',[
                "title"=>"Error",
                "description"=>"Something went wrong , plz connect with your devloper",
            ]);
        }
    }
    public function markAsRead($request)
    {

        try {
            if ($request->type === 'read') {
                $this->datas = EmployeesNotification::findOrFail($request->id);
                $this->datas->seen = 1;
                $this->datas->seen_by = Auth::user()->id;
                $this->datas->save();
                fmassage('Read', 'Message read successfully', 'success');
                return redirect()->back();
            }
        } catch (ModelNotFoundException $e) {
            return view('exception.index',[
                "title"=>"Notification Not Found",
                "description"=>"Notification Not Found",
            ]);
        }catch(\Exception $e){
            return view('exception.index',[
                "title"=>"Error",
                "description"=>"Something went wrong , plz connect with your devloper",
            ]);
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
    public function notification($request, $role)
    {
        $this->pageDataCheck($request);
        $view = $this->selectedValues($request);
        if ($view) return $view;
        $view = $this->markAsRead($request);
        if ($view) return $view;
        $view = $this->unseen($request, $role, $this->url . $role)
            ?: $this->seen($request, $role, $this->url . $role)
            ?: $this->searchResult($request, $role, $this->url . $role)
            ?: $this->normalRrturn($role, $this->url . $role);
        if ($view) {
            return $view;
        }
    }
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
