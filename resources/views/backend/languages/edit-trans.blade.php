<div class="card mb-0">
    <div class="card-content collpase show">
        <div class="card-body pb-0">
            <form action="{{ routeHelper('languages.trans.update', [$row, $trans['key']]) }}" class="submit-form" method="post">
                @csrf
                <input hidden name="file" value="{{ $trans['file'] }}">

                <div class="form-group">
                    <label>{{ $trans['key'] }}</label>
                    <textarea class="form-control" name="{{ $trans['key'] }}">{{ $trans['val'] }}</textarea>
                </div>

                {{-- END FORM BUTTONS --}}
                <x-form-buttons submit='save' />
                {{-- END FORM BUTTONS --}}
            </form>
        </div>
    </div>
</div>
