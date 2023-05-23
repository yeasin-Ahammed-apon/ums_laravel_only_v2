<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Http\Traits\SuperAdmin;
use App\Models\Admission;
use Illuminate\Http\Request;

class SuperAdminAdmissionController extends Controller
{
    use SuperAdmin;
    private $data;
    private $datas;
    private $authUser = 'superAdmin';
    public function index(Request $request)
    {
        return $this->showUserList(Admission::class, $request, 'admission');
    }
    public function create()
    {
        return view('superAdmin.admission.create');
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
