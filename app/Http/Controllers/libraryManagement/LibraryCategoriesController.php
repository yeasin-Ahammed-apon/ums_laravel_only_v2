<?php

namespace App\Http\Controllers\libraryManagement;

use App\Http\Controllers\Controller;
use App\Models\LibraryCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Library;

class LibraryCategoriesController extends Controller
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
        $this->datas = LibraryCategories::query()
            ->when($this->request->status === '1', function ($query) {
                $query->where('status', 1);
            })
            ->when($this->request->status === '0', function ($query) {
                $query->where('status', 0);
            })
            ->when($this->request->search, function ($query) {
                $query->where('name', 'LIKE', "%{$this->request->search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->pageData);

        $this->datas = queryAppend($this->request, $this->datas, ['pageData', 'seen', 'unseen', 'search']);
        return view('libraryManagement.categories.list',
            [
                'datas' => $this->datas,
                'pageData' => $this->pageData,
                'title'=>"library categories"
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('libraryManagement.categories.create');
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
            // 'description' => 'required|string|max:255',
        ]);
        $this->data = new LibraryCategories();
        $this->data->name = $request->name;
        $this->data->description = $request->description;
        // $this->data->status = 1;
        $this->data->user_id = Auth::user()->id;
        $this->data->save();
        if (!$this->data) {
            fmassage('Fail', 'Library Categories is not save', 'error');
            return redirect()->back();
        }
        fmassage('Success', 'Library Categories is save', 'success');
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
        $this->data = LibraryCategories::findOrFail($id);
        return view('libraryManagement.categories.show', ['data' => $this->data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data = LibraryCategories::findOrFail($id);
        return view('libraryManagement.categories.edit', ['data' => $this->data]);
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
            'description' => 'string|max:255',
        ]);
        $this->data = LibraryCategories::findOrFail($id);
        $this->data->name = $request->name;
        $this->data->description = $request->description;
        $this->data->status = $request->status;
        $this->data->save();
        if (!$this->data) {
            fmassage('Fail', 'library Categories is not save', 'error');
            return redirect()->back();
        }
        fmassage('Success', 'library Categories is save', 'success');
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
        $this->data = LibraryCategories::findOrFail($id);
        $this->data->delete();
        if ($this->data) {
            fmassage('Success', 'library Categories  deleted successfully', 'success');
            return redirect()->route('superAdmin.library.categorie.index');
        }
    }
    public function status($id)
    {
        $this->data = LibraryCategories::findOrFail($id);
        $this->data->status = !$this->data->status;
        $this->data->save();
        fmassage('Success', 'library Categories Status updated successfully', 'success');
        return redirect()->back();
    }
    // public function item(Request $request)
    // {
    //     $this->request = $request;
    //     $this->pageData = pageDataCheck($this->request);
    //     $this->datas = InventoryCategories::query()
    //         ->when($this->request->status === '1', function ($query) {
    //             $query->where('status', 1);
    //         })
    //         ->when($this->request->status === '0', function ($query) {
    //             $query->where('status', 0);
    //         })
    //         ->when($this->request->search, function ($query) {
    //             $query->where('name', 'LIKE', "%{$this->request->search}%");
    //         })
    //         ->orderBy('created_at', 'desc')
    //         ->paginate($this->pageData);
    //     $this->datas = queryAppend($this->request, $this->datas, ['pageData', 'seen', 'unseen', 'search']);
    //     return view('storeManagement.categories.withItem',
    //         [
    //             'datas' => $this->datas,
    //             'pageData' => $this->pageData
    //         ]
    //     );
    // }
}
