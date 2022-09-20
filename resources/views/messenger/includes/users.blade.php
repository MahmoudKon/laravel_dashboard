@forelse ($users as $user)
    @php $unread_count = $user->conversations->first()?->unread; @endphp
    @php $user_unread_count = $user->conversations->first()?->user_unread; @endphp

    <a href="{{ route('conversation.user.messages', $user) }}" class="card conversation-item border-0 text-reset user-room" data-user-id="{{ $user->id }}">
        <div class="card-body">
            <div class="row gx-5">
                <div class="col-auto">
                    <div class="avatar {{ $user->isOnline() ? 'avatar-online' : '' }} online-status-{{ $user->id }}">
                        <img src="{{ asset($user->image) }}" alt="#" class="avatar-img">
                    </div>
                </div>

                <div class="col">
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="me-auto mb-0">{{ $user->name }}</h5>
                        <span class="text-muted extra-small ms-2 message-time">
                            {{ $user->conversations->first()?->lastMessage->created_at }}
                        </span>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="line-clamp me-auto">
                            <span class="user-typing d-none"> is typing<span class="typing-dots"><span>.</span><span>.</span><span>.</span></span> </span>
                            <span class="last-message">
                                @if ($user->conversations->first()?->lastMessage)
                                    {{ $user->conversations->first()->lastMessage->user_id == auth()->id() ? 'You: ' : $user->conversations->first()->lastMessage->user->name.': ' }}
                                    @if ($user->conversations->first()->lastMessage->type == 'text')
                                        {{ $user->conversations->first()->lastMessage->message }}
                                    @else
                                        Send {{ $user->conversations->first()->lastMessage->type }}
                                    @endif
                                @endif
                            </span>
                        </div>

                        <i class="fa-solid fa-check {{ $user_unread_count && !$unread_count ? '' : 'd-none' }} unread-message-icon"></i>
                        <i class="fa-solid fa-check-double text-success {{ (!$user_unread_count && !$unread_count) && $user->conversations->count() ? '' : 'd-none' }} read-message-icon"></i>
                        <div class="badge badge-circle bg-primary ms-5 unread-messages unread-messages-user-{{ $user->id }} {{ $unread_count ? '' : 'd-none' }}"> {{ $unread_count }} </div>
                    </div>
                </div>
            </div>
        </div><!-- .card-body -->
    </a>
@empty
    <div class="card-body">
        <h3>No Users</h3>
    </div><!-- .card-body -->
@endforelse
