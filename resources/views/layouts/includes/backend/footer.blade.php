    {{-- START FOOTER --}}
    <footer class="footer footer-static footer-light navbar-border navbar-shadow" style="position: relative; z-index: 1;">

        <div class="text-center">
            @foreach ($social_medias as $social_media_id => $social_media_btn)
                {!! $social_media_btn !!}
            @endforeach
        </div>

        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
            <span class="float-md-left d-block d-md-inline-block">
                Copyright &copy; {{ date('Y') }}
                <a class="text-bold-800 grey darken-2" target="_blank">{{ getSettingKey('site_name', env('APP_NAME')) }}</a>
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
        var notificationAudio = "{{ asset($notificationAudio) }}"; // Notification audio from setting or from defualt value
        var successAudio = "{{ asset($successAudio) }}"; // Success audio from setting or from defualt value
        var warrningAudio = "{{ asset($warrningAudio) }}";  // Warring or error audio from setting or from defualt value
        var RUN_SOUND = true;
        var SWAL_TITLE = "@lang('title.are you sure')";
        var SWAL_MESSAGE = "@lang('title.you wont be able to revert this')";
        var SWAL_DELETE_BUTTON = "@lang('buttons.yes delete')";
        var SWAL_CANCEL_BUTTON = "@lang('buttons.cancel')";
        var SWAL_FAILED_TITLE = "@lang('title.please select some rows')";
        const AUTH_USER_ID = {{ auth()->id() }};
        const APP_LOCALE = '{{ app()->getLocale() }}';
    </script>

    <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('build/js/main.js') }}"></script>

    {{-- ************** START SWEETALERT JS ************** --}}
    @include('sweetalert::alert')
    {{-- ************** END SWEETALERT JS ************** --}}

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

            $(`li[data-route="{{ request()->route()->action['as'] }}"]`).addClass('active').closest('.has-sub').addClass('active open');

            $('#page-loading-animation').fadeOut(350, function() { $(this).remove(); });
        });
    </script>

    @if (Route::has('messenger'))
        <script>
            $(function() {
                let new_message_remove_time = null;
                let new_message_element = $('#all-unread-messages');

                window.Echo.private(`new-message.{{ auth()->id() }}`)
                    .listen('{{ config("messenger.event-name") }}', (data) => {
                        let counter = Number.parseInt(new_message_element.text());

                        new_message_element.text(counter+1).attr('data-original-title', data.message.user.name).attr('data-content', data.message.message).click();
                        if (new_message_remove_time) clearTimeout(new_message_remove_time);

                        new_message_remove_time = setTimeout(() => {
                            $('body').find(`#${new_message_element.attr('aria-describedby')}`).remove();
                            new_message_element.click().removeAttr('data-original-title').removeAttr('data-content').removeAttr('aria-describedby');
                        }, 3000);

                        sound = true;
                        playAudio();
                    });

                window.Echo.join(`chat`).listenForWhisper('unread-count', (e) => {
                            if ({{ auth()->id() }} != e.auth_id) return;
                                $('#all-unread-messages').text(e.count)
                        });
            });
        </script>
    @endif
</body>

</html>
