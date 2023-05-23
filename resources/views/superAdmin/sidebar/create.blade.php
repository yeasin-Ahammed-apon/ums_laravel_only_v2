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
    @include('parts.title_start', [
        'title' => $title ?? 'Admin Edit Form',
        'color' => 'card-warning',
    ])
<h2>Menu Options Form</h2>

<form id="menu-form">
  <label for="menu-title">Menu Title:</label>
  <input type="text" id="menu-title" name="menu-title" required>
  <br><br>

  <div id="menu-options">
    <div class="menu-option">
      <label for="option-title">Option Title:</label>
      <input type="text" class="option-title" name="option-title[]" required>
      <button type="button" class="add-submenu">Add Submenu</button>
      <button type="button" class="remove-option">Remove Option</button>
      <br><br>
    </div>
  </div>

  <button type="button" id="add-option">Add Option</button>
  <button type="submit">Submit</button>
</form>
    @include('parts.title_end')
@endsection

@section('scripts')
<script>
    $(document).on('click', '.add-submenu', function() {
      var $menuOption = $(this).closest('.menu-option');
      $menuOption.append(`
        <div class="submenu-option">
          <label for="submenu-title">Submenu Title:</label>
          <input type="text" class="submenu-title" name="submenu-title[]" required>
          <label for="submenu-route">Submenu Route:</label>
          <input type="text" class="submenu-route" name="submenu-route[]" required>
          <button type="button" class="remove-submenu">Remove Submenu</button>
          <br><br>
        </div>
      `);
    });

    $(document).on('click', '.remove-option', function() {
      $(this).closest('.menu-option').remove();
    });

    $(document).on('click', '.remove-submenu', function() {
      $(this).closest('.submenu-option').remove();
    });

    $('#add-option').click(function() {
      $('#menu-options').append(`
        <div class="menu-option">
          <label for="option-title">Option Title:</label>
          <input type="text" class="option-title" name="option-title[]" required>
          <button type="button" class="add-submenu">Add Submenu</button>
          <button type="button" class="remove-option">Remove Option</button>
          <br><br>
        </div>
      `);
    });

    $('#menu-form').submit(function(event) {
      event.preventDefault();
      var menuTitle = $('#menu-title').val();
      var options = [];
      $('.menu-option').each(function() {
        var optionTitle = $(this).find('.option-title').val();
        var submenus = [];
        $(this).find('.submenu-option').each(function() {
          var submenuTitle = $(this).find('.submenu-title').val();
          var submenuRoute = $(this).find('.submenu-route').val();
          submenus.push({
            title: submenuTitle,
            route: submenuRoute
          });
        });
        options.push({
          title: optionTitle,
          sub_menu: submenus
        });
      });
      var data = {
        title: menuTitle,
        options: options
      };
      console.log(data);
      // Send data to server here
    });
  </script>
@endsection
