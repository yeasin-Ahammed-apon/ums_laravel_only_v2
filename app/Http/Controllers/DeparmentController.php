<?php

namespace App\Http\Controllers;

use App\Models\Deparment;
use Illuminate\Http\Request;

class DeparmentController extends Controller
{
    private $data;
    private $datas;
    private $pageData;
    public function index(Request $request)
    {
        $this->pageData=pageDataCheck($request);
        if ($request->status === '1') {
            $this->datas = Deparment::where('status', 1)
                ->orderBy('created_at', 'desc')
                ->paginate($this->pageData);
            return view('department.list', [
                'datas' => $this->datas,
                'title' => "Active department List",
                'pageData' => $this->pageData
            ]);
        }
        if ($request->status === '0') {
            $this->datas = Deparment::where('status', 0)
                ->orderBy('created_at', 'desc')
                ->paginate($this->pageData);
            return view('department.list', [
                'datas' => $this->datas,
                'title' => "Dective department List",
                'pageData' => $this->pageData
            ]);
        }
        if ($request->search) {
            $this->data = $request->search;
            $this->datas = Deparment::where('name', 'LIKE', "%{$this->data}%")
                ->orderBy('created_at', 'desc')
                ->paginate($this->pageData);

            return view('department.list', [
                'datas' => $this->datas,
                'title' => "department Search Result List",
                'pageData' => $this->pageData
            ]);
        }
        $this->datas = Deparment::orderBy('created_at', 'desc')
            ->paginate($this->pageData);
        return view('department.list', [
            'datas' => $this->datas,
            'pageData' => $this->pageData
        ]);
    }
    public function create()
    {
        return view('department.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'faculty_id'=> 'required',
            'program_id'=> 'required',
        ]);
        $this->data = new Deparment();
        $this->data->name = $request->name;
        $this->data->code = $request->code;
        $this->data->faculty_id = $request->faculty_id;
        $this->data->program_id = $request->program_id;
        $this->data->save();
        if ($this->data) {
            fmassage('success','department created successfully');
            return redirect()->back();
        }

    }
    public function show(Deparment $department)
    {
        return redirect()->back();
        // return view('department.show', [
        //     'data' => $department,
        // ]);
    }
    public function edit(Deparment $department)
    {
        return view('department.edit',['data'=>$department]);
    }
    public function update(Request $request, Deparment $department)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'faculty_id'=> 'required',
            'program_id'=> 'required',
        ]);
        $this->data = $department;
        $this->data->name = $request->name;
        $this->data->code = $request->code;
        $this->data->faculty_id = $request->faculty_id;
        $this->data->program_id = $request->program_id;
        $this->data->status = $request->status;
        $this->data->save();
        if ($this->data) {
            fmassage('success','department update successfully');
            return redirect()->back();
        }
    }
    public function status(Deparment $department){
        $user = $department;
        $user->status = !$user->status;
        $user->save();
        fmassage('Success', 'department Status updated successfully', 'success');
        return redirect()->back();
    }
    public function destroy(Deparment $department)
    {
        $department->delete();
        return redirect()->route('department.index');
    }

}
