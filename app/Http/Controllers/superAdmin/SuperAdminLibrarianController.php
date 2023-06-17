<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Http\Traits\userManagementTrait;
use App\Models\Librarian;
use Illuminate\Http\Request;

class SuperAdminLibrarianController extends Controller
{
    use userManagementTrait;
    private $data;
    private $datas;
    public function index(Request $request)
    {
        return $this->showUserList(Librarian::class, $request, 'librarian');
    }
    public function create()
    {
        return $this->CreateUser('librarian');
    }
    public function store(Request $request)
    {
        return $this->StoreUser(Librarian::class, $request, 'librarians');
    }
    public function show($id)
    {
        return $this->ShowUser(Librarian::class,'librarian',$id);
    }
    public function edit($id)
    {
        return $this->EditUser(Librarian::class,'librarian',$id);
    }
    public function update(Request $request, $id)
    {
        return $this->UpdateUser(Librarian::class, $request, 'librarians', $id);
    }
    public function status($id)
    {
        return $this->UpdateStatus($id);
    }
    public function destroy($id)
    {
        return $this->DeleteUser(Librarian::class, 'librarian', $id);
    }
}
