<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\SuperAdmin;
use App\Models\Hod;
use Illuminate\Http\Request;

class AdminHodController extends Controller
{
    use SuperAdmin;
    private $data;
    private $datas;
    private $authUser = 'admin';
    public function index(Request $request)
    {
        // dd(auth()->user()->role->name);
        return $this->showUserList(Hod::class, $request, 'hod');
    }
    public function create()
    {
        return view('admin.hod.create');
    }
    public function store(Request $request)
    {
        return $this->StoreUser(Hod::class,$request,'hods');
    }
    public function show($id)
    {
        return $this->ShowUser(Hod::class,'hod',$id);
    }
    public function edit($id)
    {
        return $this->EditUser(Hod::class,'hod',$id);
    }
    public function update(Request $request, $id)
    {
        return $this->UpdateUser(Hod::class,$request,'hods',$id);
    }
    public function status($id)
    {
        return $this->UpdateStatus($id);
    }
    public function destroy($id)
    {
        return $this->DeleteUser(Hod::class,'hod',$id);
    }
}
