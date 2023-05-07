<?php

namespace App\Http\Controllers\superAdmin;

use App\Http\Controllers\Controller;
use App\Http\Traits\SuperAdmin;
use App\Models\Cod;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SuperAdminCodController extends Controller
{
    use SuperAdmin;
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $data;
    private $datas;
    public function index(Request $request)
    {
        return $this->showUserList(Admin::class, $request, 'admin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superAdmin.cod.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->StoreUser(Cod::class,$request,'cods','C');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data = Cod::with('user')->findOrFail($id);
        return view('superAdmin.cod.show',[
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
        $this->data = Cod::with('user')->find($id);
        return view('superAdmin.cod.edit', [
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
        return $this->UpdateUser(Cod::class,$request,'cods',$id);
    }
/**
     * Update the specified resource field  from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
       return $this->UpdateStatus($id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->DeleteUser(Cod::class,'cod',$id);
    }

}
