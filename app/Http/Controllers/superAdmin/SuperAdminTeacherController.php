<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Http\Traits\SuperAdmin;
use App\Models\Cod;
use App\Models\Hod;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminTeacherController extends Controller
{
    use SuperAdmin;
    private $data;
    private $datas;
    public function index(Request $request)
    {
        return $this->showUserList(Teacher::class, $request, 'teacher');
    }
    public function create()
    {
        return view('superAdmin.teacher.create');
    }
    public function store(Request $request)
    {
        return $this->StoreUser(Teacher::class,$request,'teachers','T');
    }
    public function show($id)
    {
        $this->data = Teacher::with('user')->findOrFail($id);
        return view('superAdmin.teacher.show',[
            'data'=>$this->data
        ]);
    }
    public function edit($id)
    {
        $this->data = Teacher::with('user')->find($id);
        return view('superAdmin.teacher.edit', [
            'data' => $this->data,
        ]);
    }
    public function update(Request $request, $id)
    {
        return $this->UpdateUser(Teacher::class,$request,'teachers',$id);
    }
    public function status($id)
    {
        return $this->UpdateStatus($id);
    }
    public function destroy($id)
    {
        return $this->DeleteUser(Teacher::class,'teacher',$id);
    }
    public function cod($id){
        $this->data = Teacher::findOrFail($id);
         // create user
         $user  =  new User();
         $user->name = $this->data->user->name;
         $user->password = $this->data->user->password;
         $user->role_id = Role::where('name', 'cod')->first()->id;
         // user login id create
         $lastUser = User::where('role_id', $user->role_id)->orderBy('id', 'desc')->first();
         $lastLoginId = ($lastUser === null) ? substr('C0000', 1) : substr($lastUser->login_id, 1);
         $nextLoginId = str_pad($lastLoginId + 1, 4, '0', STR_PAD_LEFT);
         $nextLoginIdValue = 'C' . $nextLoginId;
         $user->login_id = $nextLoginIdValue; // created and stored
         $user->permission_id = 1;
         $user->status = 1;
         $user->created_by = Auth::user()->id;
         // user image
         $user->image = $this->data->user->image;
         $user->save();
         // create cod
            $admin  =  new Cod();
            $admin->user_id = $user->id;
            $admin->first_name = $this->data->first_name;
            $admin->last_name = $this->data->last_name;
            $admin->phone = $this->data->phone;
            $admin->address = $this->data->address;
            $admin->email = $this->data->email;
            $admin->save();
            $this->data->cod = 1;
            $this->data->save();
            fmassage('Success', 'New Cod Created Successfully', 'success');
            return redirect()->back();

    }
    public function hod($id){
        $this->data = Teacher::findOrFail($id);
         // create user
         $user  =  new User();
         $user->name = $this->data->user->name;
         $user->password = $this->data->user->password;
         $user->role_id = Role::where('name', 'hod')->first()->id;
         // user login id create
         $lastUser = User::where('role_id', $user->role_id)->orderBy('id', 'desc')->first();
         $lastLoginId = ($lastUser === null) ? substr('H0000', 1) : substr($lastUser->login_id, 1);
         $nextLoginId = str_pad($lastLoginId + 1, 4, '0', STR_PAD_LEFT);
         $nextLoginIdValue = 'H' . $nextLoginId;
         $user->login_id = $nextLoginIdValue; // created and stored
         $user->permission_id = 1;
         $user->status = 1;
         $user->created_by = Auth::user()->id;
         // user image
         $user->image = $this->data->user->image;
         $user->save();
         // create cod
            $admin  =  new Hod();
            $admin->user_id = $user->id;
            $admin->first_name = $this->data->first_name;
            $admin->last_name = $this->data->last_name;
            $admin->phone = $this->data->phone;
            $admin->address = $this->data->address;
            $admin->email = $this->data->email;
            $admin->save();
            $this->data->hod = 1;
            $this->data->save();
            fmassage('Success', 'New Hod Created Successfully', 'success');
            return redirect()->back();

    }
}
