@if ($url)
    <a href="{{ asset($url) }}" class="input-group-text btn btn-primary" target="_blank" data-toggle="tooltip" title='@lang('buttons.display-file')'> <i class="fas fa-arrows-alt"></i> </a>
    <a href="{{ asset($url) }}" download="{{ last( explode('/', $url) ) }}" class="input-group-text btn btn-success" target="_blank" data-toggle="tooltip" title='@lang('buttons.download')'> <i class="fas fa-download"></i> </a>
@elseif (isset($not_found))
    <button class="btn btn-sm btn-danger" target="_blank" data-toggle="tooltip" title="" data-bs-original-title="{{ $not_found }}">
        <i class="fas fa-ban"></i> {{ $not_found }}
    </button>
@endif
