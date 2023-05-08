<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Http\Traits\SuperAdmin;
use App\Models\Account;
use Illuminate\Http\Request;

class SuperAdminAccountController extends Controller
{
    use SuperAdmin;
    private $data;
    private $datas;
    private $authUser = 'superAdmin';
    public function index(Request $request)
    {
        return $this->showUserList(Account::class, $request, 'account');
    }
    public function create()
    {
        return view('superAdmin.account.create');
    }
    public function store(Request $request)
    {
        return $this->StoreUser(Account::class, $request, 'accounts');
    }
    public function show($id)
    {
        return $this->ShowUser(Account::class,'account',$id);
    }
    public function edit($id)
    {
        return $this->EditUser(Account::class,'account',$id);
    }
    public function update(Request $request, $id)
    {
        return $this->UpdateUser(Account::class, $request, 'accounts', $id);
    }
    public function status($id)
    {
        return $this->UpdateStatus($id);
    }
    public function destroy($id)
    {
        return $this->DeleteUser(Account::class, 'account', $id);
    }
}
