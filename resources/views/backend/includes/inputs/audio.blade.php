<div class="form-group">
    <label class="required">@lang('inputs.audio')</label>
    <input type="file" class="form-control" name="{{ $column_name ?? 'data' }}" accept="audio/*">
    <small class="warning"><i class="fa fa-warning"></i> Only <b>mp3</b> Extentions <i class="fa fa-warning"></i></small>
    <x-validation-error input='{{ $column_name ?? 'data' }}' />
</div>

@if ($row)
    {!! $row->getHtmlData() !!}
@endif
