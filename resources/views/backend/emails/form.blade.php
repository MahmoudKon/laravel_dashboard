<div class="form-group">
    <label class="control-label required">@lang('inputs.to')</label><br>
    <i class="text-info"> <small>you can select multi emails</small> </i>
    <div class="controls">
        <select class="form-control select2" data-placeholder="Choose a Send To" id="to_select" name="to[]" multiple required>
        @foreach ($users as $email)
            <option value="{{ $email }}"> {{ $email }} </option>
        @endforeach
        </select>
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => "to"])
</div>

<div class="form-group">
    <label class="control-label">@lang('inputs.cc')</label><br>
    <i class="text-info"> <small>you can select multi emails</small> </i>
    <div class="controls">
        <select class="form-control select2" data-placeholder="Choose a Send To" id="cc_select" name="cc[]" multiple>
        @foreach ($users as $email)
            <option value="{{ $email }}"> {{ $email }} </option>
        @endforeach
        </select>
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => "cc"])
</div>

<div class="form-group">
    <label class="control-label required">@lang('inputs.subject')</label><br>
    <div class="controls">
        <input type="text" class="form-control" minlength="3" name="subject" placeholder="Email Subject">
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => "subject"])
</div>

@include('backend.includes.components.advanced_text', ['required' => 'required', 'name' => 'body'])
