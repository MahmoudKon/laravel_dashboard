@if ($announcement)
    <div class="card m-0" style="position: fixed; bottom: 0; width: 100%; text-align: center; background-image: url({{ asset($announcement->image) }})">
        <a href="{{ $announcement->url }}" target="{{ $announcement->open_type ? '_blank' : '' }}">
            <div class="card-body">
                <h4 class="card-title">{{ $announcement->id }} - {{ $announcement->title }}</h4>
                <p class="card-text">{!! $announcement->desc !!}</p>
            </div>
        </a>
    </div>
@endif
