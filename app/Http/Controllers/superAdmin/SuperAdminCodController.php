<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Http\Traits\SuperAdmin;
use App\Models\Cod;
use Illuminate\Http\Request;

class SuperAdminCodController extends Controller
{
    use SuperAdmin;
    private $data;
    private $datas;
    private $authUser = 'superAdmin';
    public function index(Request $request)
    {
        return $this->showUserList(Cod::class, $request, 'cod');
    }
    public function create()
    {
        return view('superAdmin.cod.create');
    }
    public function store(Request $request)
    {
        return $this->StoreUser(Cod::class,$request,'cods');
    }
    public function show($id)
    {
        return $this->ShowUser(Cod::class,'cod',$id);
    }
    public function edit($id)
    {
        return $this->EditUser(Cod::class,'cod',$id);
    }

    public function update(Request $request, $id)
    {
        return $this->UpdateUser(Cod::class,$request,'cods',$id);
    }
    public function status($id)
    {
       return $this->UpdateStatus($id);
    }
    public function destroy($id)
    {
        return $this->DeleteUser(Cod::class,'cod',$id);
    }

}
