<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
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
            $this->datas = Program::where('name', 'LIKE', "%{$this->data}%")
                ->orderBy('created_at', 'desc')
                ->paginate($this->pageData);

            return view('program.list', [
                'datas' => $this->datas,
                'title' => "Program Search Result List",
                'pageData' => $this->pageData
            ]);
        }
        $this->datas = Program::orderBy('created_at', 'desc')
            ->paginate($this->pageData);
        return view('program.list', [
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
        return view('program.create');
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
        $this->data = new Program();
        $this->data->name = $request->name;
        $this->data->save();
        if (!$this->data) {
            fmassage('Fail', 'Program is not save', 'error');
            return redirect()->back();
        }
        fmassage('Success', 'Program is save', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        return redirect()->route('program.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        try {
            return view('program.edit', ['data' => $program]);
        } catch (\Exception $ex) {
            LogError($ex);
            return view('exception.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $this->data = $program;
        $this->data->name = $request->name;
        $this->data->save();
        if (!$this->data) {
            fmassage('Fail', 'program is not Update', 'error');
            return redirect()->back();
        }
        fmassage('Success', 'program is Updated', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        try {
            $program->delete();
        } catch (\Exception $ex) {
            LogError($ex);
            return view('exception.index');
        }
        fmassage('Suucess','program deleted Succussfully','success');
        return redirect()->route('program.index');
    }
}
