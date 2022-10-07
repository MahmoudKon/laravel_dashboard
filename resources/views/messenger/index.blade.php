<!DOCTYPE html>
<html lang="en">
    <!-- Head -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Messenger</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('/') }}assets/messenger/images/icon.png" type="image/x-icon">

        <!-- Template CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <link rel="stylesheet" href="{{ asset('/') }}assets/messenger/css/template.bundle.dark.css">
        <link rel="stylesheet" href="{{ asset('/') }}assets/messenger/css/template.dark.bundle.css" media="(prefers-color-scheme: dark)">
        <link rel="stylesheet" href="{{ asset('/') }}assets/messenger/css/style.css">

    <body>
        <!-- Layout -->
        <div class="layout overflow-hidden">
            @include('messenger.includes.nav')

            @include('messenger.includes.side')

            <div class="main" id="load-chat" data-dropzone-area="">
                @include('messenger.includes.empty')
            </div>

        </div>
        <!-- Layout -->

        @include('messenger.includes.modals')

        {{-- @vite(['resources/js/app.js']) --}}
        <script type="text/javascript" src="{{ asset('/') }}js/app.js"></script>
        <script type="text/javascript">
            const AUTH_USER_ID    = {{ auth()->id() }};
            const audio           = new Audio(`{{ asset(config('messenger.audio_path')) }}`);
            const IMG_COLUMN_NAME = "{{ config('messenger.image_column') }}";
            const APPEND_URL      = "{{ config('messenger.img_url') }}";
            const DEFAULT_IMG     = "{{ config('messenger.default_image') }}";
            const EVENT           = "{{ config('messenger.event-name') }}";
            Pusher.logToConsole   = "{{ config('messenger.pusher_log') }}";
        </script>
        <script type="text/javascript" src="{{ asset('/') }}assets/messenger/js/jquery-3.6.1.min.js"></script>
        <script type="text/javascript" src="{{ asset('/') }}assets/messenger/js/vendor.js"></script>
        <script type="text/javascript" src="{{ asset('/') }}assets/messenger/js/template.js"></script>
        <script type="text/javascript" src="{{ asset('/') }}assets/messenger/js/moment.js"></script>
        <script type="text/javascript" src="{{ asset('/') }}assets/messenger/js/messenger.js"></script>
    </body>
</html>
