@php $alert_dir = app()->getLocale() == 'ar' ? 'right' : 'left'; @endphp

@if (session()->has('success'))
    <div class="alert bg-success alert-icon-{{ $alert_dir }} alert-arrow-{{ $alert_dir }} alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="fas fa-thumbs-up"></i></span>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        {!! session()->get('success') !!}
    </div>
@endif

@if (session()->has('status'))
    <div class="alert bg-primary alert-icon-{{ $alert_dir }} alert-arrow-{{ $alert_dir }} alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="fas fa-thumbs-up"></i></span>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        {!! session()->get('status') !!}
    </div>
@endif

@if (session()->has('failed'))
    <div class="alert bg-danger alert-icon-{{ $alert_dir }} alert-arrow-{{ $alert_dir }} alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="fas fa-thumbs-down"></i></span>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        {!! session()->get('failed') !!}
    </div>
@endif

@if (session()->has('error'))
    <div class="alert bg-danger alert-icon-{{ $alert_dir }} alert-arrow-{{ $alert_dir }} alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="fas fa-thumbs-down"></i></span>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        {!! session()->get('error') !!}
    </div>
@endif

@if (session()->has('info'))
    <div class="alert bg-info alert-icon-{{ $alert_dir }} alert-arrow-{{ $alert_dir }} alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="fas fa-info-circle"></i></span>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        {!! session()->get('info') !!}
    </div>
@endif

@if (session()->has('warning'))
    <div class="alert bg-warning alert-icon-{{ $alert_dir }} alert-arrow-{{ $alert_dir }} alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="fas fa-warning"></i></span>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        {!! session()->get('warning') !!}
    </div>
@endif
