<div class="container h-100">

    <div class="d-flex flex-column h-100 position-relative">
        @include('messenger.chat-window.header')

        <!-- Chat: Content -->
        <div class="chat-body hide-scrollbar flex-1 h-100">
            <div class="chat-body-inner" style="padding-bottom: 45px">
                <div class="py-6 py-lg-12" data-conversation-user='{{ $user->id }}'></div>
            </div>
        </div>
        <!-- Chat: Content -->

        @include('messenger.chat-window.footer')
    </div>

</div>
