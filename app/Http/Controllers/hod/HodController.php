<?php

namespace App\Http\Controllers\hod;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HodController extends Controller
{
    public function dashboard(){
        return view('csd');
    }//
}
