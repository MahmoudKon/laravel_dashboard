@extends('layouts.backend')

@section('content')

<!-- eCommerce statistic -->
<div class="row">
    @foreach ($tables as $table => $info)
        @if ($table !== 'routes')
            @include("backend.home.statistics")
        @endif
    @endforeach

    @if ( canUser('routes-index') )
        {{-- START ROUTES --}}
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <a href="{{ routeHelper("routes.index") }}" target="_blank">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="{{ $tables['routes']['color'] }}">{{ $tables['routes']['count'] }}</h3>
                                    <h6>@lang('menu.routes')</h6>
                                </div>
                                <div> <i class="fa fa-anchor {{ $tables['routes']['color'] }} font-large-2 float-right"></i> </div></div>
                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                <div class="progress-bar bg-gradient-x-{{ $tables['routes']['color'] }}" role="progressbar" style="width: {{ $tables['routes']['count'] }}%" aria-valuenow="{{ $tables['routes']['count'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </a>
                    @if (canUser('routes-assign'))
                        <a href="{{ routeHelper("routes.assign") }}" class="btn btn-sm btn-{{ $tables['routes']['color'] }} btn-block mt-1">
                            <i class="fa fa-plus"></i> <b> @lang('buttons.assign-roles')</b>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        {{-- END ROUTES --}}
    @endif

</div>


@include("backend.home.announcements")

<!--/ eCommerce statistic -->
@endsection
