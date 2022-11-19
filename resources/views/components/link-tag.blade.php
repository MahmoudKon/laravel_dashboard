@if ($visible)
    <a href="{{ $route }}" {{ $attributes->merge(['class' => "btn btn-sm $classess"]) }} data-toggle="tooltip" title="{{ $title }}">
        <i class="{{ $icon }}"></i> {{ $text }}
    </a>
@endif
