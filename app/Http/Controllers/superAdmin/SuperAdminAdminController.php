<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;



class SuperAdminAdminController extends Controller
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
                $this->datas = Admin::whereHas('user', function ($users) {
                $users->where('status', 1);
                })->paginate(10);
                return view('superAdmin.admin.list',[
                    'datas'=>$this->datas,
                    'title'=> "Active Admin List"
               ]);
            }
            if ($request->status === '0') {
                $this->datas = Admin::whereHas('user', function ($users) {
                $users->where('status', 0);
                })->paginate(10);
                return view('superAdmin.admin.list',[
                    'datas'=>$this->datas,
                    'title'=> "Dective Admin List"
               ]);
            }
            if ($request->search) {
                $this->data = $request->search;
                $this->datas = Admin::whereHas('user', function ($users) {
                $users->where('login_id', 'LIKE', "%{$this->data}%")
                ->orWhere('name', 'LIKE', "%{$this->data}%");
                })->paginate(10);

            return view('superAdmin.admin.list',[
                'datas'=>$this->datas,
                'title'=> "Admin Search Result List"
            ]);
            }


        $this->datas = Admin::with('user')->paginate(10);
        return view('superAdmin.admin.list',[
                'datas'=>$this->datas
           ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
