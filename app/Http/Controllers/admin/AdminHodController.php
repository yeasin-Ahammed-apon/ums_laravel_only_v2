<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\userManagementTrait;
use App\Models\Hod;
use Illuminate\Http\Request;

class AdminHodController extends Controller
{
    use userManagementTrait;
    private $data;
    private $datas;
    public function index(Request $request)
    {
        return $this->showUserList(Hod::class, $request, 'hod');
    }
    public function create()
    {
        return $this->CreateUser('hod');
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
