<ul class="nav nav-tabs nav-top-border no-hover-bg">
    @foreach ($roles as $role)
        <li class="nav-item">
            <a class="nav-link {{ $loop->first ? "active" : "" }}" id="base-{{ str_replace(' ', '_', $role->name)."_".$role->id }}" data-toggle="tab" aria-controls="{{ str_replace(' ', '_', $role->name)."_".$role->id }}" href="#{{ str_replace(' ', '_', $role->name)."_".$role->id }}" aria-expanded="false">{{ $role->name }}</a>
        </li>
    @endforeach
</ul>

<div class="tab-content px-1 pt-1">
    @foreach ($roles as $role)
    <div role="{{ str_replace(' ', '_', $role->name)."_".$role->id }}" class="list-routes tab-pane {{ $loop->first ? "active" : "" }}" id="{{ str_replace(' ', '_', $role->name)."_".$role->id }}" aria-expanded="true" aria-labelledby="base-tab11">
        <button class="btn btn-sm btn-primary toggle-checked float-right">Check/Uncheck All</button>
            @foreach ($routes as $route)
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text p-0">
                                    <input type="checkbox" name="roles[{{ $route->id }}][]" value="{{ $role->id }}" multiple class="switchery" id="route_{{ $route->id }}_role_{{ $role->id }}" @checked($route->hasRole($role->id)) style="margin-top: 8px;">
                                </div>
                            </div>
                            <p class="form-control copy primary" data-toggle="tooltip" title="@lang('buttons.copy')" style="flex-grow: 3">{{ $route->uri }}</p>
                            <p class="form-control copy info" style="flex-grow: 2">{{ $route->route }}</p>
                            <p class="form-control danger">{{ str_replace(',', ' | ', $route->method) }}</p>
                            <p class="form-control copy success" data-toggle="tooltip" title="@lang('buttons.copy')">{{ $route->func }}</p>
                        </div>
                    </div>
            @endforeach
        </div>
    @endforeach
</div>
