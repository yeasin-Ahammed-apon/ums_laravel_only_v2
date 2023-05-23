@extends('layout')
{{-- @section('breadcrumb')
    @include('parts.breadcrumb', [
        'page_title' => 'Admin list Page',
        'links' => [
            [
                'title' => 'dashboard',
                'route' => 'superAdmin.admin.dashboard',
                'enable' => true,
            ],
            [
                'title' => 'Admin List',
                'route' => 'superAdmin.admin.index',
                'enable' => false,
            ],
        ],
    ])
@endsection --}}
@section('meta-tag')
    Edit Admin || {{ auth()->user()->role->name }}
@endsection


@section('content')
    {{-- nav bar --}}
    @include('parts.title_start', [
        'title' => 'User Navbar Settings',
        'color' => 'card-warning',
    ])
    <h1>Navbar settings goes here</h1>
    @include('parts.title_end')
    {{-- sidebar --}}
    @include('parts.title_start', [
        'title' => 'User sidebar Settings',
        'color' => 'card-warning',
    ])
    <form method="POST" action="{{ route('superAdmin.page.settings.update', ['setting' => 'sidebar']) }}">
        @csrf
        @foreach ($sidebar as $menu)
            <div class="shadow  rounded p-2 mt-2 mb-1" style=" border-left:10px solid rgba(11, 30, 201, 0.479)
            ">
                @if (isset($menu['enabled']))
                <input type="checkbox" style="width: 20px; height: 20px;" name="menu[{{ $loop->index }}][enabled]" value="{{ $menu['enabled'] }}" onclick="toggleCheckboxValue(this)"
                    @if ($menu['enabled']==='1') checked @endif>
                @else
                <input type="checkbox" style="width: 20px; height: 20px;" name="menu[{{ $loop->index }}][enabled]" value="0" onclick="toggleCheckboxValue(this)">
                @endif
                <h3 class="d-inline">{{ $menu['title'] }}</h3>
                <input type="hidden" name="user_id" value="{{ $id }}">
                <div >
                    <div class="form-group ">
                        <input type="hidden" name="menu[{{ $loop->index }}][title]" value="{{ $menu['title'] }}">
                        @if (isset($menu['icon']))
                            <input type="hidden" class="form-control" id="menu[{{ $loop->index }}][icon]"
                                name="menu[{{ $loop->index }}][icon]" value="{{ $menu['icon'] }}">
                        @endif
                        @if (isset($menu['route']))
                            <input type="hidden" class="form-control" id="menu[{{ $loop->index }}][route]"
                                name="menu[{{ $loop->index }}][route]" value="{{ $menu['route'] }}">
                        @endif
                    </div>
                    @if (isset($menu['sub_menu']))
                    <h5  class="border-bottom  text-black-50">Sub Menus</h5>
                    <div class="row">
                                @foreach ($menu['sub_menu'] as $sub_menu)
                                <div class="col-12 col-sm-3">
                                    <div class="form-group  border border-info m-2 p-1" >
                                        @if (isset($sub_menu['enabled']))
                                        <input type="checkbox" class="d-inline"
                                            name="menu[{{ $loop->parent->index }}][sub_menu][{{ $loop->index }}][enabled]"
                                            value="{{ $sub_menu['enabled'] }}" onclick="toggleCheckboxValue(this)"
                                            @if ($sub_menu['enabled']==='1') checked @endif>
                                        @else
                                        <input type="checkbox" class="d-inline"
                                            name="menu[{{ $loop->parent->index }}][sub_menu][{{ $loop->index }}][enabled]"
                                            value="0" onclick="toggleCheckboxValue(this)">
                                        @endif
                                        <h6 class="d-inline">{{ $sub_menu['title'] }}</h6>
                                        <input type="hidden" class="form-control d-inline"
                                            id="menu[{{ $loop->parent->index }}][sub_menu][{{ $loop->index }}][title]"
                                            name="menu[{{ $loop->parent->index }}][sub_menu][{{ $loop->index }}][title]"
                                            value="{{ $sub_menu['title'] }}">
                                        <input type="hidden" class="form-control"
                                            id="menu[{{ $loop->parent->index }}][sub_menu][{{ $loop->index }}][route]"
                                            name="menu[{{ $loop->parent->index }}][sub_menu][{{ $loop->index }}][route]"
                                            value="{{ $sub_menu['route'] }}">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                    @endif

                </div>
            </div>
        @endforeach
        <button type="submit" class="btn btn-sm mt-1 mb-1 btn-primary" onclick="disableButton(this)">Update SideBar</button>
    </form>


    @include('parts.title_end')
@endsection
@section("scripts")
<script>
    function toggleCheckboxValue(checkbox) {
    // checkbox.checked = !checkbox.checked;
    checkbox.value = checkbox.checked ? "1" : "0";
  }
</script>
@endsection
