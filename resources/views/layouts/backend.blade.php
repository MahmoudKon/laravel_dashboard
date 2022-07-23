{{-- START HEADER SECTION --}}
@include('layouts.includes.backend.header')
{{-- END HEADER SECTION --}}


        {{-- START LOADING SECTION --}}
        @include('layouts.includes.backend.loading')
        {{-- END LOADING SECTION --}}

{{-- START NAVBAR SECTION --}}
@include('layouts.includes.backend.navbar')
{{-- END NAVBAR SECTION --}}


{{-- START SIDEBAR SECTION --}}
@include('layouts.includes.backend.sidebar')
{{-- END SIDEBAR SECTION --}}


<div class="app-content content">
    <div class="content-wrapper">

        {{-- START BREADCRUMB SECTION --}}
        @if (stripos(request()->route()->action['controller'], 'EmailController') === false)
            @include('layouts.includes.backend.breadcrumb')
        @endif
        {{-- END BREADCRUMB SECTION --}}

        <div class="content-body">
            {{-- START ALERTS SECTION --}}
            @include('layouts.includes.backend.alerts')
            {{-- END ALERTS SECTION --}}

            {{-- START CONTENT SECTION --}}
            @yield('content')
            {{-- END CONTENT SECTION --}}
        </div>
    </div>
</div>


{{-- START MODAL SECTION --}}
@include('layouts.includes.backend.modal')
{{-- END MODAL SECTION --}}


{{-- START FOOTER SECTION --}}
@include('layouts.includes.backend.footer')
{{-- END FOOTER SECTION --}}
