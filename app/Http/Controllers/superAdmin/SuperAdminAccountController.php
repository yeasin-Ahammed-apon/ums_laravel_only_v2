<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SuperAdminAccountController extends Controller
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
            $this->datas = Account::whereHas('user', function ($users) {
                $users->where('status', 1);
            })->paginate(10);
            return view('superAdmin.account.list', [
                'datas' => $this->datas,
                'title' => "Active Admin List"
            ]);
        }
        if ($request->status === '0') {
            $this->datas = Account::whereHas('user', function ($users) {
                $users->where('status', 0);
            })->paginate(10);
            return view('superAdmin.account.list', [
                'datas' => $this->datas,
                'title' => "Dective Admin List"
            ]);
        }
        if ($request->search) {
            $this->data = $request->search;
            $this->datas = Account::whereHas('user', function ($users) {
                $users->where('login_id', 'LIKE', "%{$this->data}%")
                    ->orWhere('name', 'LIKE', "%{$this->data}%");
            })->paginate(10);

            return view('superAdmin.account.list', [
                'datas' => $this->datas,
                'title' => "Admin Search Result List"
            ]);
        }


        $this->datas = Account::with('user')->paginate(10);
        return view('superAdmin.account.list', [
            'datas' => $this->datas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superAdmin.account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:accounts|max:255',
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
        $lastLoginId = ($lastUser === null) ? substr('AC0000', 1) : substr($lastUser->login_id, 1);
        $nextLoginId = str_pad($lastLoginId + 1, 4, '0', STR_PAD_LEFT);
        $nextLoginIdValue = 'AC' . $nextLoginId;
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
            $admin  =  new Account();
            $admin->user_id = $user->id;
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;
            $admin->phone = $request->phone;
            $admin->address = $request->address;
            $admin->email = $request->email;
            $admin->save();
        }
        if ($admin) { // // If the admin was successfully stored
            Enotifications('Create account',"new user created . user id is ".$user->id.". login id is ".$user->login_id);
            fmassage('Success', 'New Admin Created Successfully', 'success');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data = Account::with('user')->findOrFail($id);
        return view('superAdmin.account.show',[
            'data'=>$this->data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data = Account::with('user')->find($id);
        return view('superAdmin.account.edit', [
            'data' => $this->data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('accounts')->ignore($id, 'user_id'),
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
        $admin = Account::where('user_id', $user->id)->first();
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
        Enotifications('updated Admin',"updated user  . user id is ".$user->id.". login id is ".$user->login_id);
        fmassage('Success', 'Admin information updated successfully', 'success');
        return redirect()->back();
    }
/**
     * Update the specified resource field  from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status;
        $user->save();
        Enotifications('Status update account',"user Status updated . user id is ".$user->id.". login id is ".$user->login_id);
        fmassage('Success', 'Admin Status updated successfully', 'success');
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Account::findOrFail($id);
        $user_id = $admin->user_id;
        $admin->delete();
        $user = User::findOrFail($user_id);
        $imageName = $user->image;
        $user->delete();
        $imagePath = public_path('/users/images/');
        unlink($imagePath . $imageName);
        Enotifications('Deleted account'," user deleted . user id is ".$user->id.". login id is ".$user->login_id);
        fmassage('Success', 'Admin deleted successfully', 'success');
        return redirect()->route('superAdmin.account.index');
    }
}
