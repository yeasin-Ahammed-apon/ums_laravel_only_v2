<?php

namespace App\Http\Controllers\cod;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CodController extends Controller
{
    public function dashboard(){
        return view('csd');
    }
}
