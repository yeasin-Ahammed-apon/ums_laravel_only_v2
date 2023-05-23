<style>
    .bottombar {
        display: none;
        /* Hide the bottombar by default */
        position: sticky;
        bottom: 0;
        width: 100%;
        background-color: #3813be;
    }

    .bottombar-menu {
        display: flex;
        justify-content: space-around;
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .bottombar-menu li {
        flex: 1;
        text-align: center;
        padding: 8px 0;
    }

    .bottombar-menu li a {
        text-decoration: none;
        color: #ffffff;
        font-weight: bold;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .bottombar-menu li a .icon {
        font-size: 15px;
        margin-bottom: 5px;
    }

    .bottombar-menu li a:hover {
        color: #3fc0fc;
        /* Change the color to the desired hover effect */
    }

    .bottomBarOptionActive {
        color: #10043b;
        background: #10043b;
        border-bottom: 10px solid rgb(6, 238, 255);
    }

    @media (max-width: 700px) {
        .bottombar {
            display: block;
            /* Show the bottombar */
        }
    }
</style>

@php
    $options = footerOption(Auth::user()->role->name);
@endphp

<div class="bottombar">
    <ul class="bottombar-menu">
        @foreach ($options as $option)
            <li class="{{ Route::is($option['route']) ? 'bottomBarOptionActive shadow' : '' }}">
                <a href="{{ Route::has($option['route']) ? route($option['route']) : '#' }}">
                    <span class="icon">
                        <i class="{{ $option['icon'] }}"></i>
                    </span>
                    <span>{{ $option['label'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>
