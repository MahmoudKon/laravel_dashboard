@forelse ($users as $user)

    <a href="{{ route('conversation.user.messages', $user) }}" class="card border-0 text-reset user-room">
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
                    <div class="d-flex align-items-center my-3">
                        <h5 class="me-auto mb-0">{{ $user->name }}</h5>
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
