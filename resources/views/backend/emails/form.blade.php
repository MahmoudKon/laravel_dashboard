<div class="form-group">
    <label class="control-label required">@lang('inputs.to')</label><br>
    <i class="text-info"> <small>you can select multi emails</small> </i>
    <div class="controls">
        <select class="form-control select2" data-placeholder="Choose a Send To" id="to_select" name="to[]" multiple required>
        @foreach ($users as $email)
            <option value="{{ $email }}" @selected($email == env('TEST_EAMIL'))> {{ $email }} </option>
        @endforeach
        </select>
    </div>
    <x-validation-error input='to' />
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
    <x-validation-error input='cc' />
</div>

<div class="form-group">
    <label class="control-label required">@lang('inputs.subject')</label><br>
    <div class="controls">
        <input type="text" class="form-control" minlength="3" name="subject" placeholder="Email Subject" value="{{ env('TEST_SUBJECT') }}">
    </div>
    <x-validation-error input='subject' />
</div>


<div class="form-group">
    <label class="required">@lang("inputs.attachments")</label>
    <div class="input-group">
        <div class="custom-file">
            <input type="file" name="attachments[]" multiple class="custom-file-input cursor-pointer form-control">
            <label class="custom-file-label" for="upload-image"><i class="fa fa-upload"></i> Choose file</label>
        </div>
    </div>
    <x-validation-error input='attachments' />
</div>


@include('backend.includes.components.advanced_text', ['required' => 'required', 'name' => 'body', 'value' => env('Test_BODY')])
