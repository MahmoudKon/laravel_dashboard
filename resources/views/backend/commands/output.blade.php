@if(isset($artisan_output) && $artisan_output)
    <pre style="background: #323A42; color: #fff; padding: 15px; padding-bottom: 0px; direction: ltr; text-align: left;"><p>Artisan Command Output:</span>{{ trim(trim($artisan_output,'"')) }}</pre>
@endif
