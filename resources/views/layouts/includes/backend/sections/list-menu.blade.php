{{-- START DASHBOARD LINK --}}
@if (!$menu->route || canUser( str_replace('.', '-', $menu->route) ))
<li class="nav-item {{ $menu->visibleSubs->Count() ? "has-sub" : "" }} {{ activeMenu($menu->route) }}" data-route="{{ getRoutePrefex('.').$menu->route }}">
    <a href="{{ $menu->route && Route::has(getRoutePrefex('.').$menu->route) ? routeHelper($menu->route) : "#"  }}" style="color: {{ $menu->color }} !important">
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
