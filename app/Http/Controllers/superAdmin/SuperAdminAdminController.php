<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Http\Traits\SuperAdmin;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;


class SuperAdminAdminController extends Controller
{
    use SuperAdmin;

    /*** Display a listing of the resource.*/
    private $data;
    private $datas;
    public function index(Request $request){
        return $this->showUserList(Admin::class, $request, 'admin');

    }
    public function create(){
        return view('superAdmin.admin.create');
    }
    public function store(Request $request){
        return $this->StoreUser(Admin::class,$request,'admins','A');
    }
    public function show($id){
        $this->data = Admin::with('user')->findOrFail($id);
        return view('superAdmin.admin.show',[
            'data'=>$this->data
        ]);
    }
    public function edit($id){
        $this->data = Admin::with('user')->find($id);
        return view('superAdmin.admin.edit', [
            'data' => $this->data,
        ]);
    }
    public function update(Request $request, $id){
        return $this->UpdateUser(Admin::class,$request,'admins',$id);
    }
    public function status($id){
        return $this->UpdateStatus($id);
    }
    public function destroy($id){
        return $this->DeleteUser(Admin::class,'admin',$id);
    }
}
