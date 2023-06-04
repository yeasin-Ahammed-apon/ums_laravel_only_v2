<?php

namespace App\Http\Controllers;

use App\Models\Deparment;
use App\Models\DepartmentCourseFeeInfo;
use App\Models\DepartmentWaiver;
use Illuminate\Http\Request;


class DeparmentController extends Controller
{
    private $data;
    private $datas;

    public function index(Request $request)
    {
        $this->pageData = pageDataCheck($request);
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
            // dd($this->datas);
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
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'faculty_id' => 'required',
            'program_id' => 'required',
            'duration_year' => 'required',
            'duration_semester' => 'required',
            'credit' => 'required',
            'admission_fee' => 'required',
            'session_fee' => 'required',
            'per_credit_fee' => 'required',
            'total_fee' => 'required',

        ]);
        $department = new Deparment();
        $department->name = $request->name;
        $department->faculty_id = $request->faculty_id;
        $department->program_id = $request->program_id;
        $department->save();
        if($department){
            $departmentWaiver =  new DepartmentWaiver();
            $departmentWaiver->department_id = $department->id;
            $departmentWaiver->level1 = 10;
            $departmentWaiver->level2 = 20;
            $departmentWaiver->level3 = 30;
            $departmentWaiver->level4 = 50;
            $departmentWaiver->level5 = 100;
            $departmentWaiver->save();
        }else {
                fmassage('Fail', 'Department  create fail', 'error');
                return redirect()->back();
        }
        if ($department) {
            $departmentCourseFeeInfo = new DepartmentCourseFeeInfo();
            $departmentCourseFeeInfo->deparment_id = $department->id;
            $departmentCourseFeeInfo->duration_year = intval($request->duration_year) ;
            $departmentCourseFeeInfo->duration_semester = intval($request->duration_semester);
            $departmentCourseFeeInfo->credit = intval($request->credit);
            $departmentCourseFeeInfo->admission_fee = intval($request->admission_fee);
            $departmentCourseFeeInfo->session_fee = intval($request->session_fee);
            $departmentCourseFeeInfo->per_credit_fee = intval($request->per_credit_fee);
            $departmentCourseFeeInfo->total_fee = intval($request->total_fee);
            $departmentCourseFeeInfo->save();
        }
        if (!$departmentCourseFeeInfo) {
            $department->delete();
            fmassage('error', 'department update fail');
            return redirect()->back();
        }
        fmassage('success', 'department updated successfully');
        return redirect()->back();
    }
    public function show(Deparment $department)
    {
        return view('department.show', [
            'data' => $department,
        ]);
    }
    public function edit(Deparment $department)
    {
        return view('department.edit', ['data' => $department]);
    }
    public function update(Request $request, Deparment $department)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'faculty_id' => 'required',
            'program_id' => 'required',
            'duration_year' => 'required',
            'duration_semester' => 'required',
            'credit' => 'required',
            'admission_fee' => 'required',
            'session_fee' => 'required',
            'per_credit_fee' => 'required',
            'total_fee' => 'required',
        ]);
        $department = $department;
        $department->name = $request->name;
        $department->faculty_id = $request->faculty_id;
        $department->program_id = $request->program_id;
        $department->status = $request->status;
        $department->save();

        if ($department) {
            $departmentCourseFeeInfo = DepartmentCourseFeeInfo::where('deparment_id',$department->id)->first();
            $departmentCourseFeeInfo->duration_year = intval($request->duration_year) ;
            $departmentCourseFeeInfo->duration_semester = intval($request->duration_semester);
            $departmentCourseFeeInfo->credit = intval($request->credit);
            $departmentCourseFeeInfo->admission_fee = intval($request->admission_fee);
            $departmentCourseFeeInfo->session_fee = intval($request->session_fee);
            $departmentCourseFeeInfo->per_credit_fee = intval($request->per_credit_fee);
            $departmentCourseFeeInfo->total_fee = intval($request->total_fee);
            $departmentCourseFeeInfo->save();
        }
        if (!$departmentCourseFeeInfo) {
            $department->delete();
            fmassage('error', 'department create fail');
            return redirect()->back();
        }
        fmassage('success', 'department created successfully');
        return redirect()->back();
    }
    public function status(Deparment $department)
    {
        $user = $department;
        $user->status = !$user->status;
        $user->save();
        fmassage('Success', 'department Status updated successfully', 'success');
        return redirect()->back();
    }
    public function destroy(Deparment $department)
    {
        $id =$department->id;
        $departmentCourseFeeInfo =DepartmentCourseFeeInfo::where('deparment_id',$id)->first();
        $department->delete();
        $departmentCourseFeeInfo->delete();
        fmassage('Success', 'department deleted successfully', 'success');
        return redirect()->route('department.index');
    }
    public function waiver_edit(DepartmentWaiver $waiver){
        return view('department.update_waiver',[
            'data'=>$waiver
        ]);
    }
    public function waiver_update(Request $request,DepartmentWaiver $waiver){
        $waiver->level1 =$request->level1;
        $waiver->level2 =$request->level2;
        $waiver->level3 =$request->level3;
        $waiver->level4 =$request->level4;
        $waiver->level5 =$request->level5;
        $waiver->save();
        fmassage('success','updated','success');
        return redirect()->back();
    }
}
