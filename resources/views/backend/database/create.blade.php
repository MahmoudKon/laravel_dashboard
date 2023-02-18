@extends('layouts.backend')

@section('content')
    <div class="card">
        {{-- START INCLUDE TABLE HEADER --}}
        @include('backend.includes.cards.table-header')
        {{-- START INCLUDE TABLE HEADER --}}

        <div class="card-content collpase show">
            <div class="card-body">

                <form method="post" action="{{ routeHelper('database.store') }}" class="submit-form">
                    @csrf

                    <div class="form-group">
                        <label for="table_name">Table Name</label>
                        <input type="text" class="form-control" name="table_name" id="table_name" placeholder="Table Name">
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered table-responsive repeater-default" style="min-width: 2000px">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 300px" class="text-center">Name</th>
                                    <th scope="col" style="width: 300px" class="text-center">Type</th>
                                    <th scope="col" style="width: 150px" class="text-center">Length/Values</th>
                                    <th scope="col" style="width: 300px" class="text-center">Default</th>
                                    <th scope="col" style="width: 300px" class="text-center">Attributes</th>
                                    <th scope="col" style="width: 100px" class="text-center">Null</th>
                                    <th scope="col" style="width: 300px" class="text-center">Index</th>
                                    <th scope="col" style="width: 100px" class="text-center" title="Auto Increment">A.I</th>
                                    <th scope="col" style="width: 300px" class="text-center">Comment</th>
                                    <th scope="col" style="width: 100px" class="text-center" style="width: 4%">@lang('buttons.delete')</th>
                                </tr>
                            </thead>
                            <tbody data-repeater-list="columns" >
                                @include('backend.database.includes.id')
                                @include('backend.database.includes.created')
                                @include('backend.database.includes.updated')
                                @include('backend.database.includes.row')
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <button type="button" data-repeater-create class="btn btn-primary">
                                            <i class="ft-plus"></i> Add
                                        </button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="ft-plus"></i> Save
                    </button>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ assetHelper('vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ assetHelper('js/scripts/forms/form-repeater.js') }}"></script> --}}
    <script>
        $(function() {
            $('.repeater-default').repeater();

            $('body').on('change', '.default_type', function() {
                if ($(this).val() == 'USER_DEFINED') {
                    $(this).next('input').show();
                } else {
                    $(this).next('input').hide().val('');
                }
            });
        });
    </script>
@endsection
