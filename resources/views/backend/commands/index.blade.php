@extends('layouts.backend')

@section('content')
    <div class="card">
        {{-- START INCLUDE TABLE HEADER --}}
        @include('backend.includes.cards.table-header')
        {{-- START INCLUDE TABLE HEADER --}}

        <div class="card-content collpase show" dir="lrt" style="text-align: left">
            <div class="card-body">
                <div class="row">
                    @foreach($commands as $command)
                        @include('backend.commands.command', ['command' => $command])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@once
    @push('script')
        <script>
            $(function() {
                $('.call-command-form').on('submit', function (e) {
                    e.preventDefault();
                    let form = $(this);
                    submitForm(form, function(response) {
                        $('#load-form').modal('show').find('.modal-body').html(response);
                        form.find('input[name="args"]').val('');
                    });
                });
            });
        </script>
    @endpush
@endonce
