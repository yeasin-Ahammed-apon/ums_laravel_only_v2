<?php

namespace App\Http\Controllers\hr;

use App\Http\Controllers\Controller;
use App\Http\Traits\userManagementTrait;
use App\Models\Admission;
use Illuminate\Http\Request;

class HrAdmissionController extends Controller
{
    use userManagementTrait;
    private $data;
    private $datas;
    public function index(Request $request)
    {
        return $this->showUserList(Admission::class, $request, 'admission');
    }
    public function create()
    {
        return $this->CreateUser('admission');
    }
    public function store(Request $request)
    {
        return $this->StoreUser(Admission::class,$request,'admissions');
    }
    public function show($id)
    {
        return $this->ShowUser(Admission::class,'admission',$id);
    }
    public function edit($id)
    {
        return $this->EditUser(Admission::class,'admission',$id);
    }
    public function update(Request $request, $id)
    {
        return $this->UpdateUser(Admission::class,$request,'admissions',$id);
    }
    public function status($id)
    {

        return $this->UpdateStatus($id);
    }
    public function destroy($id)
    {
        return $this->DeleteUser(Admission::class,'admission',$id);
    }
}
