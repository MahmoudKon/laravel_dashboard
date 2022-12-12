<div class="col-md-3">
    <div class="rounded border border-secondary border-1 mb-2">
        <code class="d-block text-center w-100">php artisan {{ $command->name }}</code>
        <p class="px-1">{{ $command->description }}</p>
        <form action="{{ routeHelper('commands.call') }}" class="call-command-form" method="POST">
            @csrf
            <input type="hidden" name="command" id="hidden_cmd" value="{{ $command->name }}">
            <div class="input-group">
                <div class="input-group-prepend">
                    <button type="submit" class="btn btn-primary btn-sm">Run </button>
                </div>
                <input type="text" name="args" autofocus class="form-control input-sm" placeholder="additional_args">
            </div>
        </form>
    </div>
</div>
