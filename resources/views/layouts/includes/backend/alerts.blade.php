@php $alert_dir = app()->getLocale() == 'ar' ? 'right' : 'left'; @endphp

@if (session('success'))
    <div class="alert bg-success alert-icon-{{ $alert_dir }} alert-arrow-{{ $alert_dir }} alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="fas fa-thumbs-up"></i></span>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        {!! session('success') !!}
    </div>
@endif

@if (session('status'))
    <div class="alert bg-primary alert-icon-{{ $alert_dir }} alert-arrow-{{ $alert_dir }} alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="fas fa-thumbs-up"></i></span>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        {!! session('status') !!}
    </div>
@endif

@if (session('failed'))
    <div class="alert bg-danger alert-icon-{{ $alert_dir }} alert-arrow-{{ $alert_dir }} alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="fas fa-thumbs-down"></i></span>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        {!! session('failed') !!}
    </div>
@endif

@if (session('error'))
    <div class="alert bg-danger alert-icon-{{ $alert_dir }} alert-arrow-{{ $alert_dir }} alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="fas fa-thumbs-down"></i></span>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        {!! session('error') !!}
    </div>
@endif

@if (session('info'))
    <div class="alert bg-info alert-icon-{{ $alert_dir }} alert-arrow-{{ $alert_dir }} alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="fas fa-info-circle"></i></span>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        {!! session('info') !!}
    </div>
@endif

@if (session('warning'))
    <div class="alert bg-warning alert-icon-{{ $alert_dir }} alert-arrow-{{ $alert_dir }} alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="fas fa-warning"></i></span>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        {!! session('warning') !!}
    </div>
@endif
