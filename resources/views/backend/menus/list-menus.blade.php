<li class="list-group-item cursor-move mb-1" data-id="{{ $menu->id }}">
    <span style="color: {{ $menu->color }} !important">
        <span class="order">{{ $menu->order }}</span> -
        <i class="{{ $menu->icon }}"></i> {{ $menu->getName() }}
    </span>

    @include('backend.menus.actions')

    <ul class="mt-1 nested-sortable" style="margin-right: 40px; min-height: 20px" data-parent-id="{{ $menu->id }}">
        @if ($menu->subs->count())
            @foreach ($menu->subs as $sub)
                @include('backend.menus.list-menus', ['menu' => $sub])
            @endforeach
        @endif
    </ul>
</li>
