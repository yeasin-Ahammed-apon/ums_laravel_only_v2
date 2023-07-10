@extends('layout')
@section('meta-tag')
    Edit Admin
@endsection
@section('css')
<style>
.issueInfo{
    /* border: 1px solid red; */
    padding-top: 15px;
    padding-bottom: 15px;
    padding-left:5px;
    padding-right: 5px;
    margin-top:10px;
    margin-bottom:20px;
}
</style>
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Admin Edit Form',
        'color' => 'card-info',
    ])
    <div>
        <form action="{{ route(Auth::user()->role->name . '.library.issue.add') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="row issueInfo shadow-lg">
                {{-- taken_by --}}
                <input type="hidden" name="user" id="id">
                {{-- book_id --}}
                <input type="hidden" name="book" id="book_id">
                {{-- book_copy_id --}}
                <input type="hidden" name="book_copy" id="book_copy_id">

                <div class="col-12 col-sm-4 mb-2 ">
                    <b class="border-bottom border-info">User </b> <br>
                    {!! validationError('user', $errors) !!}
                    <span id="user_info">
                        <hr><hr><hr>
                    </span>
                </div>
                <div class="col-12 col-sm-4 mb-2">
                    <b class="border-bottom border-info">Book</b><br>
                    {!! validationError('book', $errors) !!}
                    <span id="book_info">
                        <hr><hr><hr>
                    </span>
                </div>
                <div class="col-12 col-sm-4 mb-2">
                    <b class="border-bottom border-info">Book Copy</b><br>
                    {!! validationError('book_copy', $errors) !!}
                    <span id="book_copy_info">
                        <hr><hr><hr>
                    </span>
                </div>
                {{-- issue_date --}}
                <div class="form-group col-12 col-sm-4">
                    <label class="border-bottom border-info">Issue Date</label>
                    <input type="date" value="{{ old('issue_date') }}" name="issue_date"
                        class="form-control @error('issue_date') is-invalid @enderror" placeholder="Enter issue_date">
                    {!! validationError('issue_date', $errors) !!}
                </div>
                {{-- issue_in_what_condition --}}
                <div class="form-group col-12 col-sm-4">
                    <label class="border-bottom border-info">issue_in_what_condition</label>
                    <input type="text" value="{{ old('issue_in_what_condition') }}" name="issue_in_what_condition"
                        class="form-control @error('issue_in_what_condition') is-invalid @enderror" placeholder="Enter issue_in_what_condition">
                    {!! validationError('issue_in_what_condition', $errors) !!}
                </div>
                {{-- expected_return_date --}}
                <div class="form-group col-12 col-sm-4">
                    <label class="border-bottom border-info">expected_return_date </label>
                    <input type="date" value="{{ old('expected_return_date') }}" name="expected_return_date"
                        class="form-control @error('expected_return_date') is-invalid @enderror" placeholder="Enter expected_return_date">
                    {!! validationError('expected_return_date', $errors) !!}
                </div>
                <div class="float-right">
                    <button type="submit" class="btn btn-sm mt-1 mb-1  btn-primary "
                    onclick="disableButton(this)">
                        Create
                    </button>
                </div>

            </div>

        </form>
        <div class="row">
            <div class="col-12 col-sm-4" id="user_search">
                <div class="form-group">
                    <label class="border-bottom border-danger">User</label>
                    <input type="text" class="form-control" name="user" id="user" aria-describedby="helpId"
                        placeholder="" onkeydown="getUser(event)">
                </div>
                <div class="text-center ">
                    <div class="spinner-border mt-5 text-primary" id="user_loading_icon" style="width: 3rem; height: 3rem;"
                        role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    {{-- <i id="loading_icon" class="fa fa-spinner fa-spin fa-5x pt-5"></i> --}}
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <tbody class="user_search_result">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label class="border-bottom border-danger">Book</label>
                    <input type="text" class="form-control" name="book" id="book" aria-describedby="helpId"
                        placeholder="" onkeydown="getBook(event)">
                </div>
                <div class="text-center ">
                    <div class="spinner-border mt-5 text-primary" id="book_loading_icon" style="width: 3rem; height: 3rem;"
                        role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    {{-- <i id="loading_icon" class="fa fa-spinner fa-spin fa-5x pt-5"></i> --}}
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <tbody class="book_search_result">

                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="form-group">
                    <label class="border-bottom border-danger " for="">Book Copy</label>
                </div>
                <div class="text-center ">
                    <div class="spinner-border mt-5 text-primary" id="book_copy_loading_icon"
                        style="width: 3rem; height: 3rem;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    {{-- <i id="loading_icon" class="fa fa-spinner fa-spin fa-5x pt-5"></i> --}}
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <tbody class="book_copy_search_result">

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    @include('parts.title_end')
@endsection
@section('scripts')
    <script>
        // for user
        let userLoadingIcon = $('#user_loading_icon');
        let userResultDiv = $('.user_search_result');
        userLoadingIcon.hide();
        // for book
        let bookLoadingIcon = $('#book_loading_icon');
        let bookResultDiv = $('.book_search_result');
        bookLoadingIcon.hide();
        // for book copy
        let bookCopyLoadingIcon = $('#book_copy_loading_icon');
        let bookCopyResultDiv = $('.book_copy_search_result');
        bookCopyLoadingIcon.hide();
        // for book and book_copy info storing
        let book_info_id =0;
        let book_info_name ='';
        let book_info_author ='';
        let book_info_code ='';
        let book_info_copy_id =0;
        let book_info_copy_code ='';

        function getUser(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                const userSearchInput = $('#user');
                const user_id = userSearchInput.val();
                userLoadingIcon.show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                $.ajax({
                    url: "{{ route(Auth::user()->role->name.'.library.user_search') }}",
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        user_id
                    },
                    success: function(datas) {

                        userLoadingIcon.hide(); // Hide the loading icon
                        userResultDiv.empty(); // Clear previous results
                        let resultItem = "";
                        datas.forEach(item => {
                            resultItem += `
                                    <tr class="text-sm">
                                        <td>${item.name}</td>
                                        <td>${item.login_id}</td>
                                        <td >
                                            <a class="btn btn-xs  btn-primary "
                                            onclick="addUser(${item.id},'${item.name}','${item.login_id}')" >
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                `;
                        });
                        userResultDiv.append(resultItem);

                    },
                    error: function(error) {
                        userLoadingIcon.hide(); // Hide the loading icon
                        console.log(error);
                    }
                });

            }
        }
        function getBook(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                const bookSearchInput = $('#book');
                const book_id = bookSearchInput.val();
                bookLoadingIcon.show();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                $.ajax({
                    url: "{{ route('superAdmin.library.book_search') }}",
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        book_id
                    },
                    success: function(datas) {

                        bookLoadingIcon.hide(); // Hide the loading icon
                        bookResultDiv.empty(); // Clear previous results
                        let resultItem = "";
                        datas.forEach(item => {
                            resultItem += `
                                    <tr class="text-sm">
                                        <td>${item.name}</td>
                                        <td>${item.author}</td>
                                        <td>${item.code}</td>
                                        <td >
                                            <a class="btn btn-xs  btn-info "
                                            onclick="bookInfo(${item.id},'${item.name}','${item.author}','${item.code}')" >
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                `;
                        });
                        bookResultDiv.append(resultItem);

                    },
                    error: function(error) {
                        bookLoadingIcon.hide(); // Hide the loading icon
                        console.log(error);
                    }
                });

            }
        }
        function bookInfo(id,name,author,code) {

            book_info_id =parseInt(id);
            book_info_name =name;
            book_info_author =author;
            book_info_code =code;
            bookCopyLoadingIcon.show();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            $.ajax({
                url: "{{ route('superAdmin.library.book_copy') }}",
                method: 'GET',
                dataType: 'json',
                data: {
                    book_id:book_info_id
                },
                success: function(datas) {
                    bookCopyLoadingIcon.hide(); // Hide the loading icon
                    bookCopyResultDiv.empty(); // Clear previous results
                    let resultItem = "";
                    // checn datas lenght
                    if (datas.length === 0) {
                        resultItem = "no data found";
                    } else {
                        resultItem = `
                                    <tr class="text-sm bg-info">
                                        <td>Code</td>
                                        <td>Action</td>
                                    </tr>`
                        datas.forEach(item => {
                            resultItem += `
                                    <tr class="text-sm">
                                        <td>${item.code}</td>
                                        <td >
                                            <a class="btn btn-xs  btn-primary "
                                            onclick="addBook(${item.id},'${item.code}')" >
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                `;
                        });
                    }
                    bookCopyResultDiv.append(resultItem);

                },
                error: function(error) {
                    bookCopyLoadingIcon.hide(); // Hide the loading icon
                    console.log(error);
                }
            });

        }
        function addUser(id,name,login_id) {
            var hiddenInput = document.getElementById("id");
            hiddenInput.value = id;
            userResultDiv.empty();
            userResultDiv.append(`
                        <h1 class="text-center">
                            <i class="fas fa-check fa-2x text-success"></i>
                        </h1>
                    `);
            document.getElementById("user").disabled = true;
            document.getElementById("user").value = name;
            document.querySelector('#user_info').innerHTML = `${name} <br> [Id:${login_id}]`;

        }
        function addBook(copy_id, copy_code){
            book_info_copy_id =copy_id;
            book_info_copy_code =copy_code;

            var hiddenBookInput = document.getElementById("book_id");
                hiddenBookInput.value = book_info_id;
            var hiddenBookCopyInput = document.getElementById("book_copy_id");
                hiddenBookCopyInput.value = book_info_copy_id;
            bookResultDiv.empty();
            bookResultDiv.append(`
                        <h1 class="text-center">
                            <i class="fas fa-check fa-2x text-success"></i>
                        </h1>
                    `);
            bookCopyResultDiv.empty();
            bookCopyResultDiv.append(`
                        <br>
                        <h1 class="text-center">
                            <i class="fas fa-check fa-2x text-success"></i>
                        </h1>
                    `);
            document.getElementById("book").disabled = true;
            document.getElementById("book").value = book_info_name;

            document.querySelector('#book_info').innerHTML = `${book_info_name} <br>
                                                                 [author : ${book_info_author}] <br>
                                                                 [code : ${book_info_code}]`;
            document.querySelector('#book_copy_info').textContent = `[code : ${book_info_code}]`;


        }

    </script>
@endsection
