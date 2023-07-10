<?php

namespace App\Http\Controllers\libraryManagement;

use App\Http\Controllers\Controller;
use App\Models\LibraryBook;
use App\Models\LibraryBookCopy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryBookCopyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $data;
    protected $datas;
    protected $request;
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = LibraryBook::findOrFail($request->id);
        return view('libraryManagement.bookCopy.create',['data'=>$data]);

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
            'id' => 'required',
            'code' => 'required',
        ]);
        $this->data = new LibraryBookCopy();
        $this->data->code = $request->code;
        $this->data->library_book_id = $request->id;
        $this->data->user_id = Auth::user()->id;
        $this->data->save();
        if (!$this->data) {
            fmassage('Fail', 'Library book Copy is not save', 'error');
            return redirect()->back();
        }
        $data = LibraryBook::find($request->id);
        $data->stock_in = $data->stock_in+1;
        $data->save();
        fmassage('Success', 'Library book Copy is save', 'success');
        return redirect()->back();
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
        $data = LibraryBookCopy::findOrFail($id);
        return view('libraryManagement.bookCopy.edit',['data'=>$data]);
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
        // dd($id);
        $validatedData = $request->validate([
            'code' => 'required',
        ]);
        $this->data = LibraryBookCopy::findOrFail($id);
        $this->data->code = $request->code;
        $this->data->status = $request->status;
        $this->data->save();
        if (!$this->data) {
            fmassage('Fail', 'library book copy is not update', 'error');
            return redirect()->back();
        }
        fmassage('Success', 'library book copy is update', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->data = LibraryBookCopy::findOrFail($id);
        $book_id =$this->data->library_book_id;
        $book_status =$this->data->status;
        $this->data->delete();
        if ($this->data) {
            $data = LibraryBook::find($book_id);
            if ($book_status ) $data->stock_in = $data->stock_in - 1;
            else $data->stock_out = $data->stock_out - 1;
            $data->save();
            fmassage('Success', 'library book copy  deleted successfully', 'success');
            return redirect()->back();
        }
    }
    public function status($id)
    {
        $this->data = LibraryBookCopy::findOrFail($id);
        $this->data->status = !$this->data->status;
        $this->data->save();
        $book_id =$this->data->library_book_id;
        $data = LibraryBook::find($book_id);
        if ($this->data->status){
            $data->stock_in = $data->stock_in + 1;
            $data->stock_out = $data->stock_out - 1;
            $data->save();
        }else {
            $data->stock_in = $data->stock_in - 1;
            $data->stock_out = $data->stock_out + 1;
            $data->save();
        }
        fmassage('Success', 'library book copy Status updated successfully', 'success');
        return redirect()->back();
    }
}
