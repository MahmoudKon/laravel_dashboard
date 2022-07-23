<div class="col-xl-3 col-lg-6 col-12">
    <div class="card pull-up">
        <div class="card-content">
            <a href="{{ routeHelper("$model.index") }}" target="_blank">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-left">
                            <h3 class="{{ $color }}">{{ $count }}</h3>
                            <h6>@lang("menu.$model")</h6>
                        </div>
                        <div> <i class="fa {{ $icon }} {{ $color }} font-large-2 float-right"></i> </div></div>
                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                        <div class="progress-bar bg-gradient-x-{{ $color }}" role="progressbar" style="width: {{ $count }}%" aria-valuenow="{{ $count }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </a>
            @if (canUser("$model-create"))
                <a href="{{ routeHelper("$model.create") }}" class="btn btn-sm btn-{{ $color }} btn-block mt-1">
                    <i class="fa fa-plus"></i> <b> @lang('buttons.create')</b>
                </a>
            @endif
        </div>
    </div>
</div>
