<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\SuperAdmin;
use App\Models\Cod;
use App\Models\Hod;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTeacherController extends Controller
{
    use SuperAdmin;
    private $data;
    private $datas;
    private $authUser = 'admin';
    public function index(Request $request)
    {
        return $this->showUserList(Teacher::class, $request, 'teacher');
    }
    public function create()
    {
        return view('admin.teacher.create');
    }
    public function store(Request $request)
    {
        return $this->StoreUser(Teacher::class,$request,'teachers');
    }
    public function show($id)
    {
        return $this->ShowUser(Teacher::class,'teacher',$id);
    }
    public function edit($id)
    {
        return $this->EditUser(Teacher::class,'teacher',$id);
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
        if ($lastUser===null)$lastUser = 0;
        else $lastUser = $lastUser->id;
        $lastUser = $lastUser + 1;
        $lastUser= strtoupper($user->role->name).strval($lastUser);
         $user->login_id = $lastUser; // created and stored
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
        if ($lastUser===null)$lastUser = 0;
        else $lastUser = $lastUser->id;
        $lastUser = $lastUser + 1;
        $lastUser= strtoupper($user->role->name).strval($lastUser);
         $user->login_id = $lastUser; // created and stored
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
