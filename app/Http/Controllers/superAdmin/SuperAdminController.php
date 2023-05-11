<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;

class SuperAdminController extends Controller
{
    private $data;
    private $datas;
    public function dashboard()
    {
        // dd(User::find(2)->role->name);
        // $sidebar = json_encode($sidebar);
        //  $data =  new Permission();
        //  $data->user_id = 1;
        //  $data->sidebar = $sidebar;
        //  $data->save();
        // $sidebar = json_decode($sidebar, "1");
        return view('superAdmin.dashboard.dashboard');
    }


}
