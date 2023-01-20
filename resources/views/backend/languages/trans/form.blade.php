<div class="card mb-0">
    <div class="card-content collpase show">
        <div class="card-body pb-0">
            @if (isset($trans['key']))
                <form action="{{ routeHelper('languages.trans.update', [$row->id, $trans['key']]) }}" class="submit-form" method="post">
                    @method('put')
            @else
                <form action="{{ routeHelper('languages.trans.store', $row->id) }}" class="submit-form" method="post">
            @endif
                @csrf
                <input hidden name="file" value="{{ $trans['file'] }}">


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('menu.the language')</label>
                            <input disabled class="form-control" value="{{ $row->native }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('inputs.file_name')</label>
                            <input disabled class="form-control" value="{{ $trans['file'] }}">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label>@lang('inputs.key')</label>
                    <input type="text" name='key' class="form-control" placeholder="@lang('title.type translation key')" @disabled(isset($trans['key'])) name="key" value="{{ $trans['key'] ?? '' }}">
                </div>


                <div class="form-group">
                    <label> @lang('inputs.value') </label>
                    <textarea class="form-control" placeholder="@lang('title.type translation value')" name="trans">{{ $trans['val'] ?? '' }}</textarea>
                </div>

                {{-- END FORM BUTTONS --}}
                <x-form-buttons submit='save' />
                {{-- END FORM BUTTONS --}}
            </form>
        </div>
    </div>
</div>
