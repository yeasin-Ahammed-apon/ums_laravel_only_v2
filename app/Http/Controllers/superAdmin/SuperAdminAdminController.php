<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Http\Traits\SuperAdmin;
use App\Models\Admin;
use Illuminate\Http\Request;

class SuperAdminAdminController extends Controller
{
    use SuperAdmin;

    /*** Display a listing of the resource.*/
    private $data;
    private $datas;
    private $authUser = 'superAdmin';
    public function index(Request $request){
        return $this->showUserList(Admin::class, $request, 'admin');
    }
    public function create(){
        return view('superAdmin.admin.create');
    }
    public function store(Request $request){
        return $this->StoreUser(Admin::class,$request,'admins');
    }
    public function show($id){
        return $this->ShowUser(Admin::class,'admin',$id);
    }
    public function edit($id){
        return $this->EditUser(Admin::class,'admin',$id);
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
    public function trash(){
        $this->datas = Admin::onlyTrashed()->paginate(10);
        return view('superAdmin.admin.trash',[
            'datas'=>$this->datas,
            'pageData'=>10
        ]);
    }
    public function restore($id){
        $this->datas = Admin::onlyTrashed()->find($id)->restore();
        return redirect()->back() ;
    }

}
