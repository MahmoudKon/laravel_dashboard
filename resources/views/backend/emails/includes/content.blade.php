
<div class="email-app-options card-body">
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="btn-group" role="group" aria-label="Basic example">
                <form action="{{ routeHelper('emails.destroy', $email) }}" method="POST" class="form-destroy">
                    {{ csrf_field() }}
                    @method('delete')
                    <button type="submit" class="btn btn-outline-danger dropdown-item delete">
                        <i class="ft-trash-2"></i> @lang('buttons.delete')
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="email-app-title card-body">
    <h3 class="list-group-item-heading">
        <div class="d-flex">

            @if ($email->notifier?->image)
                <img src="{{ asset($email->notifier->image) }}" class="rounded-circle" width="100px" height="100px">
            @else
                <span class="avatar avatar-md" style="width:100px; height: 100px; line-height: 100px">
                    <span class="d-block w-100 h-100 media-object rounded-circle text-circle bg-{{ randomColor( getFirstChars($email->notifier->name) ) }}" style="font-size: 40px">{{ getFirstChars($email->notifier->name) }}</span>
                </span>
            @endif

            <div class="align-self-center px-2">
                <p>{{ $email->notifier->name }}</p>
                <hr>
                <p>{{ $email->subject }}</p>
            </div>

        </div>
    </h3>
    <p class="list-group-item-text">
        @if ($email->to)
            <p><b>@lang('inputs.to') :</b> {{ str_replace(',', ' | ', $email->to) }} </p>
        @endif

        @if ($email->cc)
            <p><b>@lang('inputs.cc') :</b> {{ str_replace(',', ' | ', $email->cc) }} </p>
        @endif
    </p>
</div>


@if ($email->attachments->count())
    <div class="d-flex mt-2">
        @foreach ($email->attachments as $attachment)
            <div class="input-group mx-1">
                <div class="input-group-prepend">
                    <a class="btn btn-secondary input-group-text" href="{{ asset($attachment->attachment) }}" download="{{ $attachment->info->name }}"> <i class="fa fa-download"></i> </a>
                </div>
                <input type="text" class="form-control" value="{{ $attachment->info->name }}" readonly>
            </div>
        @endforeach
    </div>
    <hr>
@endif


<div class="media-list">
    <div class="email-app-text-action card-body">
        {!! $email->body !!}

        @if ($view)
            {!! $view !!}
        @endif
    </div>
</div>
