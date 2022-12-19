<div class='row'>
    <div class="col-md-8">
        {{-- START display_name --}}
        <div class="form-group">
            <label class="required">@lang('inputs.display_name')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fas fa-heading"></i> </span>
                </div>
                <input type="text" class="form-control" name="display_name" required
                    value="{{ $row->display_name ?? old('display_name') }}" placeholder="@lang('inputs.display_name')">
            </div>
            <x-validation-error input='display_name' />
        </div>
        {{-- END display_name --}}
    </div>

    <div class="col-md-4">
        {{-- START COLOR --}}
        <div class="form-group">
            <label>@lang('inputs.color')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa-solid fa-brush"></i> </span>
                </div>
                <input type="color" class="form-control" name="color" value="{{ $row->color ?? old('color', '#6B6F82') }}"  placeholder="fa fa-user">
            </div>
            <x-validation-error input='color' />
        </div>
        {{-- END COLOR --}}
    </div>
</div>

<div class='row'>
    <div class="col-md-8">
        {{-- START name --}}
        <div class="form-group">
            <label class="required">@lang('inputs.name')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fas fa-pencil"></i> </span>
                </div>
                <input type="text" class="form-control" name="name" required value="{{ $row->name ?? old('name') }}"
                    placeholder="@lang('inputs.name')">
            </div>
            <x-validation-error input='name' />
        </div>
        {{-- END name --}}
    </div>

    <div class="col-md-4">
        {{-- START ICON --}}
        <div class="form-group">
            <label>@lang('inputs.icon')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="{{ $row->icon ?? old('icon', 'fa fa-icons') }}"></i> </span>
                </div>
                <input type="text" class="form-control" name="icon" value="{{ $row->icon ?? old('icon', 'fa fa-icons') }}"  placeholder="fa fa-user">
            </div>
            <x-validation-error input='icon' />
        </div>
        {{-- END ICON --}}
    </div>
</div>

@once
    @push('script')
        <script>
            $(function() {
                $('body').on('keyup', 'input[name="icon"]', function() {
                    let icon = $(this).closest('.input-group').find('.input-group-text');
                    icon.html(`<i class="${$(this).val()}"></i>`);
                });
            })
        </script>
    @endpush
@endonce
