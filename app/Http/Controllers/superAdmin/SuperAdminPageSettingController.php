<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SuperAdminPageSettingController extends Controller
{
    private $data;
    private $datas;

    public function user_page_settings($id)
    {
        try {

            $this->data = Permission::where('user_id', $id)->first();
            $id = $this->data->user_id;
            $sidebar = dataDecode($this->data->sidebar);
            return view('superAdmin.userPageSettings.userPageSettings', [
                'id'=>$id,
                'sidebar' => $sidebar
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
    public function user_page_settings_update(Request $request){
        // dd($request->menu);
        // // dd(dataEncode($request->menu));
        if ($request->setting=='sidebar') {
            $this->data = Permission::where('user_id', $request->user_id)->first();
            $this->data->sidebar = dataEncode($request->menu);
            $this->data->save();
            if ($this->data) {
                return redirect()->back();
            }
        }
    }
}
