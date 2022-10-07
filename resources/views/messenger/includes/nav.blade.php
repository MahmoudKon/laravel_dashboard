<!-- Navigation -->
<nav class="navigation d-flex flex-column text-center navbar navbar-light hide-scrollbar">
    <!-- Brand -->
    <a href="{{ url('/') }}" title="Dashboard" class="d-none d-xl-block mb-6" style="font-size: 30px">
        <i class="fa fa-house"></i>
    </a>

    <a href="{{ route('user.details', auth()->id()) }}" class="nav-link p-0 mt-lg-2" data-bs-toggle="modal" data-bs-target="#modal-user-profile">
        <div class="avatar avatar-online mx-auto d-none d-xl-block">
            <img class="avatar-img" src="{{ auth()->user()->avatar }}" alt="">
        </div>
        <div class="avatar avatar-online avatar-xs d-xl-none">
            <img class="avatar-img" src="{{ auth()->user()->avatar }}" alt="">
        </div>
        <small>{{ auth()->user()->name }}</small>
    </a>

    <!-- Nav items -->
    <ul class="d-flex nav navbar-nav flex-row flex-xl-column flex-grow-1 justify-content-between justify-content-xl-center align-items-center w-100 py-4 py-lg-2 px-lg-3"
        role="tablist">

        <!-- Chats -->
        <li class="nav-item">
            <a class="nav-link active py-0 py-lg-8" id="tab-friends" href="#tab-content-friends" title="Friends" data-bs-toggle="tab" role="tab">
                <div class="icon icon-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
            </a>
        </li>

        <!-- Chats -->
        <li class="nav-item">
            <a class="nav-link py-0 py-lg-8" id="tab-chats" href="#tab-content-chats" title="Chats"
                data-bs-toggle="tab" role="tab">
                <div class="icon icon-xl icon-badged" id="open-list-chat">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-message-square">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <div class="badge badge-circle bg-primary">
                        <span id='all-unread-messages'>{{ auth()->user()->unreadMessages() }}</span>
                    </div>
                </div>
            </a>
        </li>
    </ul>
</nav>
<!-- Navigation -->
