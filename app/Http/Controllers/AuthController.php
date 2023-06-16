<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $roles = [
        'superAdmin' => 'superAdmin.dashboard',
        'admin' => 'admin.dashboard',
        'student' => 'student.dashboard',
        'teacher' => 'teacher.dashboard',
        'hod' => 'hod.dashboard',
        'cod' => 'cod.dashboard',
        'account' => 'account.dashboard',
        'admission' => 'admission.dashboard',
        'hr' => 'hr.dashboard',
    ];
    public function redirectRoleWise()
    {
        $role = Auth::user()->role->name;
        if (array_key_exists($role, $this->roles)) {
            return redirect()->route($this->roles[$role]);
        }
    }
    public function login()
    {
        if (Auth::check()) {
            if (auth()->user()->status === 0) {
                auth()->logout();
                return redirect()->route('login');
            }
            return $this->redirectRoleWise();
        }
        return view('login.login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'login_id' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['login_id' => $request->login_id, 'password' => $request->password])) {
            if (auth()->user()->status === 0) {
                auth()->logout();
                fmassage();
                return redirect()->route('login');
            }
            $request->session()->regenerate();
            fmassage('Welcome', Auth::user()->name, 'success');
            return $this->redirectRoleWise();
        }
        return redirect()->back();
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
