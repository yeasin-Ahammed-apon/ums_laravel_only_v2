<?php

namespace App\Http\Controllers\libraryManagement;

use App\Http\Controllers\Controller;
use App\Models\LibraryBook;
use App\Models\LibraryBookCopy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Library;

class LibraryBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $data;
    protected $datas;
    protected $request;
    public function index(Request $request)
    {
        $this->request = $request;
        $this->pageData = pageDataCheck($this->request);
        $this->datas = LibraryBook::query()
            ->when($this->request->status === '1', function ($query) {
                $query->where('status', 1);
            })
            ->when($this->request->status === '0', function ($query) {
                $query->where('status', 0);
            })
            ->when($this->request->search, function ($query) {
                $query->where('name', 'LIKE', "%{$this->request->search}%")
                ->orWhere('author', 'LIKE', "%{$this->request->search}%")
                ->orWhere('code', 'LIKE', "%{$this->request->search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->pageData);
        $this->datas = queryAppend($this->request, $this->datas, ['pageData', 'seen', 'unseen', 'search']);
        return view('libraryManagement.books.list',[
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
        return view('libraryManagement.books.create');
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
            'code' => 'max:255',
            'description' => 'max:255',
        ]);
        $image = storeFile($request, '/library');
        if ($image) {
            $this->data = new LibraryBook();
            $this->data->image = $image['fileName'];
            $this->data->name = $request->name;
            $this->data->code  = $request->code ?? '';
            $this->data->description = $request->description ?? '';
            $this->data->library_categorie_id = $request->library_categorie_id ?? null;
            $this->data->department_id = $request->department_id ?? null;
            $this->data->user_id = Auth::user()->id;
            $this->data->author = $request->author ?? null;
            $this->data->publisher = $request->publisher ?? null;
            $this->data->isbn = $request->isbn ?? null;
            $this->data->reck = $request->reck ?? null;
            $this->data->save();
            if (!$this->data) {
                deleteFile($image,'/library');
                fmassage('Fail', 'library book is not save', 'error');
                return redirect()->back();
            }
            fmassage('Success', 'library book is save', 'success');
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = LibraryBook::findOrFail($id);
        $datas = LibraryBookCopy::where('library_book_id',$id)->get();
        // dd($datas);
        return view('libraryManagement.books.show',['data'=>$data,'datas'=>$datas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = LibraryBook::findOrFail($id);
        return view('libraryManagement.books.edit',['data'=>$data]);
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'max:255',
            'description' => 'max:255',
        ]);
        $this->data = LibraryBook::findOrFail($id);
        if ($request->image) {
            $image = storeFile($request, '/library');
        }else{
            $image['fileName'] = $this->data->image;
        }
        if ($image) {
            $this->data->image = $image['fileName'];
            $this->data->name = $request->name;
            $this->data->code  = $request->code ?? '';
            $this->data->description = $request->description ?? '';
            $this->data->library_categorie_id = $request->library_categorie_id ?? null;
            $this->data->department_id = $request->department_id ?? null;
            $this->data->author = $request->author ?? null;
            $this->data->publisher = $request->publisher ?? null;
            $this->data->isbn = $request->isbn ?? null;
            $this->data->reck = $request->reck ?? null;
            $this->data->status = $request->status;
            $this->data->save();
            if (!$this->data) {
                if ($request->image) {
                    deleteFile($image,'/library');
                }
                fmassage('Fail', 'library book is not update', 'error');
                return redirect()->back();
            }
            fmassage('Success', 'library book is update', 'success');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->data = LibraryBook::findOrFail($id);
        $this->data->delete();
        if ($this->data) {
            $datas = LibraryBookCopy::where("library_book_id",$id)->get();
            foreach ($datas as  $value) {
                LibraryBookCopy::find($value->id)->delete();
            }
            fmassage('Success', 'library book Status deleted successfully', 'success');
            return redirect()->route('superAdmin.library.book.index');
        }
    }
    public function status($id)
    {
        $this->data = LibraryBook::findOrFail($id);
        $this->data->status = !$this->data->status;
        $this->data->save();
        fmassage('Success', 'library book Status updated successfully', 'success');
        return redirect()->back();
    }
}
