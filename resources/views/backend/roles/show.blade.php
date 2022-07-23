<div class="card">
    <div class="card-header bg-blue-grey py-1">
        <h4 class="card-title white">
            Role: {{ $row->name }}
        </h4>
    </div>

    <div class="card-body">
        <ul class="nav nav-tabs nav-top-border no-hover-bg">
            @foreach ($row->routes->groupBy('controller') as $controller => $routes)
                <li class="nav-item">
                    <a class="nav-link {{ $loop->first ? "active" : "" }}" id="base_{{ $controller }}" data-toggle="tab" aria-controls="{{ $controller }}" href="#{{ $controller }}" aria-expanded="false">{{ $controller }}</a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content px-1 pt-1">
            @foreach ($row->routes->groupBy('controller') as $controller => $routes)
            <div role="{{ $controller }}" class="list-routes tab-pane {{ $loop->first ? "active" : "" }}" id="{{ $controller }}" aria-expanded="true" aria-labelledby="base-tab11">
                    @foreach ($routes as $route)
                        <div class="form-group">
                            <div class="input-group">
                                <p class="form-control copy primary" data-toggle="tooltip" title="@lang('buttons.copy')" style="flex-grow: 3">{{ $route->uri }}</p>
                                <p class="form-control danger">{{ str_replace(',', ' | ', $route->method) }}</p>
                                <p class="form-control copy success" data-toggle="tooltip" title="@lang('buttons.copy')">{{ $route->func }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
