@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title white"> @lang('title.show lang files', ['lang' => $row->short_name]) </h3>
        </div>

        <div class="card-body">
            <div class="d-flex justify-content-between">
                @if ($files)
                    <div>
                        <label> @lang('inputs.select-data', ['data' => trans('inputs.file_name')]) </label>
                        <select id="trans-file">
                            @foreach ($files as $index => $file)
                                <option value="{{ $file['name'] }}" @selected($index == 0)>{{ $file['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <a href='{{ routeHelper('languages.trans.create', request()->route()->language) }}' class="btn btn-sm btn-primary show-modal-form" id='create-new-trans'> <i class="fas fa-plus"></i> @lang('buttons.create')</a>
                @endif

                <select id="languages">
                    @foreach ($languages as $language)
                        <option value="{{ $language->id }}" data-route="{{ routeHelper("languages.show", $language) }}" data-icon="{{ $language->icon }}" @selected( request()->route()->language == $language->id )>
                            {{ $language->native }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div id="load-data" data-route=''></div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $(`li[data-route="{{ getRoutePrefex('.').getModel().'.index' }}"]`).addClass('active').closest('.has-sub').addClass('active open');
            $('body').on('change', '#languages', function() { window.location = $(this).find('option:selected').data('route'); });

            $('body').on('change', '#trans-file', function() {
                let url = `${window.location.href}?file=${$('#trans-file').val()}`;
                $('#load-data').data('route', url);
                $('#create-new-trans').attr('href', appendFilePram($('#create-new-trans')));
                rows();
            });

            $('body').on('click', 'a.page-link', function(e) {
                e.preventDefault();
                if ($(this).parent('li').hasClass('active')) return;
                $('#load-data').data('route', appendFilePram($(this)));
                rows();
            });

            $('#trans-file').change();

            function appendFilePram(ele)
            {
                let url = new URL( ele.attr('href') );
                url.searchParams.set("file", $('#trans-file').val());
                return url.href;
            }
        });
    </script>
@endsection
