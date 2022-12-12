@error($input)
    <span class="text-danger"> <strong>{{ $message }}</strong> </span>
@enderror

@if ($input)
    <span class="text-danger error" id="{{ $input }}_error"></span>
@endif
