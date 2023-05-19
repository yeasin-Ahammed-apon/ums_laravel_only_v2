<?php

namespace App\Http\Traits;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Admission;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


trait SuperAdmin
{
    private $pageData;
    private $request;
    public function showUserList($model, $request, $role)
    {
        $this->request = $request;
        $this->pageData = pageDataCheck($request); // make paginate data default
        $query = $model::with('user');
        $query->whereHas('user',function ($user) {
            if ($this->request->status === '1') $user->where('status', 1);
            elseif ($this->request->status === '0') $user->where('status', 0);
            elseif ($this->request->search) {
                $user->where('login_id', 'LIKE', "%{$this->request->search}%")
                    ->orWhere('name', 'LIKE', "%{$this->request->search}%");
            }
        });
        $datas = $query->orderBy('created_at', 'desc')->paginate($this->pageData);
        return view($this->authUser . '.' . $role . '.list', [
            'datas' => $datas,
            'pageData' => $this->pageData
        ]);
    }
    public function ShowUser($model, $role, $id)
    {
        try {
            $this->data = $model::with('user')->findOrFail($id);
            return view($this->authUser . '.' . $role . '.show', [
                'data' => $this->data,
            ]);
        } catch (\Exception $e) {
            return view('exception.index', [
                "title" => "Error",
                "description" => "Something went wrong , plz connect with your devloper",
            ]);
        }
    }
    public function StoreUser($model, $request, $tableName)
    {
        // validation

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'gender_id' => 'required',
            // 'department_id' => 'required',
            'email' => 'required|email|unique:' . $tableName . '|max:255',
            'password' => 'required|string|min:6|max:255',
            'role' => 'required|string',
            'first_name' => 'required|string|max:255 ',
            'last_name' => 'required|string|max:255 ',
            'phone' => 'required',
            'address' => 'required|string',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);
        // create user
        $user  =  new User();
        $user->name = $request->name;
        $user->gender_id = $request->gender_id;
        ($model===Admin::class||$model===Account::class || $model===Admission::class) ?
        $user->department_id = 0 : $user->department_id = $request->department_id ;
        $user->password = Hash::make($request->password);
        $user->role_id = Role::where('name', $request->role)->first()->id;
        // user login id create
        $lastUser = User::where('role_id', $user->role_id)->orderBy('id', 'desc')->first();
        if ($lastUser === null) $lastUser = 0;
        else $lastUser = $lastUser->id;
        $lastUser = $lastUser + 1;
        $lastUser = strtoupper($user->role->name) . strval($lastUser);

        $user->login_id = $lastUser; // created and now  store
        $user->permission_id = 1;
        $user->status = 1;
        $user->created_by = Auth::user()->id;
        // user image
        $image = $request->file('image');
        $imageName = time() . '-' . $image->getClientOriginalName();
        $imagePath = public_path('/users/images/');
        $image->move($imagePath, $imageName);

        if ($image) { // If the image was successfully stored, update the $user model's image property
            $user->image = $imageName;
            $user->save();
            if ($user && $model === Admin::class) {
                $permission = new Permission();
                $permission->user_id = $user->id;
                $permission->sidebar = adminSidebarOption();
                $permission->save();
                $user->permission_id = $permission->id;
                $user->save();
            }
        }
        // create admin
        if ($user) { // If the user was successfully stored
            $admin  =  new $model();
            $admin->user_id = $user->id;
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;
            $admin->phone = $request->phone;
            $admin->address = $request->address;
            $admin->email = $request->email;
            $admin->save();
        }
        if ($admin) { // // If the admin was successfully stored
            Enotifications('Create ' . $tableName, "new user created . user id is " . $user->id . ". login id is " . $user->login_id);
            fmassage(
                'Success',
                'New ' . $tableName . ' Created Successfully. Login Id is ' . $user->login_id,
                'success'
            );
            return redirect()->back();
        }
    }
    public function EditUser($model, $role, $id)
    {
        try {
            $this->data = $model::with('user')->findOrFail($id);
            return view($this->authUser . '.' . $role . '.edit', [
                'data' => $this->data,
            ]);
        } catch (ModelNotFoundException $e) {
            return view('exception.index', [
                "title" => "User Not Found",
                "description" => "User Not Found",
            ]);
        } catch (\Exception $e) {
            return view('exception.index', [
                "title" => "Error",
                "description" => "Something went wrong , plz connect with your devloper",
            ]);
        }
    }
    public function UpdateUser($model, $request, $tableName, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'gender_id' => 'required',
            // 'department_id' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique($tableName)->ignore($id, 'user_id'),
                'max:255',
            ],
            'role' => 'required|string',
            'first_name' => 'required|string|max:255 ',
            'last_name' => 'required|string|max:255 ',
            'phone' => 'required',
            'address' => 'required|string',
            'image' => 'image|mimes:jpeg,jpg,png|max:2048',
            'status' => 'required',
        ]);
        // Find the user by ID
        try {
            $user = User::findOrFail($id);
        } catch (\Exception $e) {
            return view('exception.index', [
                "title" => "Error",
                "description" => "Something went wrong , plz connect with your devloper",
            ]);
        }

        $user->name = $request->name;
        $user->gender_id = $request->gender_id;
        $user->department_id = $request->department_id;
        $user->status = $request->status;
        $user->role_id = Role::where('name', $request->role)->first()->id;
        if (!empty($request->password)) { // Update password if a new password is provided
            $validatedData = $request->validate(['password' => 'min:6|max:255']);
            $user->password = Hash::make($request->password);
        }
        $image = $request->file('image');
        if ($image) {
            $imageName = time() . '-' . $image->getClientOriginalName();
            $imagePath = public_path('/users/images/');
            $image->move($imagePath, $imageName);
            $user->image = $imageName;
        }
        $user->save();
        $admin = $model::where('user_id', $user->id)->first(); // Find the associated admin and update their information
        if ($admin) {
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;
            $admin->phone = $request->phone;
            $admin->address = $request->address;
            $admin->email = $request->email;
            $admin->updated_at = Carbon::now();
            $admin->save();
        }
        Enotifications('updated Admin', "updated user  . user id is " . $user->id . ". login id is " . $user->login_id);
        fmassage('Success', 'Admin information updated successfully', 'success');
        return redirect()->back();
    }
    public function UpdateStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status;
        $user->save();
        fmassage('Success', 'Admin Status updated successfully', 'success');
        return redirect()->back();
    }
    public function DeleteUser($model, $role, $id)
    {
        $this->data = $model::findOrFail($id);
        $user_id = $this->data->user_id;
        $this->data->delete();
        // $this->data = User::findOrFail($user_id);
        // $imageName = $this->data->image;
        // $this->data->delete();
        // $imagePath = public_path('/users/images/');
        // unlink($imagePath . $imageName);
        fmassage('Success', 'Admin deleted successfully', 'success');
        return redirect()->route('superAdmin.' . $role . '.index');
    }
}
