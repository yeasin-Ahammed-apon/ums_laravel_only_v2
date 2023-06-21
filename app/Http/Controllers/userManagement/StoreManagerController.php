<?php

namespace App\Http\Controllers\userManagement;

use App\Http\Controllers\Controller;
use App\Http\Traits\userManagementTrait;
use App\Models\StoreManager;
use Illuminate\Http\Request;

class StoreManagerController extends Controller
{
    use userManagementTrait;
    private $data;
    private $datas;
    public function index(Request $request)
    {
        return $this->showUserList(StoreManager::class, $request, 'storeManager');
    }
    public function create()
    {
        return $this->CreateUser('storeManager');
    }
    public function store(Request $request)
    {
        return $this->StoreUser(StoreManager::class, $request, 'store_managers');
    }
    public function show($id)
    {
        return $this->ShowUser(StoreManager::class,'storeManager',$id);
    }
    public function edit($id)
    {
        return $this->EditUser(StoreManager::class,'storeManager',$id);
    }
    public function update(Request $request, $id)
    {
        return $this->UpdateUser(StoreManager::class, $request, 'store_managers', $id);
    }
    public function status($id)
    {
        return $this->UpdateStatus($id);
    }
    public function destroy($id)
    {
        return $this->DeleteUser(StoreManager::class, 'storeManager', $id);
    }
}
