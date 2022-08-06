    {{-- START FOOTER --}}
    <footer class="footer footer-static footer-light footer-dark navbar-border navbar-shadow" style="position: relative; z-index: 1;">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
            <span class="float-md-left d-block d-md-inline-block">
                Copyright &copy; {{ date('Y') }}
                <a class="text-bold-800 grey darken-2" target="_blank">IVAS</a>
                , All rights reserved.
            </span>
            <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">
                Hand-crafted & Made with <i class="ft-heart pink"></i>
            </span>
        </p>
    </footer>

    {{-- END FOOTER --}}

    {{-- ************** START VENDOR JS ************** --}}
    <script>
        const ENDPOINT = "{{ routeHelper('/') }}"; // Main project url
        const main_path = "{{ url('/') }}"; // Main project url
        var successAudio = "{{ asset($successAudio) }}"; // Success audio from setting or from defualt value
        var warrningAudio = "{{ asset($warrningAudio) }}";  // Warring or error audio from setting or from defualt value
        var RUN_SOUND = true;
        var SWAL_TITLE = "@lang('title.are you sure')";
        var SWAL_MESSAGE = "@lang('title.you wont be able to revert this')";
        var SWAL_DELETE_BUTTON = "@lang('buttons.yes delete')";
        var SWAL_CANCEL_BUTTON = "@lang('buttons.cancel')";
        var SWAL_FAILED_TITLE = "@lang('title.please select some rows')";

        // window.open("file:///D:/Hello.txt");
    </script>

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('vendors/js/vendors.min.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('vendors/js/forms/extended/maxlength/bootstrap-maxlength.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('vendors/js/forms/toggle/bootstrap-switch.min.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('vendors/js/forms/toggle/switchery.min.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('vendors/js/ui/headroom.min.js') }}"></script>
    {{-- ************** END VENDOR JS ************** --}}

    {{-- ************** START FONTAWESOME JS ************** --}}
    <script type="text/javascript" src="{{ assetHelper('js/scripts/fontawesome-all.min.js') }}"></script>
    {{-- ************** START FONTAWESOME JS ************** --}}

    {{-- ************** START MODERN JS ************** --}}
    <script type="text/javascript" src="{{ assetHelper('js/core/app-menu.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('js/scripts/customizer.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('js/scripts/forms/switch.js') }}"></script>
    {{-- ************** END MODERN JS ************** --}}

    {{-- ************** START SWEETALERT JS ************** --}}
    @include('sweetalert::alert')
    {{-- ************** END SWEETALERT JS ************** --}}


    {{-- ************** START CUSTOM JS ************** --}}
    <script type="text/javascript" src="{{ assetHelper('customs/js/preview-file.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('customs/js/public-functions.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('customs/js/email-notification.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('customs/js/script.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('customs/js/check-offline.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('customs/js/lock-page.js') }}"></script>
    {{-- <script type="text/javascript" src="https://js.pusher.com/7.0/pusher.min.js"></script> --}}
    {{-- <script type="text/javascript" src="{{ assetHelper('customs/js/pusher.js') }}"></script> --}}
    {{-- ************** END CUSTOM JS ************** --}}

    @yield('script')
    @stack('script')

    <script type="text/javascript">
        $(function() {
            if ($('.swal2-icon-success').length || "{{ session()->has('success') }}") playAudio('success');
            if ($('.swal2-icon-error').length || "{{ session()->has('failed') }}" || "{{ session()->has('warning') }}" || "{{ session()->has('error') }}") playAudio('warning');

            $('.has-sub').filter(function(){
                if ($.trim($(this).find('.menu-content').text()).length == 0) $(this).remove();
            });

            $('.has-sub').filter(function(){
                if ($.trim($(this).find('.menu-content').text()).length == 0) $(this).remove();
            });


            setInterval(function() { $('body').find('.remove-hidden-element').remove(); }, 1000);

            $(`li[data-route="{{ request()->route()->action['as'] }}"]`).addClass('active').closest('.has-sub').addClass('active open');
        });
    </script>

    @php session()->forget(['success', 'failed', 'error', 'info', 'warning']); @endphp
</body>

</html>
