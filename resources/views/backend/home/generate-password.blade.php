<div class="card-header bg-primary">
    <h4 class="card-title white">
        <i class="fas fa-hashtag fa-sm"></i><span class="mx-1">@lang('buttons.generate-password')</span>
    </h4>
</div>

<div class="card-content">
    <div class="card-body">

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <a href="javascript:void(0)" class="input-group-text btn btn-sm btn-primary" data-copy-target="#show-generated-password">  <i class="fas fa-copy" style="padding: 0 7px"></i>  @lang('buttons.copy') </a>
                </div>

                <input type="text" class="form-control" id="show-generated-password" readonly value="{{ $password }}">

                <div class="input-group-prepend">
                    <a href="{{ $url }}" class="input-group-text btn btn-sm btn-grey-blue" id ="regenerat-password"> @lang('buttons.regenerate-password') </a>
                </div>
            </div>
        </div>

    </div>
</div>
