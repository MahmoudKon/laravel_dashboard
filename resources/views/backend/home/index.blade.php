@extends('layouts.backend')

@section('content')
<!-- eCommerce statistic -->
<div class="row">
    @include("backend.home.statistics", ['model' => 'users', 'count' => $count['users'], 'icon' => 'fa-users', 'color' => 'info'])
    @include("backend.home.statistics", ['model' => 'departments', 'count' => $count['departments'], 'icon' => 'fa-building-user', 'color' => 'primary'])
    @include("backend.home.statistics", ['model' => 'roles', 'count' => $count['roles'], 'icon' => 'fa-shield', 'color' => 'warning'])

    {{-- START CATEGORIES --}}
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card pull-up">
            <div class="card-content">
                <a href="{{ routeHelper("routes.index") }}" target="_blank">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="success">{{ $count['routes'] }}</h3>
                                <h6>@lang('menu.routes')</h6>
                            </div>
                            <div> <i class="fa fa-anchor success font-large-2 float-right"></i> </div></div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: {{ $count['routes'] }}%" aria-valuenow="{{ $count['routes'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </a>
                @if (canUser('routes-assign'))
                    <a href="{{ routeHelper("routes.assign") }}" class="btn btn-sm btn-success btn-block mt-1">
                        <i class="fa fa-plus"></i> <b> @lang('buttons.assign-roles')</b>
                    </a>
                @endif
            </div>
        </div>
    </div>
    {{-- END CATEGORIES --}}
</div>
<!--/ eCommerce statistic -->
@endsection
