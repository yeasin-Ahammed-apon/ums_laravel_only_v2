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
        return $this->StoreUser(Account::class, $request, 'account', 'AC');
    }
    public function show($id)
    {
        $this->data = Account::with('user')->findOrFail($id);
        return view('superAdmin.account.show', [
            'data' => $this->data
        ]);
    }
    public function edit($id)
    {
        $this->data = Account::with('user')->find($id);
        return view('superAdmin.account.edit', [
            'data' => $this->data,
        ]);
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
