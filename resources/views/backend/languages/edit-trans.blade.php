<div class="card mb-0">
    <div class="card-content collpase show">
        <div class="card-body pb-0">
            @if (isset($trans['key']))
                <form action="{{ routeHelper('languages.trans.update', [$id, $trans['key']]) }}" class="submit-form" method="post">
                    @method('put')
            @else
                <form action="{{ routeHelper('languages.trans.store', $id) }}" class="submit-form" method="post">
            @endif
                @csrf
                <input hidden name="file" value="{{ $trans['file'] }}">

                <div class="form-group">
                    <label>@lang('inputs.key')</label>
                    <input type="text" name='key' class="form-control" @disabled(isset($trans['key'])) name="key" value="{{ $trans['key'] ?? '' }}">
                </div>


                <div class="form-group">
                    <label> @lang('inputs.value') </label>
                    <textarea class="form-control" name="trans">{{ $trans['val'] ?? '' }}</textarea>
                </div>

                {{-- END FORM BUTTONS --}}
                <x-form-buttons submit='save' />
                {{-- END FORM BUTTONS --}}
            </form>
        </div>
    </div>
</div>
