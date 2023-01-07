<a class="heading-elements-toggle">
    <i class="fas fa la-ellipsis-h font-medium-3"></i>
</a>
<div class="heading-elements" style="top: 16px">
    <ul class="list-inline mb-0">
        <li>
            <a href="{{ routeHelper(getModel().'.index') }}" data-toggle="tooltip" title="@lang('title.back-to-page', ['model' => trans('menu.'.getModel())])"
                class="btn btn-primary btn-glow dropdown-item">
                <i class="fas fa-sign-out-alt"></i>  @lang('buttons.back')
            </a>
        </li>

        <li><a data-action="collapse" data-toggle="tooltip" class="text-white" title="@lang('title.minus-section')" ><i class="fas fa-minus"></i></a></li>
        <li><a data-action="expand" data-toggle="tooltip" class="text-white" title="@lang('title.full-page')" ><i class="fas fa-maximize"></i></a></li>
        <li><a data-action="close" data-toggle="tooltip" class="text-white" title="@lang('title.remove-section')" ><i class="fas fa-times"></i></a></li>
    </ul>
</div>
