@foreach ($key as $key => $val)
    @if ( is_array($val) )
        @include('backend.languages.includes.list-trans', ['key' => $val])
    @else
        @include('backend.languages.includes.trans-input', ['key' => $key, 'val' => $val])
    @endif
@endforeach
