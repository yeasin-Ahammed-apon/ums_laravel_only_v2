<?php

namespace App\Http\Controllers\hr;

use App\Http\Controllers\Controller;
use App\Http\Traits\userManagementTrait;
use App\Models\Cod;
use Illuminate\Http\Request;

class HrCodController extends Controller
{

    use userManagementTrait;
    private $data;
    private $datas;
    public function index(Request $request)
    {
        return $this->showUserList(Cod::class, $request, 'cod');
    }
    public function create()
    {
        return $this->CreateUser('cod');
    }
    public function store(Request $request)
    {
        return $this->StoreUser(Cod::class, $request, 'cods');
    }
    public function show($id)
    {
        return $this->ShowUser(Cod::class, 'cod', $id);
    }
    public function edit($id)
    {
        return $this->EditUser(Cod::class, 'cod', $id);
    }
    public function update(Request $request, $id)
    {
        return $this->UpdateUser(Cod::class, $request, 'cods', $id);
    }
    public function status($id)
    {
        return $this->UpdateStatus($id);
    }
    public function destroy($id)
    {
        return $this->DeleteUser(Cod::class, 'cod', $id);
    }

}
