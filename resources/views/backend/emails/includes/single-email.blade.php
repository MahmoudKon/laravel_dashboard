@forelse ($emails as $index => $email)
    <a href="{{ routeHelper('emails.index')."?email=$email->id" }}" class="single-email" data-id="{{ $email->id }}">
        <div class="media {{ $email->isSeen() ? "" : "unseen-email" }}">
            <div class="media-left align-self-center">
                <span class="avatar avatar-md">
                    @if ($email->notifier && $email->notifier->image)
                        <img src="{{ asset($email->notifier->image) }}" class="rounded-circle" width="55px">
                    @else
                        <span class="media-object rounded-circle text-circle bg-{{ randomColor( getFirstChars($email->notifier?->name ?? "System") ) }}">{{ getFirstChars($email->notifier?->name ?? "System") }}</span>
                    @endif
                </span>
            </div>

            <div class="media-body">
                <h6 class="media-heading">{{ $email->notifier?->name }}</h6>
                <p class="notification-text font-small-3 text-muted">{{ $email->subject }}</p>

                <small>
                    <time class="media-meta text-muted">{{ $email->created_at }}</time>
                </small>
            </div>
        </div>
    </a>
@empty
    <h5 class="text-center">No Emails</h5>
@endforelse
