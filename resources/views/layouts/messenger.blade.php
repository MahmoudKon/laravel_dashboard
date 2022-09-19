
<!DOCTYPE html>
<html lang="en">
    <!-- Head -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, shrink-to-fit=no, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Messenger</title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ assetHelper('/', 'messenger/images/icon.png') }}" type="image/x-icon">

        <!-- Template CSS -->
        <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/fontawesome-all.min.css') }}">
        <link rel="stylesheet" href="{{ assetHelper('/', 'messenger') }}/css/template.dark.bundle.css">
        <link rel="stylesheet" href="{{ assetHelper('/', 'messenger') }}/css/style.css">
        {{-- <link rel="stylesheet" href="{{ assetHelper('/', 'messenger') }}/css/template.bundle.css"> --}}
        {{-- <link rel="stylesheet" href="{{ assetHelper('/', 'messenger') }}/css/template.dark.bundle.css" media="(prefers-color-scheme: dark)"> --}}

    <body>
        <!-- Layout -->
        <div class="layout overflow-hidden">
            @yield('content')
        </div>
        <!-- Layout -->

        @include('messenger.modals')

        <!-- Scripts -->
        <script>
            const AUTH_USER_ID = {{ auth()->id() }};
            audio = new Audio(`{{ asset($notificationAudio) }}`);
        </script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ assetHelper('/', 'messenger') }}/js/jquery-3.6.1.min.js"></script>
        <script type="text/javascript" src="{{ assetHelper('/', 'messenger') }}/js/vendor.js"></script>
        <script type="text/javascript" src="{{ assetHelper('/', 'messenger') }}/js/template.js"></script>
        <script type="text/javascript" src="{{ assetHelper('/', 'messenger') }}/js/moment.js"></script>
        <script type="text/javascript" src="{{ assetHelper('/', 'messenger') }}/js/messenger.js"></script>
    </body>
</html>
