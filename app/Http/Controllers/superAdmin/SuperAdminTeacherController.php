<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\Cod;
use App\Models\Hod;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SuperAdminTeacherController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $data;
    private $datas;
    public function index(Request $request)
    {
        // 1 mean active
        // 0 mean deactive
        if ($request->status === '1') {
            $this->datas = Teacher::whereHas('user', function ($users) {
                $users->where('status', 1);
            })->paginate(10);
            return view('superAdmin.teacher.list', [
                'datas' => $this->datas,
                'title' => "Active Admin List"
            ]);
        }
        if ($request->status === '0') {
            $this->datas = Teacher::whereHas('user', function ($users) {
                $users->where('status', 0);
            })->paginate(10);
            return view('superAdmin.teacher.list', [
                'datas' => $this->datas,
                'title' => "Dective Admin List"
            ]);
        }
        if ($request->search) {
            $this->data = $request->search;
            $this->datas = Teacher::whereHas('user', function ($users) {
                $users->where('login_id', 'LIKE', "%{$this->data}%")
                    ->orWhere('name', 'LIKE', "%{$this->data}%");
            })->paginate(10);

            return view('superAdmin.teacher.list', [
                'datas' => $this->datas,
                'title' => "Admin Search Result List"
            ]);
        }


        $this->datas = Teacher::with('user')->paginate(10);
        return view('superAdmin.teacher.list', [
            'datas' => $this->datas
        ]);
    }
    public function create()
    {
        return view('superAdmin.teacher.create');
    }
    public function store(Request $request)
    {
        // validation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins|max:255',
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
        $lastLoginId = ($lastUser === null) ? substr('T0000', 1) : substr($lastUser->login_id, 1);
        $nextLoginId = str_pad($lastLoginId + 1, 4, '0', STR_PAD_LEFT);
        $nextLoginIdValue = 'T' . $nextLoginId;
        $user->login_id = $nextLoginIdValue; // created and stored
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
        }
        // create admin
        if ($user) { // If the user was successfully stored
            $admin  =  new Teacher();
            $admin->user_id = $user->id;
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;
            $admin->phone = $request->phone;
            $admin->address = $request->address;
            $admin->email = $request->email;
            $admin->save();
        }
        if ($admin) { // // If the admin was successfully stored
            fmassage('Success', 'New Admin Created Successfully', 'success');
            return redirect()->back();
        }
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('teachers')->ignore($id, 'user_id'),
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
        $user = User::findOrFail($id);
        // Update user information
        $user->name = $request->name;
        $user->status = $request->status;
        // $user->updated_at = Carbon::now();
        $user->role_id = Role::where('name', $request->role)->first()->id;
        // Update password if a new password is provided
        if (!empty($request->password)) {
            $validatedData = $request->validate(['password' => 'min:6|max:255']);
            $user->password = Hash::make($request->password);
        }
        // Update user image
        $image = $request->file('image');
        if ($image) {
            $imageName = time() . '-' . $image->getClientOriginalName();
            $imagePath = public_path('/users/images/');
            $image->move($imagePath, $imageName);
            $user->image = $imageName;
        }
        // Save user changes
        $user->save();
        // Find the associated admin and update their information
        $admin = Teacher::where('user_id', $user->id)->first();
        if ($admin) {
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;
            $admin->phone = $request->phone;
            $admin->address = $request->address;
            $admin->email = $request->email;
            $admin->updated_at = Carbon::now();
            $admin->save();
        }

        // Redirect back to the user's edit page
        fmassage('Success', 'Admin information updated successfully', 'success');
        return redirect()->back();
    }
    public function status($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status;
        $user->save();

        fmassage('Success', 'Admin Status updated successfully', 'success');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $this->data = Teacher::find($id);
        $user_id = $this->data->user_id;
        $this->data->delete();
        $this->data = User::find($user_id);
        $imageName = $this->data->image;
        $this->data->delete();
        $imagePath = public_path('/users/images/');
        unlink($imagePath . $imageName);
        fmassage('Success', 'Admin deleted successfully', 'success');
        return redirect()->route('superAdmin.teacher.index');
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
