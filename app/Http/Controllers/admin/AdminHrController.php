<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\userManagementTrait;
use App\Models\Hr;
use Illuminate\Http\Request;

class AdminHrController extends Controller
{

    use userManagementTrait;
    private $data;
    private $datas;
    public function index(Request $request)
    {
        return $this->showUserList(Hr::class, $request, 'hr');
    }
    public function create()
    {
        return $this->CreateUser('hr');
    }
    public function store(Request $request)
    {
        return $this->StoreUser(Hr::class, $request, 'hrs');
    }
    public function show($id)
    {
        return $this->ShowUser(Hr::class,'hr',$id);
    }
    public function edit($id)
    {
        return $this->EditUser(Hr::class,'hr',$id);
    }
    public function update(Request $request, $id)
    {
        return $this->UpdateUser(Hr::class, $request, 'hrs', $id);
    }
    public function status($id)
    {
        return $this->UpdateStatus($id);
    }
    public function destroy($id)
    {
        return $this->DeleteUser(Hr::class, 'hr', $id);
    }

}
