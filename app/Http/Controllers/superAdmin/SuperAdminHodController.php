<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Http\Traits\SuperAdmin;
use App\Models\Hod;
use Illuminate\Http\Request;

class SuperAdminHodController extends Controller
{
    use SuperAdmin;
    private $data;
    private $datas;
    public function index(Request $request)
    {
        return $this->showUserList(Hod::class, $request, 'hod');
    }
    public function create()
    {
        return view('superAdmin.hod.create');
    }
    public function store(Request $request)
    {
        return $this->StoreUser(Hod::class,$request,'hods','H');
    }
    public function show($id)
    {
        $this->data = Hod::with('user')->findOrFail($id);
        return view('superAdmin.hod.show',[
            'data'=>$this->data
        ]);
    }
    public function edit($id)
    {
        $this->data = Hod::with('user')->find($id);
        return view('superAdmin.hod.edit', [
            'data' => $this->data,
        ]);
    }
    public function update(Request $request, $id)
    {
        return $this->UpdateUser(Hod::class,$request,'hods',$id);
    }
    public function status($id)
    {
        return $this->UpdateStatus($id);
    }
    public function destroy($id)
    {
        return $this->DeleteUser(Hod::class,'hod',$id);
    }
}
