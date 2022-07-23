{{-- START DASHBOARD LINK --}}
@if (!$menu->route || canUser( str_replace('.', '-', $menu->route) ))
<li class="nav-item {{ $menu->visibleSubs->Count() ? "has-sub" : "" }} {{ activeMenu($menu->route, $menu->func()) }}" data-route="{{ ROUTE_PREFIX.$menu->route }}">
    <a href="{{ $menu->route ? routeHelper($menu->route) : "#"  }}">
        <i class="{{ $menu->icon }}"></i> <span class="menu-title">{{ $menu->name }}</span>
    </a>

    @if ($menu->visibleSubs->Count())
    <ul class="menu-content">
        @foreach ($menu->visibleSubs as $sub)
            @include('layouts.includes.backend.sections.list-menu', ['menu' => $sub])
        @endforeach
    </ul>
    @endif
</li>
@endif
{{-- START DASHBOARD LINK --}}
