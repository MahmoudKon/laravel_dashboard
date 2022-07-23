<div class="row">
    <div class="offset-md-4 col-md-3">
        {{-- END INPUT FILE --}}
        @include('backend.includes.forms.input-file', ['image' => asset($user->image), 'class' => 'required', 'alt' => $user->name])
        {{-- END INPUT FILE --}}
    </div>
</div>
