<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow menu-dark">
    <div class="main-menu-content">
        <ul class="navigation navigation-main mb-5 pb-5" id="main-menu-navigation">

            @if (config('telescope.path'))
                <li class="nav-item">
                    <a href="{{ url(config('telescope.path')) }}">
                        <i class="fa fa-camera"></i> <span class="menu-title">Telescope</span>
                    </a>
                </li>
            @endif

            @foreach ($list_menus as $row)
                @include('layouts.includes.backend.sections.list-menu', ['menu' => $row])
            @endforeach

        </ul>
    </div>
</div>
