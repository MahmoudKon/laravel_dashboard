<div class="col-md-6">
    <div class="mb-5 box-shadow-1">
        <div class="card-header {{ $info['color'] }} min-h-50px">
            <h3 class="card-title text-white text-uppercase m-auto">{{ $info['title'] }}</h3>
        </div>
        <div class="card-body">
            @foreach ($info['commandes'] as $command => $command_info)
                <form method="post" action="{{ routeHelper('simulate.command', $command) }}" class="mb-1">
                    @csrf
                    <button type="submit" class="btn {{ $command_info['color'] }} m-auto mb-5 d-block w-100">{{ $command_info['title'] }}</button>
                </form>
            @endforeach
        </div>
    </div>
</div>

