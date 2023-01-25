@if (canUser("$table-index"))
    <div class="col-xl-3 col-lg-6 col-12">
        <div class="card pull-up">
            <div class="card-content">
                <a href="{{ routeHelper("$table.index") }}" target="_blank">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="{{ $info['color'] }}">{{ $info['count'] }}</h3>
                                <h6>@lang("menu.$table")</h6>
                            </div>
                            <div> <i class="{{ $icons[ ucwords( str_replace('_', ' ', $table) ) ] }} {{ $info['color'] }} font-large-2 float-right"></i> </div></div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-{{ $info['color'] }}" role="progressbar" style="width: {{ $info['count'] }}%" aria-valuenow="{{ $info['count'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </a>
                @if (canUser("$table-create") && Route::has(getRoutePrefex('.')."$table.create"))
                    <a href="{{ routeHelper("$table.create") }}" class="btn btn-sm btn-{{ $info['color'] }} btn-block mt-1">
                        <i class="fa fa-plus"></i> <b> @lang('buttons.create')</b>
                    </a>
                @endif
            </div>
        </div>
    </div>
@endif
