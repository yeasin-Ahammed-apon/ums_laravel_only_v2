<?php

namespace App\Http\Traits;

use App\Models\EmployeesNotification;
use Illuminate\Support\Facades\Auth;

trait notification{
    private $data;
    private $datas;
    private $url;
    private $request;


    // private $pageData;
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
        } catch (\Exception $e) {
            LogError($e);
            return view('exception.index', [
                "title" => "Error",
                "description" => "Something went wrong , plz connect with your devloper",
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
        } catch (\Exception $e) {
            LogError($e);
            return view('exception.index', [
                "title" => "Error",
                "description" => "Something went wrong , plz connect with your devloper",
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
                $this->datas = queryAppend($this->request,$this->datas,['pageData','seen','unseen']);
            return view($viewUrl, [
                'datas' => $this->datas,
                'pageData' => $this->pageData,

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
                $this->datas = queryAppend($this->request,$this->datas,['pageData','seen','unseen']);
            return view($viewUrl, [
                'datas' => $this->datas,
                'pageData' => $this->pageData,

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
                $this->datas = queryAppend($this->request,$this->datas,['pageData','seen','unseen']);
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
        $this->datas = queryAppend($this->request,$this->datas,['pageData','seen','unseen']);
        return view($viewUrl, [
            'datas' => $this->datas,
            'pageData' => $this->pageData
        ]);
    }
    public function notification($request, $role)
    {
        $authUser = Auth::user()->role->name;
        $urlMapping = [
            'superAdmin' => 'superAdmin.notifications.',
            'admin' => 'admin.notifications.',
            'hod' => 'hod.notifications.',
            'cod' => 'cod.notifications.',
            'account' => 'account.notifications.',
            'admission' => 'admission.notifications.',
            'teacher' => 'teacher.notifications.',
            'hr' => 'hr.notifications.',
            'storeManager' => 'storeManager.notifications.',
            'librarian' => 'librarian.notifications.',
        ];
        $this->url = $urlMapping[$authUser] ?? '';
        $this->request = $request;
        $this->pageData = pageDataCheck($request);
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

}
