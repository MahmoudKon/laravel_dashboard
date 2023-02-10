<div class="card">

    <div class="card-header bg-primary">
        <h4 class="card-title text-white">
            <i class="fas fa-plus fa-sm text-white"></i>
            <span class="mx-2">{{ $title }}</span>
        </h4>
    </div>

    <div class="card-content collpase show">
        <div class="card-body">
            <form action="{{ $route }}" method="post" class="{{ $use_form_ajax ? 'submit-form' : '' }}" enctype="multipart/form-data">
                @csrf

                {{-- START FORM INPUTS --}}
                @include('backend.' . getModel(view:true) . '.'.$form_name)
                {{-- END FORM INPUTS --}}

                {{-- START FORM BUTTONS --}}
                <x-form-buttons />
                {{-- END FORM BUTTONS --}}

                {{-- START FORM PROGRESS --}}
                <x-html.progress />
                {{-- END FORM PROGRESS --}}
            </form>
        </div>
    </div>

</div>
