@extends('layouts.backend')

@section('content')
    <div class="card">
        {{-- START INCLUDE TABLE HEADER --}}
        @include('backend.includes.cards.table-header')
        {{-- START INCLUDE TABLE HEADER --}}

        <div class="card-content collpase show">
            <div class="card-body">

                <form method="post" action="{{ routeHelper('database.store') }}" id="submit-form">
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

            $('body').on('submit', 'form#submit-form', function(e) {
                e.preventDefault();
                let form = $(this);
                let time;
                let progress = 0;
                form.find('.error').remove();

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: new FormData(form[0]),
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    xhr: function () {
                        let jqXHR = window.ActiveXObject ? new window.ActiveXObject( "Microsoft.XMLHTTP" ) : new window.XMLHttpRequest();
                        jqXHR.upload.addEventListener( "progress", function ( evt ) {
                            if ( evt.lengthComputable ) {
                                let percent = Math.round( (evt.loaded * 100) / evt.total );
                                progressBar(form.find(".progress"), percent);
                                $.ajaxSettings.xhr(evt, evt.loaded, evt.total, percent);
                            }
                        }, false );
                        return jqXHR;
                    },
                    beforeSend: function (jqHXR) { beforeSendRequest(form) },
                    success: function (response, textStatus, jqXHR) {
                        $('.modal').modal("hide").find('.form-body').empty();
                        if (response.redirect) return window.location = response.redirect;

                        if (response.reload) return location.reload(true);

                        toast(response.message, null, (response.icon ?? 'success'));

                        form.parent().removeClass('load');

                        if (response.stop) return;
                        form.trigger("reset");
                        form.find('select').val('').trigger('change');
                        rows();
                        $('#recourds-count').text(response.count);
                    },
                    error: function (jqXHR, textStatus, errorMessage) {
                        $.each(jqXHR.responseJSON.errors, function (key, val) {
                            key = key.split('.');
                            let input = key[0];
                            input += key[1] ? `[${key[1]}]` : '';
                            input += key[2] ? `[${key[2]}]` : '';
                            $(`input[name="${input}"]`).parent().append(`<span class='text-danger error'>${val}</span>`);
                        });
                    },
                    complete: function (jqXHR, textStatus) { clearInterval(time); completeRequest(form); }
                });
            }); // WHEN SUBMIT THE FORM SEND DATA TO CONTROLLER
        });
    </script>
@endsection
