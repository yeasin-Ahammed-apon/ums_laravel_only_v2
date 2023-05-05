<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function login(){
        if (Auth::check()) {
            $role = Auth::user()->role->name;
        if ($role === "superAdmin") { // superAdmin check
            return redirect()->route('superAdmin.dashboard');
        } elseif ($role === "admin") { // admin check
            return redirect()->route('admin.dashboard');
        } elseif ($role === "student") { // student check
            return redirect()->route("student.dashboard");
        }elseif ($role === "teacher") { // teacher check
            return redirect()->route('teacher.dashboard');
        }elseif ($role === "hod") { // hod check
            return redirect()->route('hod.dashboard');
        }elseif ($role === "cod") { // cod check
            return redirect()->route('cod.dashboard');
        }elseif ($role === "account") { // account check
            return redirect()->route('account.dashboard');
        }elseif ($role === "admission") { // admission check
            return redirect()->route('admission.dashboard');
        }
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
            $request->session()->regenerate();
            $role = Auth::user()->role->name;
            fmassage('Welcome',Auth::user()->name,'success');
        if ($role === "superAdmin") { // superAdmin check
            return redirect()->route('superAdmin.dashboard');
        } elseif ($role === "admin") { // admin check
            return redirect()->route('admin.dashboard');
        } elseif ($role === "student") { // student check
            return redirect()->route("student.dashboard");
        }elseif ($role === "teacher") { // teacher check
            return redirect()->route('teacher.dashboard');
        }elseif ($role === "hod") { // hod check
            return redirect()->route('hod.dashboard');
        }elseif ($role === "cod") { // cod check
            return redirect()->route('cod.dashboard');
        }elseif ($role === "account") { // account check
            return redirect()->route('account.dashboard');
        }elseif ($role === "admission") { // admission check
            return redirect()->route('admission.dashboard');
        }
        }
        return back();
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

}
