@extends('layouts.frontend')

@section('page-title', 'Sudoku')

@section('body-class', 'Sudoku')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('customs/css/loading.css') }}">
    <style>
        .sudoku {
            border: 3px solid #000;
            border-right: unset;
            border-bottom: unset;
        }
        .sudoku input {
            border: 1px solid #c5c5c5;
            padding: 5px;
            cursor: pointer;
        }
        .sudoku input:hover {
            background-color: #969795;
            font-weight: bold;
        }
        .sudoku input:focus {
            font-weight: bold;
            background-color: #94e761;
            outline: unset;
            border: 1px dashed rgb(160, 9, 9) !important;
        }
        .sudoku input.area {
            border-right: 3px solid #000 !important;
        }
        .sudoku input.main {
            font-weight: bold;
            background-color: #ebebeb;
        }
        .sudoku div.area {
            border-bottom: 3px solid #000 !important;
        }
    </style>
@endsection

@section('content')

    <div class="card border-grey border-lighten-3 px-1 py-1 box-shadow-3 m-0">
        <div class="row">
            <div class="col-md-6">
                <div class="card-header">
                    <h3 class="card-title"> Game </h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('sudoku.solve') }}">
                        @csrf
                        <div class="sudoku">
                            @foreach (range(0,8) as $row)
                                <div class="d-flex {{ $loop->iteration % 3 == 0 ? 'area' : '' }}">
                                    @foreach (range(0,8) as $column)
                                        <input type="text" name="sudoku[{{ $row }}][{{ $column }}]" class="w-25 text-center {{ $loop->iteration % 3 == 0 ? 'area' : '' }}" placeholder="-">
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm"> Submit </button>
                        <a href="javascript::void(0)" id="get-random" class="btn btn-warning btn-sm"> Random </a>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card-header">
                    <h3 class="card-title"> Result: <span id="time"></span> </h3>
                </div>
                <div class="card-body">
                    <div id="sudoku-solve"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            $('input').on('change', function(e) {
                if ( $(this).val().length > 0 )
                    $(this).addClass('main');
                else
                    $(this).removeClass('main');

                if (! /^[0-9]+$/.test($(this).val())) $(this).val('').removeClass('main');
            });

            $('form').on('submit', function (e) {
                e.preventDefault();
                let form = $(this);
                form.closest('.card').addClass('load');
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function (response) {
                        $('#time').text(`${response.time} Sec`);
                        let element = '<div class="sudoku">';
                        $.each(response.result, function (row, columns) {
                            element += `<div class="d-flex ${ (row + 1) % 3 == 0 ? 'area' : '' }">`;
                            $.each(columns, function (column, value) {
                                let class_list = $(`input[name="sudoku[${row}][${column}]"]`).attr('class');
                                element += `<input disabled class="${class_list}" value="${value}">`;
                            });
                            element += '</div>';
                        });
                        element += '</div>';
                        $('#sudoku-solve').empty().append(element);
                    },
                    complete: function () { form.closest('.card').removeClass('load'); }
                });
            });

            $('#get-random').on('click', function(e) {
                e.preventDefault();
                let loader = $(this).closest('.card');
                loader.addClass('load');
                $.ajax({
                    type: "post",
                    url: "{{ route('sudoku.generate') }}",
                    data: {_token: '{{ csrf_token() }}'},
                    success: function (response) {
                        $.each(response, function (row, columns) {
                            $.each(columns, function (column, value) {
                                if (value)
                                    $('.sudoku').find(`input[name="sudoku[${row}][${column}]"]`).val(value).addClass('main');
                                else
                                    $('.sudoku').find(`input[name="sudoku[${row}][${column}]"]`).val('').removeClass('main');
                            });
                        });
                    },
                    complete: function () { loader.removeClass('load'); }
                });
            });
        });
    </script>
@endsection
