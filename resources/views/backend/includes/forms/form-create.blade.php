<div class="card-header bg-primary">
    <h4 class="card-title white">
        <i class="fas fa-plus fa-sm"></i><span class="mx-1">{{ $title ?? trans('menu.create-row', ['model' => trans('menu.'.getModel(true))]) }}</span>
    </h4>

    @yield('back')
</div>

<div class="card-content collpase show">
    <div class="card-body">
            <form action="{{ routeHelper(getModel().".store") }}" method="post" class="{{ $use_form_ajax ? 'submit-form' : '' }}" enctype="multipart/form-data">

            @csrf

            {{-- END FORM INPUTS --}}
            @include('backend.' . getModel(view:true) . '.form')
            {{-- END FORM INPUTS --}}

            {{-- END FORM BUTTONS --}}
            <x-form-buttons />
            {{-- END FORM BUTTONS --}}

            {{-- START FORM PROGRESS --}}
            <x-html.progress />
            {{-- END FORM PROGRESS --}}
        </form>
    </div>
</div>
