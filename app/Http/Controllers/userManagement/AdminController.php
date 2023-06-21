<?php

namespace App\Http\Controllers\userManagement;

use App\Http\Controllers\Controller;
use App\Http\Traits\userManagementTrait;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use userManagementTrait;

    private $data;
    private $datas;
    public function index(Request $request){
        return $this->showUserList(Admin::class, $request, 'admin');
    }
    public function create(){
        return $this->CreateUser('admin');
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
