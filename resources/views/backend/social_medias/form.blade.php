
<div class="text-center">
    <a href='javascript::void(0)' id="demo" class="btn text-white btn-sm"></a>
</div>

<div class='row' id="form-elements">
    <div class="col-md-9">
        {{-- START name --}}
        <div class="form-group">
            <label class="required">@lang('inputs.name')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-pencil"></i> </span>
                </div>
                <input type="text" class="form-control" name="name" required value="{{ $row->name ?? old('name') }}"  placeholder="@lang('inputs.name')">
            </div>
            <x-validation-error input='name' />
        </div>
        {{-- END name --}}
    </div>

    <div class="col-md-3">
        {{-- START COLOR --}}
        <div class="form-group">
            <label class="required">@lang('inputs.color')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa-solid fa-brush"></i> </span>
                </div>
                <input type="color" class="form-control" name="color" required value="{{ $row->color ?? old('color', '#6B6F82') }}">
            </div>
            <x-validation-error input='color' />
        </div>
        {{-- END COLOR --}}
    </div>


    <div class="col-md-9">
        {{-- START url --}}
        <div class="form-group">
            <label class="required">@lang('inputs.url')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa-solid fa-link"></i> </span>
                </div>
                <input type="url" class="form-control" name="url" required value="{{ $row->url ?? old('url') }}"  placeholder="@lang('inputs.url')">
            </div>
            <x-validation-error input='url' />
        </div>
        {{-- END url --}}
    </div>

    <div class="col-md-3">
        {{-- START ICON --}}
        <div class="form-group">
            <label class="required">@lang('inputs.icon')</label>

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="{{ $row->icon ?? old('icon', 'fas fa-icons') }}"></i> </span>
                </div>
                <input type="text" class="form-control" name="icon" required value="{{ $row->icon ?? old('icon', 'fas fa-icons') }}"  placeholder="fas fa-icons">
            </div>
            <p class="text-warning">
                go to this <a href='https://fontawesome.com/search?o=r&m=free' target="_blank">link</a> to check the icons
            </p>
            <x-validation-error input='icon' />
        </div>
        {{-- END ICON --}}
    </div>

</div>

<script>
    $(function() {
        $('body').on('keyup change', '.submit-form input', function() { setDemoBtn(); });

        $('body').on('keyup', 'input[name="icon"]', function() {
            let icon = $(this).closest('.input-group').find('.input-group-text');
            icon.html(`<i class="${$(this).val()}"></i>`);
        });

        function setDemoBtn() {
            $('#demo').attr("style", `background-color: ${$('.submit-form input[name="color"]').val()} !important; font-weight: bold;`)
                        .html(`<i class='${$('.submit-form input[name="icon"]').val()}' style='padding: 0 5px'></i> ${$('.submit-form input[name="name"]').val()}`);
        }

        $('body').find('#form-elements input').change();
    })
</script>
