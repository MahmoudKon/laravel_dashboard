@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title white"> @lang('title.show lang files', ['lang' => $row->short_name]) </h3>
        </div>

        <div class="card-body">
            @if ($files)
                <label> @lang('inputs.select-data', ['data' => trans('inputs.file_name')]) </label>
                <select id="trans-file">
                    @foreach ($files as $index => $file)
                        <option value="{{ $file['name'] }}" {{ $index == 0 ? 'selected' : '' }} >{{ $file['name'] }}</option>
                    @endforeach
                </select>
                
                {{-- <a href='' class="btn btn-sm btn-primary float-right"> <i class="fas fa-plus"></i> @lang('buttons.create')</a> --}}
            @endif

            <div id="load-data"></div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $(`li[data-route="{{ ROUTE_PREFIX.getModel().'.index' }}"]`).addClass('active').closest('.has-sub').addClass('active open');

            $('body').on('change', '#trans-file', function() {
                let url = `${window.location.href}?file=${$('#trans-file').val()}`;
                rows(null, url);
            });

            $('body').on('click', 'a.page-link', function(e) {
                e.preventDefault();
                let url = new URL( $(this).attr('href') );
                url.searchParams.append('file', $('#trans-file').val());
                rows(null, url.href);
            });
        });
    </script>
@endsection
