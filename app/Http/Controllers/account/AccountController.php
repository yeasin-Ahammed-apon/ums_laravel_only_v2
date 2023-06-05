<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use App\Models\TemporaryStudent;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function dashboard(){
        return view('account.dashboard.dashboard');
    }
    public function profile(){
        return view('account.profile.profile');
    }
}
