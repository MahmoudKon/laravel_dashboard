@extends('layouts.backend')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/forms/selects/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/forms/toggle/switchery.min.css') }}">
@endsection

@section('content')
<div class="card">
    @include('backend.includes.cards.table-header', ['title' => trans('title.assign-roles-for-each-route')])

    <div class="card-content collpase show">
        <div class="card-body">
            <form action="{{ routeHelper('routes.assign-roles') }}" method="post" class="{{ $use_form_ajax ? 'submit-form' : '' }}">
                @csrf

                {{-- START ROLES --}}
                <div class="form-group">
                    <label for="controller" class="required">
                        @lang('inputs.select-data', ['data' => trans('inputs.controller')])
                    </label>
                    <select class="select2 form-control w-100" id="controller" name="controller" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('inputs.controller')]) --- " required>
                        <option value="">@lang('inputs.please-select')</option>
                        @foreach ($controllers as $name)
                        <option value="{{ $name }}" @selected(request()->controller)>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- END ROLES --}}

                <div id="load-table"></div>

                {{-- END FORM BUTTONS --}}
                <x-form-buttons />
                {{-- END FORM BUTTONS --}}
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ assetHelper('js/scripts/forms/select/form-select2.js') }}"></script>

    <script>
        $(function() {
            $('body').on('change', '#controller', function() {
                if ($(this).val() == '') return true;
                $('#load-table').addClass('load');
                $.ajax({
                    url: window.location.href,
                    type: "get",
                    data: {controller: $(this).val()},
                    success: function(data, textStatus, jqXHR) {
                        $('#load-table').empty().append(data);
                    },
                    error: function(jqXHR) {
                        handleErrors(jqXHR);
                        $('#load-table').removeClass('load');
                    },
                    complete: function () { $('#load-table').removeClass('load');}
                });
            });
        });
    </script>
@endsection
