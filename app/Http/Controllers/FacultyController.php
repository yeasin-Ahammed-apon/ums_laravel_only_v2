<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
// use Exception;
use Illuminate\Http\Request;

class FacultyController extends Controller
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
        $this->pageData = pageDataCheck($request);
        if ($request->search) {
            $this->data = $request->search;
            $this->datas = Faculty::where('name', 'LIKE', "%{$this->data}%")
                ->orderBy('created_at', 'desc')
                ->paginate($this->pageData);

            return view('faculty.list', [
                'datas' => $this->datas,
                'title' => "Admin Search Result List",
                'pageData' => $this->pageData
            ]);
        }
        $this->datas = Faculty::orderBy('created_at', 'desc')
            ->paginate($this->pageData);
        return view('faculty.list', [
            'datas' => $this->datas,
            'pageData' => $this->pageData
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $this->data = new Faculty();
        $this->data->name = $request->name;
        $this->data->save();
        if (!$this->data) {
            fmassage('Fail', 'Faculty is not save', 'error');
            return redirect()->back();
        }
        fmassage('Success', 'Faculty is save', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show(Faculty $faculty)
    {
        return redirect()->route('faculty.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit(Faculty $faculty)
{
    try {
        return view('faculty.edit', ['data' => $faculty]);
    } catch (\Exception $ex) {
        LogError($ex);
        return view('exception.index');
    }
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faculty $faculty)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $this->data = $faculty;
        $this->data->name = $request->name;
        $this->data->save();
        if (!$this->data) {
            fmassage('Fail', 'Faculty is not Update', 'error');
            return redirect()->back();
        }
        fmassage('Success', 'Faculty is Updated', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faculty $faculty)
    {
        try {
            $faculty->delete();
        } catch (\Exception $ex) {
            LogError($ex);
            return view('exception.index');
        }
        fmassage('Suucess','Faculty deleted Succussfully','success');
        return redirect()->route('faculty.index');

    }
}
