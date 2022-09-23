<!-- Chat: Header -->
<div class="chat-header border-bottom py-4 py-lg-7">
    <div class="row align-items-center">

        <!-- Mobile: close -->
        <div class="col-2 d-xl-none">
            <a class="icon icon-lg text-muted" href="#" data-toggle-chat="">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-chevron-left">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </a>
        </div>
        <!-- Mobile: close -->

        <!-- Content -->
        <div class="col-8 col-xl-12">
            <div class="row align-items-center text-center text-xl-start">
                <!-- Title -->
                <div class="col-12 col-xl-6">
                    <div class="row align-items-center gx-5">
                        <div class="col-auto">
                            <a href="{{ route('user.details', $user) }}" data-bs-toggle="modal" data-bs-target="#modal-user-profile" class="avatar d-none d-xl-inline-block {{ $user->isOnline() ? 'avatar-online' : '' }} online-status-{{ $user->id ?? '' }}">
                                <img class="avatar-img" src="{{ asset($user->avatar) }}" alt="" style="height: 44px;">
                            </a>
                        </div>

                        <div class="col overflow-hidden">
                            <h5 class="text-truncate">{{ $user->name }}</h5>
                            <p class="text-truncate online-status-{{ $user->id ?? '' }}-text">{{ $user->isOnline() ? 'Online' : 'Offline' }}</p>
                        </div>
                    </div>
                </div>
                <!-- Title -->
            </div>
        </div>
        <!-- Content -->

    </div>
</div>
<!-- Chat: Header -->
