<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow menu-dark">
    <div class="main-menu-content ps-container ps-theme-dark ps-active-y">
        <ul class="navigation navigation-main mb-5 pb-5" id="main-menu-navigation">

            @foreach ($list_menus as $row)
                @include('layouts.includes.backend.sections.list-menu', ['menu' => $row])
            @endforeach

            <li class="nav-item">
                <a href="{{ route('messenger')  }}">
                    <i class="fa fa-comments"></i> <span class="menu-title">Messenger</span>
                </a>
            </li>

        </ul>
    </div>
</div>
