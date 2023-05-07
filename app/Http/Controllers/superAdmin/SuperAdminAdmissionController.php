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
    public function index(Request $request)
    {
        return $this->showUserList(Admission::class, $request, 'admission');
    }
    public function create()
    {
        return view('superAdmin.admin.create');
    }
    public function store(Request $request)
    {
        return $this->StoreUser(Admission::class,$request,'admissions','AD');
    }
    public function show($id)
    {
        $this->data = Admission::with('user')->findOrFail($id);
        return view('superAdmin.admin.show',[
            'data'=>$this->data
        ]);
    }
    public function edit($id)
    {
        $this->data = Admission::with('user')->find($id);
        return view('superAdmin.admin.edit', [
            'data' => $this->data,
        ]);
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
