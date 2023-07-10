<?php

namespace App\Http\Controllers\libraryManagement;

use App\Http\Controllers\Controller;
use App\Models\LibraryBook;
use App\Models\LibraryBookCopy;
use App\Models\LibraryBookIssue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryBookIssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $data;
    protected $datas;
    protected $request;
    public function list(Request $request){
        $this->request = $request;
        $this->pageData = pageDataCheck($this->request);
        $this->datas = LibraryBookIssue::query()
            ->when($this->request->status === '1', function ($query) {
                $query->where('status', 1);
            })
            ->when($this->request->status === '0', function ($query) {
                $query->where('status', 0);
            })
            // ->when($this->request->search, function ($query) {
            //     $query->where('name', 'LIKE', "%{$this->request->search}%");
            // })
            ->orderBy('created_at', 'desc')
            ->paginate($this->pageData);

        $this->datas = queryAppend($this->request, $this->datas, ['pageData', 'seen', 'unseen', 'search']);
        return view("libraryManagement.issue.list",
            [
                'datas' => $this->datas,
                'pageData' => $this->pageData,
                'title'=>"library categories"
            ]
        );
    }
    public function status($id)
    {
        $this->data = LibraryBookIssue::findOrFail($id);
        $this->data->status = !$this->data->status;
        $this->data->save();
        fmassage('Success', 'issue Status updated successfully', 'success');
        return redirect()->back();
    }
    public function issue(Request $request){
        return view('libraryManagement.issue.issue');
    }
    public function user_search(Request $request){
        $this->datas = User::where('name', 'LIKE', "%{$request->user_id}%")
                            ->orWhere('login_id', 'LIKE', "%{$request->user_id}%")
                            ->where('status', 1)
                            ->take(10)
                            ->get();
        return response()->json($this->datas);
    }
    public function book_search(Request $request){
        $this->datas = LibraryBook::where('name', 'LIKE', "%{$request->book_id}%")
                            ->orWhere('author', 'LIKE', "%{$request->book_id}%")
                            ->orWhere('code', 'LIKE', "%{$request->book_id}%")
                            ->where('status', 1)
                            ->take(10)
                            ->get();
        return response()->json($this->datas);
    }
    public function book_copy(Request $request){
        $this->datas = LibraryBookCopy::where('library_book_id', intval($request->book_id))
                            ->where('status', 1)
                            ->get();
                            // dd($this->datas);
        return response()->json($this->datas);
    }
    public function book_add(Request $request){
        $validatedData = $request->validate([
            'user' => 'required',
            'book' => 'required',
            'book_copy' => 'required',
            "issue_date" =>'required',
            "expected_return_date" =>'required',
        ]);
          $this->data = new LibraryBookIssue();
          $this->data->user_id = Auth::user()->id;
          $this->data->taken_by_id = $request->user;
          $this->data->library_book_id = $request->book;
          $this->data->library_book_copy_id = $request->book_copy;
          $this->data->issue_date = $request->issue_date;
          $this->data->issue_in_what_condition = $request->issue_in_what_condition ?? "";
          $this->data->expected_return_date = $request->expected_return_date;
          $this->data->save();
          if ($this->data) {

                $book = LibraryBook::find($this->data->library_book_id);
                $book->stock_in = $book->stock_in-1;
                $book->stock_out = $book->stock_out+1;
                $book->save();
                fmassage('Success', 'issue is created', 'success');
                return redirect()->back();
            }
        fmassage('Fail', 'issue is not created', 'error');
        return redirect()->back();


    }
    public function book_edit(LibraryBookIssue $issue){

        return view("libraryManagement.issue.edit",['data'=>$issue]);
    }
    public function book_store(LibraryBookIssue $issue,Request $request){

        $validatedData = $request->validate([
            'return_date' => 'required',
        ]);

        $data = $issue;
        $data->return_date = $request->return_date;
        $data->fine  = $request->fine ?? $data->fine;
        $data->return_in_what_condition  = $request->return_in_what_condition ?? $data->return_in_what_condition;
        $data->status  = !$data->status;
        $data->save();
        if ($data) {
            $book = LibraryBook::find($data->library_book_id);
            $book->stock_in = $book->stock_in+1;
            $book->stock_out = $book->stock_out-1;
            $book->save();
            fmassage('Success', 'issue is Closed', 'success');
            return redirect()->back();
        }
        fmassage('Success', 'issue not closed', 'success');
        return redirect()->back();




    }


}
