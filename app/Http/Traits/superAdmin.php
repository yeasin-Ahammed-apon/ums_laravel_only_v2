<?php

namespace App\Http\Traits;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;


trait SuperAdmin
{
    private $pageData;
    public function pageDataCheck($request)
    {
        if ($request->pageData) $this->pageData = intval($request->pageData);
        else $this->pageData = 10;
    }
    public function showUserList($model, $request, $role)
    {
        $this->pageDataCheck($request);
        if ($request->status === '1') {
            $this->datas = $model::whereHas('user', function ($users) {
                $users->where('status', 1);
            })
                ->orderBy('created_at', 'desc')
                ->paginate($this->pageData);
            return view($this->authUser . '.' . $role . '.list', [
                'datas' => $this->datas,
                'title' => "Active Admin List",
                'pageData' => $this->pageData
            ]);
        }
        if ($request->status === '0') {
            $this->datas = $model::whereHas('user', function ($users) {
                $users->where('status', 0);
            })
                ->orderBy('created_at', 'desc')
                ->paginate($this->pageData);
            return view($this->authUser . '.' . $role . '.list', [
                'datas' => $this->datas,
                'title' => "Dective Admin List",
                'pageData' => $this->pageData
            ]);
        }
        if ($request->search) {
            $this->data = $request->search;
            $this->datas = $model::whereHas('user', function ($users) {
                $users->where('login_id', 'LIKE', "%{$this->data}%")
                    ->orWhere('name', 'LIKE', "%{$this->data}%");
            })
                ->orderBy('created_at', 'desc')
                ->paginate($this->pageData);

            return view($this->authUser . '.' . $role . '.list', [
                'datas' => $this->datas,
                'title' => "Admin Search Result List",
                'pageData' => $this->pageData
            ]);
        }
        $this->datas = $model::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($this->pageData);
        return view($this->authUser . '.' . $role . '.list', [
            'datas' => $this->datas,
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
        } catch (ModelNotFoundException $ex) {
            Log::error('Found Exception [Script: ' . __CLASS__ . '@' . __FUNCTION__ . '] [Origin: ' . $ex->getFile() . '-' . $ex->getLine() . ']' . $ex->getMessage());
            return view('exception.userNotFound', [
                "title" => "User Not Found",
                "description" => "User Not Found",
            ]);
        } catch (\Exception $e) {
            return view('exception.userNotFound', [
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
            return view('exception.userNotFound', [
                "title" => "User Not Found",
                "description" => "User Not Found",
            ]);
        } catch (\Exception $e) {
            return view('exception.userNotFound', [
                "title" => "Error",
                "description" => "Something went wrong , plz connect with your devloper",
            ]);
        }
    }
    public function UpdateUser($model, $request, $tableName, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
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
        } catch (ModelNotFoundException $e) {
            return view('exception.userNotFound', [
                "title" => "User Not Found",
                "description" => "User Not Found",
            ]);
        } catch (\Exception $e) {
            return view('exception.userNotFound', [
                "title" => "Error",
                "description" => "Something went wrong , plz connect with your devloper",
            ]);
        }
        $user->name = $request->name;
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
        $this->data = User::findOrFail($user_id);
        $imageName = $this->data->image;
        $this->data->delete();
        $imagePath = public_path('/users/images/');
        unlink($imagePath . $imageName);
        fmassage('Success', 'Admin deleted successfully', 'success');
        return redirect()->route('superAdmin.' . $role . '.index');
    }
}
