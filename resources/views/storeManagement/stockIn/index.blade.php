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

        @media (max-width: 767.98px) {
            .search_div {
                border-bottom: 1px solid #dee2e6;
                border-right: 0px solid #dee2e6;
                margin-bottom:10px;
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
            <div class="text-center overflow-auto">
                <i id="loading_icon" class="fa fa-spinner fa-spin fa-2x"></i>
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
                <h4 class="d-inline ">Slip Number:
                    <span class="text-info">
                        {{ time() }}
                    </span>
                </h4>
                <button class="btn btn-danger btn-xs d-inline float-right" onclick="clearItems()">
                    Clear All
                </button>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <tbody class="stock_list_with_quantity">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- start modal --}}
    <div class="modal fade" id="duplicateItemModal" tabindex="-1" role="dialog" aria-labelledby="duplicateItemModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="duplicateItemModalLabel">Item Already Added</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>The item you are trying to add already Added.</p>
                </div>
                <div class="modal-footer">
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
        let items = localStorage.getItem('items');
        if (!items) { // check it local storage exist or not
            items = '[]'; // Create an empty array as a string
            localStorage.setItem('items', items);
        }
        printItems();
        let loadingIcon = $('#loading_icon');
        let resultDiv = $('.item_search_result');
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
                                        <td >
                                            <a class="btn btn-xs  btn-primary "
                                            onclick="addItem(${item.id},'${item.name}','${item.code}')" >
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

        function addItem(id, name, code) {
            let existingItems = localStorage.getItem('items');
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
            let newItem = {
                id,
                name,
                code,
                price: 0,
                quantity: 0
            };
            items.push(newItem);
            // Save the updated items array in local storage
            localStorage.setItem('items', JSON.stringify(items));
            // Print the data from local storage
            printItems();
        }

        function printItems() {
            let items = localStorage.getItem('items');
            if (items) {
                items = JSON.parse(items);
                let tableRows = '';
                items.forEach(function(item) {
                    let tableRow = `
                <tr class="text-sm">
                    <td>${item.name}</td>
                    <td>${item.code}</td>
                    <td>
                        <input type="number" class="form-control quantity-input" placeholder="Quantity" value="${item.quantity || 1}" min="1" onchange="updateItemQuantity(${item.id}, this.value)">
                    </td>
                    <td>
                        <input type="number" class="form-control price-input" placeholder="Price" value="${item.price || 0}" min="0" onchange="updateItemPrice(${item.id}, this.value)">
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
            }
            if (items.length === 0) {
                $('.stock_list_with_quantity').html("<h1>Nothing added Yeat</h1>");
            }
        }

        function updateItemQuantity(itemId, quantity) {
            let items = localStorage.getItem('items');
            if (items) {
                items = JSON.parse(items);
                let itemIndex = items.findIndex(function(item) {
                    return item.id === itemId;
                });
                if (itemIndex !== -1) {
                    items[itemIndex].quantity = parseInt(quantity);
                    localStorage.setItem('items', JSON.stringify(items));
                }
            }
        }

        function updateItemPrice(itemId, price) {
            let items = localStorage.getItem('items');
            if (items) {
                items = JSON.parse(items);
                let itemIndex = items.findIndex(function(item) {
                    return item.id === itemId;
                });
                if (itemIndex !== -1) {
                    items[itemIndex].price = parseFloat(price);
                    localStorage.setItem('items', JSON.stringify(items));
                }
            }
        }

        function removeItem(button) {
            let row = $(button).closest('tr');
            let itemCode = row.find('td:nth-child(2)').text();
            // Remove the item from the table
            row.remove();
            // Remove the item from local storage
            let items = localStorage.getItem('items');
            if (items) {
                items = JSON.parse(items);
                items = items.filter(function(item) {
                    return item.code !== itemCode;
                });
                localStorage.setItem('items', JSON.stringify(items));
            }
            if (items.length === 0) {
                $('.stock_list_with_quantity').html("<h1>Nothing added Yeat</h1>");
            }
        }

        function clearItems() {
            let items = localStorage.getItem('items');
            items = '[]'; // Create an empty array as a string
            localStorage.setItem('items', items);
            printItems();
        }
    </script>
@endsection
