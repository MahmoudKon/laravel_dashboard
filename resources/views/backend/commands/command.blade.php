<div class="col-md-3">
    <form action="{{ routeHelper('commands.command.info', $command->name) }}" method="post">
        <div class="rounded border border-secondary border-1 mb-2 load-command-info cursor-pointer">
            @csrf
            <code class="d-block text-center w-100">php artisan {{ $command->name }}</code>
            <p class="px-1">{{ $command->description }}</p>
        </div>
    </form>
</div>
