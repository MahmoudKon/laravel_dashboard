<div>
    @error($input)
        <span class="alert text-danger" role="alert"> <strong>{{ $message }}</strong> </span>
    @enderror

    @if ($input)
        <span class="alert text-danger error" id="{{ $input }}_error"></span>
    @endif
</div>
