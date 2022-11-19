<div class="card-header bg-primary">
    <h4 class="card-title white">
        <i class="ft-edit"></i><span class="mx-1">{{ $title ?? trans('menu.edit-row', ['model' => trans('menu.'.getModel(true))]) }}</span>
    </h4>
    @yield('back')
</div>

<div class="card-content collpase show">
    <div class="card-body">
        <form action="{{ routeHelper(getModel().'.update', $row) }}" method="post" class="{{ $use_form_ajax ? 'submit-form' : '' }}" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <input type="hidden" name="id" value="{{ $row->id ?? '' }}">

            {{-- END FORM INPUTS --}}
            @include('backend.' . getModel(view:true) . '.form')
            {{-- END FORM INPUTS --}}

            {{-- END FORM BUTTONS --}}
            @include('backend.includes.buttons.form-buttons')
            {{-- END FORM BUTTONS --}}
        </form>
    </div>
</div>
