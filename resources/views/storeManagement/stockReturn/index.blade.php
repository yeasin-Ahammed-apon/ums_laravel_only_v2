@extends('layout')
@section('meta-tag')
    Item Stock In
@endsection
@section('breadcrumb')
    @include('parts.breadcrumb')
@endsection
@section('css')
    <style>
        .search_div {
            border-right: 1px solid #dee2e6;
        }

        .quantity-input,
        .price-input {
            padding-top: 0px;
            padding-bottom: 0px;
            height: auto;
            width: auto
        }

        @media (max-width: 767.98px) {
            .search_div {
                border-bottom: 1px solid #dee2e6;
                border-right: 0px solid #dee2e6;
                margin-bottom: 10px;
            }
        }
    </style>
@endsection
@section('content')
    @include('parts.title_start', [
        'title' => $title ?? 'Item Stock In',
        'color' => 'card-info',
    ])
    <div class="row" style="height: 100vh">
        {{-- Item search --}}
        <div class="col-12 col-sm-4 search_div">
            <div class="input-group">
                <input type="search" id="item_search" class="form-control" placeholder="Search Item">
                <div class="input-group-append">
                    <button id="search_button" onclick="search()" class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="text-center ">
                <div class="spinner-border mt-5 text-primary" id="loading_icon" style="width: 3rem; height: 3rem;"
                    role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                {{-- <i id="loading_icon" class="fa fa-spinner fa-spin fa-5x pt-5"></i> --}}
            </div>
            <div class="table-responsive">
                <table class="table">
                    <tbody class="item_search_result">

                    </tbody>
                </table>
            </div>


        </div>
        {{--  add item list --}}
        <div class="col-12 col-sm-8">
            <div>
                <h4 class=" ">Slip Number:
                    <span class="text-info">
                        {{ $slipNumber }}
                    </span>
                </h4>
                <h6>Stock Return by:
                    <span class="text-info">{{ $user->name }}</span>
                    <span class="text-success">[role : {{ $user->role->name }}]</span>
                    <span class="text-success">[id : {{ $user->login_id }}]</span>

                </h6>
                <div>
                </div>
                <button class="btn btn-danger btn-xs d-inline float-right" onclick="clearItems()">
                    Clear All
                </button>

            </div>
            <div class="table-responsive">
                <table class="table">
                    <tbody class="stock_list_with_quantity">
                    </tbody>
                </table>
                <button type="button" class="btn btn-primary btn-sm btn-block stockAddButton"
                    onclick="disableButton(this);stockOut()">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Add
                </button>
            </div>
        </div>
    </div>
    {{-- start modal --}}
    <div class="modal fade" id="duplicateItemModal" tabindex="-1" role="dialog" aria-labelledby="duplicateItemModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="duplicateItemModalLabel">Item Already Added</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>The item you are trying to add already Added.</p>
                </div>
                <div class="modal-footer bg-danger">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- end modal --}}

    @include('parts.title_end')
@endsection

