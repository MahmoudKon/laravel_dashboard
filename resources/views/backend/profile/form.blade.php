<div class="card-header {{ $bg }}">
    <span class="white">@lang("title.change $form_type")</span>
</div>

<div class="card-body">
    <form action="{{ routeHelper("profile.$form_type") }}" method="post" class="submit-form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="form_type" value="{{ $form_type }}">
        @method("PUT")

        {{-- END ROLES --}}
        @include("backend.profile.$form_type")
        {{-- END ROLES --}}

        {{-- END FORM BUTTONS --}}
        <x-form-buttons submit='save' />
        {{-- END FORM BUTTONS --}}
    </form>
</div>
