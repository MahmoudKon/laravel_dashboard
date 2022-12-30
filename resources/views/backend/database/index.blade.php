@extends('layouts.backend')

@section('content')
    <div class="card">
        {{-- START INCLUDE TABLE HEADER --}}
        @include('backend.includes.cards.table-header')
        {{-- START INCLUDE TABLE HEADER --}}

        <div class="card-content collpase show">
            <div class="card-body">

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fas fa-search"></i> </span>
                    </div>
                    <input type="search" class="form-control" placeholder="Search By Table Name..." id="search-in-list-tables">
                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-striped table-hover mb-0" id="list-tables">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('inputs.name')</th>
                                <th>Engine</th>
                                <th>Rows Count</th>
                                <th>Size</th>
                                <th>Auto Increment</th>
                                <th>Collection</th>
                                <th>@lang('buttons.cover')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tables as $table)
                                <tr data-table="{{ $table->TABLE_NAME }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $table->TABLE_NAME }}</td>
                                    <td>{{ $table->ENGINE }}</td>
                                    <td>{{ $table->TABLE_ROWS }}</td>
                                    <td><i class="fa-solid fa-k"></i> {{ $table->Size }}</td>
                                    <td>{{ $table->AUTO_INCREMENT }}</td>
                                    <td>{{ $table->TABLE_COLLATION }}</td>
                                    <td>
                                        <a href='{{ routeHelper('database.show', $table->TABLE_NAME) }}' class="btn btn-sm btn-info show-modal-form"> <i class="fas fa-eye"></i> @lang('buttons.cover') </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            var table_ele = $('#list-tables');
            $('#search-in-list-tables').on('change keyup', function (e) {
                let keyword = $(this).val();
                $.each( table_ele.find('tbody tr'), function () {
                    if ( $(this).data('table').indexOf(keyword) != -1 )
                        $(this).show();
                    else
                        $(this).hide();
                });
            });
        });
    </script>
@endsection
