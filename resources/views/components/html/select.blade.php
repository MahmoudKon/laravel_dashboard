<div class="form-group">
    <label class="{{ $required }}">{{ $label }}</label>
    <select {{ $attributes->merge(['class' => "select2 form-control"]) }} {{ $required }} name="{{ $name }}" data-placeholder="--- {{ $label }} ---">
        <option></option>
        @foreach ($list as $key => $value)
            <option value="{{ $key }}" @selected( $selected && in_array($key, $selected) )>{{ $value }}</option>
        @endforeach
    </select>
    <x-validation-error :input="$name" />
</div>
