<!-- Navigation -->
<nav class="navigation d-flex flex-column text-center navbar navbar-light hide-scrollbar">
    <h3>{{ auth()->user()->name }}</h3>
    <!-- Brand -->
    <a href="index.html" title="Messenger" class="d-none d-xl-block mb-6">
        <svg version="1.1" width="46px" height="46px" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 46 46"
            enable-background="new 0 0 46 46" xml:space="preserve">
            <polygon opacity="0.7" points="45,11 36,11 35.5,1 " />
            <polygon points="35.5,1 25.4,14.1 39,21 " />
            <polygon opacity="0.4" points="17,9.8 39,21 17,26 " />
            <polygon opacity="0.7" points="2,12 17,26 17,9.8 " />
            <polygon opacity="0.7" points="17,26 39,21 28,36 " />
            <polygon points="28,36 4.5,44 17,26 " />
            <polygon points="17,26 1,26 10.8,20.1 " />
        </svg>

    </a>

    <!-- Nav items -->
    <ul class="d-flex nav navbar-nav flex-row flex-xl-column flex-grow-1 justify-content-between justify-content-xl-center align-items-center w-100 py-4 py-lg-2 px-lg-3"
        role="tablist">

        <!-- New chat -->
        <li class="nav-item d-none">
            <a class="nav-link py-0 py-lg-8" id="tab-create-chat" href="#tab-content-create-chat" title="Create chat"
                data-bs-toggle="tab" role="tab">
                <div class="icon icon-xl" id="create-conversation">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-edit-3">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                    </svg>
                </div>
            </a>
        </li>

        <!-- Chats -->
        <li class="nav-item">
            <a class="nav-link py-0 py-lg-8" id="tab-friends" href="#tab-content-friends" title="Friends" data-bs-toggle="tab" role="tab">
                <div class="icon icon-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
            </a>
        </li>

        <!-- Chats -->
        <li class="nav-item">
            <a class="nav-link active py-0 py-lg-8" id="tab-chats" href="#tab-content-chats" title="Chats"
                data-bs-toggle="tab" role="tab">
                <div class="icon icon-xl icon-badged" id="open-list-chat">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-message-square">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <div class="badge badge-circle bg-primary">
                        <span id='conversation-count'>{{ auth()->user()->conversations()->count() }}</span>
                    </div>
                </div>
            </a>
        </li>

        <!-- Profile -->
        <li class="nav-item">
            <a href="{{ url("user/".auth()->id()."/details") }}" class="nav-link p-0 mt-lg-2" data-bs-toggle="modal" data-bs-target="#modal-user-profile">
                <div class="avatar avatar-online mx-auto d-none d-xl-block">
                    <img class="avatar-img" src="{{ auth()->user()->image }}" alt="">
                </div>
                <div class="avatar avatar-online avatar-xs d-xl-none">
                    <img class="avatar-img" src="{{ auth()->user()->image }}" alt="">
                </div>
            </a>
        </li>
    </ul>
</nav>
<!-- Navigation -->
