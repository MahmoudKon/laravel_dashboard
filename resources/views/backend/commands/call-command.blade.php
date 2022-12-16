<div class="card mb-0" dir="ltr" style="text-align: left">
    <form action="{{ routeHelper('commands.call') }}" method="POST" class="call-command-form">
        @csrf
        <input type="hidden" name="command" id="hidden_cmd" value="{{ $command['name'] }}">

        <div class="card-header bg-dark text-center">
            <h3 class="card-title text-white"> <i class="fa-solid fa-terminal"></i> <b> php artisan {{ $command['name'] }} </b> </h3>
        </div>

        <div class="card-body">
            <p> {{ $command['description'] }} </p>

            @include('backend.commands.includes.table')
        </div>

        <div class="card-footer text-center">
            <div class="input-group justify-content-center">
                <div class="input-group-prepend">
                    <button class="btn btn-sm btn-info" disabled> <i class="fa-solid fa-terminal"></i> php artisan {{ $command['name'] }} </button>
                </div>

                @if ( count( $command['arguments'] ) || count( $command['options'] ) )
                    <input type="text" name="args" value="{{ $args ?? '' }}" {{ count( $command['arguments'] ) ? 'required' : '' }} autofocus class="form-control input-sm" placeholder="Type Arguments Or Options">
                @endif

                <div class="input-group-prepend">
                    <button type="submit" class="btn btn-primary btn-sm"> <i class="fa-solid fa-bolt-lightning"></i> Run </button>
                </div>
            </div>
        </div>
    </form>
</div>
