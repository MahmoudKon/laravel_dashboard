<nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-light bg-gradient-striped-grey-blue navbar-shadow navbar-border">
    <div class="navbar-wrapper">
        <div class="navbar-header border-bottom-1 border-bottom-white">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto">
                    <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                        <i class="ft-menu font-large-1"></i>
                    </a>
                </li>
                <li class="nav-item text-center">
                    <a class="navbar-brand py-2" href="{{ routeHelper('/') }}">
                        <img class="brand-logo" alt="{{ setting('site_name', config('app.name')) }}" src="{{ asset(setting('logo', 'samples/logo/ivas.png')) }}">
                        <h3 class="brand-text white">{{ setting('site_name', config('app.name')) }}</h3>
                    </a>
                </li>

                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile">
                        <i class="la la-ellipsis-v"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link nav-menu-main menu-toggle hidden-xs is-active" style="line-height: 1.5" data-toggle="tooltip" title="@lang('title.toggle-menu')" href="#">
                            <i class="fa-solid fa-bars"></i>
                        </a>
                    </li>

                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link nav-menu-main page-reload hidden-xs" data-toggle="tooltip" title="@lang('title.reload-page')" href="#">
                            <i class="fa fa-rotate-right"></i>
                        </a>
                    </li>

                    {{-- BEGIN SELECT THE LANGUAGES --}}
                    <li class="dropdown dropdown-language nav-item">
                        <a class="dropdown-toggle nav-link" id="dropdown-flag" href="javascript:void(0)" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" title="@lang('title.change-language')">
                            <i class="{{ $active_languages[ LaravelLocalization::getCurrentLocale() ]['icon'] }}"></i>
                            <span class="selected-language"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                            @foreach ($active_languages as $short_name => $active_language_data)
                            <a class="dropdown-item" rel="alternate" hreflang="{{ $short_name }}"
                                href="{{ App::getLocale() !== $short_name ? LaravelLocalization::getLocalizedURL($short_name, null, [], true) : 'javascript:void(0)' }}">
                                <i class="{{ $active_language_data['icon'] }}"></i>
                                {{ $active_language_data['native'] }}
                            </a>
                            @endforeach
                        </div>
                    </li>
                    {{-- END SELECT THE LANGUAGES --}}
                </ul>

                <ul class="nav navbar-nav float-right">
                    {{-- START AUTH LINKS --}}

                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="mr-1">@lang('menu.hello'),
                                <span class="user-name text-bold-700">{{ auth()->user()->name }}</span>
                            </span>
                            <span class="avatar avatar-online">
                                <img src="{{ asset(auth()->user()->image ?? "app-assets/backend/images/portfolio/portfolio-1.jpg") }}" alt="avatar" style="max-height: 36px"><i></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ routeHelper("profile.index") }}" class="dropdown-item btn-outline-info"><i class="ft-info"></i> @lang('menu.profile')</a>

                            <div class="dropdown-divider"></div>

                            <a href="{{ route("lock") }}" id="lock-screan" class="dropdown-item btn-outline-primary"><i class="ft-lock"></i> @lang('buttons.lock')</a>

                            <div class="dropdown-divider"></div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item btn-outline-red cursor-pointer">
                                    <i class="ft-power"></i> @lang('menu.logout')
                                </button>
                            </form>
                        </div>
                    </li>
                    {{-- END AUTH LINKS --}}

                    {{-- START EMAILS --}}
                        @include('layouts.includes.backend.sections.emails')
                    {{-- END EMAILS --}}
                </ul>
            </div>
        </div>
    </div>
</nav>

