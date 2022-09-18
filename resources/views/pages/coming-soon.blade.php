@extends('layouts.flat-page')

@section('page-title', 'Coming Soon')

@section('body-class', 'comingsoonOne')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/pages/coming-soon.css') }}">
@endsection

@section('content')
    <div class="text-center">
        <h5 class="card-text pb-2">@lang('title.we are launching soon')</h5>
        <img src="{{ asset( setting('logo', 'images/logo/logo-light-lg.png') ) }}"
            class="img-responsive block width-300 mx-auto" width="300" alt="bg-img">
        <div id="clockImage" class="card-text getting-started mt-3 d-inline-block">
            <div class="d-flex justify-content-around">
                <span class="p-1 border-1 border-amber">
                    <span class="d-block font-size-xsmall">Years</span>
                    <i id="years"></i>
                </span>
                <span style="padding: 0 5px" class="align-self-center">:</span>
                <span class="p-1 border-1 border-amber">
                    <span class="d-block font-size-xsmall">Days</span>
                    <i id="days"></i>
                </span>
                <span style="padding: 0 5px" class="align-self-center">:</span>
                <span class="p-1 border-1 border-amber">
                    <span class="d-block font-size-xsmall">Hours</span>
                    <i id="hours"></i>
                </span>
                <span style="padding: 0 5px" class="align-self-center">:</span>
                <span class="p-1 border-1 border-amber">
                    <span class="d-block font-size-xsmall">Minutes</span>
                    <i id="minutes"></i>
                </span>
                <span style="padding: 0 5px" class="align-self-center">:</span>
                <span class="p-1 border-1 border-amber">
                    <span class="d-block font-size-xsmall">Seconds</span>
                    <i id="seconds"></i>
                </span>
            </div>
        </div>
        <div class="col-12 pt-1">
            <p class="card-text lead">@lang('title.our website is under construction')</p>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            let finalDate = "{{ setting('coming soon date', '2025-08-24') }}";
            $('#clockImage').countdown(finalDate)
            .on('update.countdown', function(data) {
                if (data.offset.years > 0) $('#years').removeClass('d-none').text(data.offset.years < 10 ? `0${data.offset.years}` : data.offset.years);
                $('#days').text(data.offset.days < 10 ? `0${data.offset.days}` : data.offset.days);
                $('#hours').text(data.offset.hours);
                $('#minutes').text(data.offset.minutes);
                $('#seconds').text(data.offset.seconds);
            })
            .on('finish.countdown', function(data) {
                $('#days, #hours, #minutes, #seconds').text('00');
            })
            .countdown('start');
        });
    </script>
@endsection
