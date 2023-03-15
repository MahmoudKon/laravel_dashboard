@forelse ($users as $user)
    @php $first_conversation = $user->conversations->first(); @endphp
    @php $unread_count = $first_conversation?->unread; @endphp
    @php $user_unread_count = $first_conversation?->user_unread; @endphp
    @php $lastMessage = $first_conversation?->lastMessage; @endphp
    @php $is_seen = $user->isOnline() || $lastMessage && count($lastMessage->getAttributes()) && ($user->getAttributes()['last_seen'] >= $lastMessage->getAttributes()['created_at']); @endphp

    <a href="{{ route('conversation.user.messages', $user) }}" class="card conversation-item border-0 text-reset user-room" data-user-id="{{ $user->id }}">

        <form action="{{ route('conversation.destroy', $first_conversation->id) }}" method="post" class="remove-conversation">
            @csrf @method('DELETE')
            <button type="submit">
                <i class="fa fa-times text-danger" title="Remove Conversation"></i>
            </button>
        </form>

        <div class="card-body">
            <div class="row gx-5">
                <div class="col-auto">
                    <div class="avatar {{ $user->isOnline() ? 'avatar-online' : '' }} online-status-{{ $user->id }}">
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="avatar-img">
                        @else
                            <span class="draw-avatar" title="{{ $user->name }}" style="background-color: #{{ substr(md5(rand()), 0, 6) }}">{{ ucfirst($user->name[0]) }}</span>
                        @endif
                    </div>
                </div>

                <div class="col">
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="me-auto mb-0">{{ $user->name }}</h5>
                        <span class="text-muted extra-small ms-2 message-time">
                            {{ $lastMessage?->created_at }}
                        </span>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="line-clamp me-auto">
                            <span class="user-typing d-none"> is typing<span class="typing-dots"><span>.</span><span>.</span><span>.</span></span> </span>
                            <span class="last-message" id="last-message-id-{{ $lastMessage->id ?? '' }}">
                                @if ($lastMessage)
                                    @php $user_id = $lastMessage->users->pluck('pivot.deleted_at', 'pivot.user_id')->toArray(); @endphp
                                    @if ((isset($user_id[auth()->id()]) && $user_id[auth()->id()]) || ! array_key_exists(auth()->id(), $user_id))
                                        <span class="text-muted">{{ config('messenger.deleted_message_placeholder') }}</span>
                                    @else
                                        {{ $first_conversation->lastMessage->user_id == auth()->id() ? 'You: ' : $first_conversation->lastMessage->user->name.': ' }}
                                        @if ($first_conversation->lastMessage->type == 'text')
                                            {{ $first_conversation->lastMessage->message }}
                                        @else
                                            @php
                                                $type = explode('/', $first_conversation->lastMessage->type)[0];
                                                $type = $type == 'application' || $type == 'text' ? 'Attachment' : $type;
                                            @endphp
                                            Send {{ $type }}
                                        @endif

                                    @endif
                                @endif
                            </span>
                        </div>

                        <i class="fa-solid fa-check message-status-icons {{ $is_seen || ! $first_conversation ? 'd-none' : '' }} send-message-icon"></i>
                        <i class="fa-solid fa-check-double message-status-icons {{ ($user_unread_count !== $unread_count) && $is_seen && $user->conversations->count() ? '' : 'd-none' }} receive-message-icon"></i>
                        <i class="fa-solid fa-check-double message-status-icons text-success {{ $user_unread_count == 0 && $is_seen && $unread_count == 0 && $user->conversations->count() ? '' : 'd-none' }} read-message-icon"></i>
                        <div class="badge badge-circle bg-primary ms-5 unread-messages unread-messages-user-{{ $user->id }} {{ $unread_count ? '' : 'd-none' }}"> {{ is_int($unread_count) ? $unread_count : 0 }} </div>
                    </div>
                </div>
            </div>
        </div><!-- .card-body -->
    </a>
@empty
    <div class="card-body" id='empty-conversations'>
        <h3 class="text-center text-muted">No Conversations</h3>
    </div><!-- .card-body -->
@endforelse