@section('scripts')
    <script>
        let slipNumber = {{ $slipNumber }}
        let userId = {{ $user->id }}
        let stockAddButton = $('.stockAddButton')
        let items = localStorage.getItem('stockReturnItems');
        let loadingIcon = $('#loading_icon');
        let resultDiv = $('.item_search_result');
        if (!items) { // check it local storage exist or not
            items = '[]'; // Create an empty array as a string
            localStorage.setItem('stockReturnItems', items);
        }
        printItems();
        loadingIcon.hide();

        function search() {
            let searchValue = $('#item_search').val();
            if (searchValue.length > 0) {
                resultDiv.empty();
                loadingIcon.show(); // Show the loading icon
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                $.ajax({
                    url: '{{ route('item_search') }}',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        search: searchValue
                    },
                    success: function(datas) {
                        if (datas.length === 0) {
                            loadingIcon.hide();
                            resultDiv.append("<h1>Sorry No Data Found</h1>");
                        } else {
                            loadingIcon.hide(); // Hide the loading icon
                            resultDiv.empty(); // Clear previous results
                            let resultItem = "";
                            datas.forEach(item => {
                                resultItem += `
                                    <tr class="text-sm">
                                        <td>${item.name}</td>
                                        <td>${item.code}</td>
                                        <td>${item.quantity}</td>
                                        <td >
                                            <a class="btn btn-xs  btn-primary "
                                            onclick="addItem(${item.id},'${item.name}','${item.code}','${item.quantity}')" >
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                `;
                            });
                            resultDiv.append(resultItem);
                        }
                    },
                    error: function(error) {
                        loadingIcon.hide(); // Hide the loading icon
                        console.log(error);
                    }
                });
            }
        }
        function addItem(id, name, code, current_quantity) {
                current_quantity = parseInt(current_quantity)
                let existingItems = localStorage.getItem('stockReturnItems');
                let items = existingItems ? JSON.parse(existingItems) : [];
                // Check if the ID already exists
                let existingItem = items.find(function(item) {
                    return item.id === id;
                });
                if (existingItem) {
                    $('#duplicateItemModal').modal('show');
                    return;
                }
                // Add the item to the array
                let price = 0;
                let quantity = 1;
                let newItem = {
                    id,
                    name,
                    code,
                    quantity,
                    current_quantity
                };
                items.push(newItem);
                // Save the updated items array in local storage
                localStorage.setItem('stockReturnItems', JSON.stringify(items));
                // Print the data from local storage
                printItems();

        }

        function printItems() {
            let items = localStorage.getItem('stockReturnItems');
            if (items) {
                items = JSON.parse(items);
                let tableRows = `
                <tr class="text-sm bg-info">
                    <td>Name</td>
                    <td>Code</td>
                    <td>Current Quantity</td>
                    <td>Quantity</td>
                    <td>
                        Action
                    </td>
                </tr>`;
                items.forEach(function(item) {
                    let tableRow = `
                            <tr class="text-sm">
                                <td>${item.name}</td>
                                <td>${item.code}</td>
                                <td>${item.current_quantity}</td>
                                <td>
                                    <input type="number" class="form-control quantity-input" placeholder="Quantity" value="${item.quantity}" min="1" onchange="updateItemQuantity(${item.id}, this.value)">
                                </td>
                                <td>
                                    <a class="btn btn-xs btn-danger" onclick="removeItem(this)">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        `;
                    tableRows += tableRow;
                });
                $('.stock_list_with_quantity').html(tableRows);
                stockAddButton.show();
            }
            lenghtCheck(items)
        }

        function updateItemQuantity(itemId, quantity) {
            let items = localStorage.getItem('stockReturnItems');
            if (items) {
                items = JSON.parse(items);
                let itemIndex = items.findIndex(function(item) {
                    return item.id === itemId;
                });
                if (itemIndex !== -1) {
                    items[itemIndex].quantity = parseInt(quantity);
                    localStorage.setItem('stockReturnItems', JSON.stringify(items));
                }
            }
        }

        function removeItem(button) {
            let row = $(button).closest('tr');
            let itemCode = row.find('td:nth-child(2)').text();
            // Remove the item from the table
            row.remove();
            // Remove the item from local storage
            let items = localStorage.getItem('stockReturnItems');
            if (items) {
                items = JSON.parse(items);
                items = items.filter(function(item) {
                    return item.code !== itemCode;
                });
                localStorage.setItem('stockReturnItems', JSON.stringify(items));
            }
            lenghtCheck(items)
        }

        function clearItems() {
            let items = localStorage.getItem('stockReturnItems');
            items = '[]'; // Create an empty array as a string
            localStorage.setItem('stockReturnItems', items);
            printItems();
        }

        function lenghtCheck(items) {
            if (items.length === 0) {
                $('.stock_list_with_quantity').html("<h1>Nothing added Yeat</h1>");
                stockAddButton.hide();
            }
        }

        function stockOut() {
            let datas = JSON.stringify(localStorage.getItem('stockReturnItems'));
            console.log(datas);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            $.ajax({
                url: "{{ route(Auth::user()->role->name . '.inventory.item.stock_return_store') }}",
                type: 'POST',
                data: {
                    datas,
                    slipNumber,
                    userId
                },
                success: function(data) {
                    if (data.status === 200) {
                        let item_saved = JSON.parse(data.item_saved);
                        let item_not_found = JSON.parse(data.item_not_found);
                        let item_not_updated = JSON.parse(data.item_not_updated);
                        let item_not_save_in_history = JSON.parse(data.item_not_save_in_history);
                        // item_saved =  item_saved.map(e => e.name).join('\n');
                        Swal.fire({
                            title: 'Success',
                            html: `
                                <h5>item_saved</h5>
                                -------------------------------------<br>
                                ${item_saved}<br>
                                <h5>item_not_found</h5>
                                -------------------------------------<br>
                                ${item_not_found}<br>

                                <h5>item_not_updated</h5>
                                -------------------------------------<br>
                                ${item_not_updated}<br>
                                <h5>item_not_save_in_history</h5>
                                -------------------------------------<br>
                                ${item_not_save_in_history}<br>
                            `,
                            icon: 'success',
                        }).then(function() {
                            clearItems();
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Fail',
                            text: `${data.massage}`,
                            icon: 'erorr',
                        })
                    }

                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });

        }
    </script>
@endsection
