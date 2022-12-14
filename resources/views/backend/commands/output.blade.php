<div class="card">
    <div class="card-header bg-dark">
        <div class="card-title text-center">
            <form action="{{ routeHelper('commands.command.info', $command) }}" method="post" class="d-inline m-auto">
                <button type="submit" class="btn btn-info load-command-info ">Back</button>
            </form>
        </div>
    </div>

    <div class="card-body" style="background: #323A42; font-size: 14px; padding: 15px; direction: ltr; text-align: left;">
        <pre style="background: #323A42; color: #fff;"><p>Artisan Command Output:</p>{{ trim(trim($artisan_output,'"')) }}</pre>
    </div>
</div>

