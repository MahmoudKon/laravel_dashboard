<div class="col-md-3">
    <div class="command" data-command="{{ $command->name }}">
        <code>php artisan {{ $command->name }}</code>
        <small>{{ $command->description }}</small><i class="voyager-terminal"></i>
        <form action="{{ routeHelper('commands.index') }}" class="cmd_form" method="POST">
            @csrf
            <input type="text" name="args" autofocus class="form-control" placeholder="additional_args">
            <input type="submit" class="btn btn-primary btn-sm" value="Run">
            <input type="hidden" name="command" id="hidden_cmd" value="{{ $command->name }}">
        </form>
    </div>
</div>
