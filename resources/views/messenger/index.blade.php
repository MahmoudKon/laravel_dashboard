@extends('layouts.messenger')

@section('content')
    @include('layouts.includes.messenger.nav')

    @include('layouts.includes.messenger.side')

    <!-- Chat -->
    <main class="main is-visible" id="load-chat" data-dropzone-area="">
        @include('layouts.includes.messenger.empty')
    </main>
    <!-- Chat -->

@endsection
