<div class="card mb-0">
    <form action="{{ routeHelper('commands.command.info', ['command' => $command, 'args' => $args]) }}" method="post" class="bg-dark p-1 text-left" dir="ltr">
        <button type="submit" class="btn btn-info btn-sm load-command-info">
            <i class="fas fa-sign-out"></i> Back
        </button>
    </form>

    <div class="card-body" style="background: #323A42; font-size: 14px; padding: 15px; direction: ltr; text-align: left;">
        <pre style="background: #323A42; color: #fff;"><p>Artisan Command Output:</p>{{ trim(trim($artisan_output,'"')) }}</pre>
    </div>
</div>

