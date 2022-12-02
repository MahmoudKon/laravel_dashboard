<div class="mb-2 d-flex justify-content-between">
    @if (canUser('announcements-edit'))
        <a href="{{ routeHelper('announcements.edit', $row) }}" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> @lang('buttons.edit') </a>
    @endif
</div>

<div class="d-flex">
    <div class="table-responsive w-100">
        <table class="table table-bordered mb-0">
            <tbody>
                <tr>
                    <td style="width: 200px"> <b> # </b> </td>
                    <td> {{ $row->id }} </td>
                </tr>
                <tr>
                    <td> <b> @lang('inputs.title') </b> </td>
                    <td> {{ $row->title }} </td>
                </tr>
                <tr>
                    <td> <b> @lang('inputs.creator') </b> </td>
                    <td>{{ $row->creator->name }}</td>
                </tr>
                <tr>
                    <td> <b> @lang('inputs.start_date') </b> </td>
                    <td> {{ $row->formatDate('start_date') }} </td>
                </tr>
                <tr>
                    <td> <b> @lang('inputs.end_date') </b> </td>
                    <td> {{ $row->formatDate('end_date') }} </td>
                </tr>
                <tr>
                    <td> <b> @lang('inputs.count days') </b> </td>
                    <td> {{ $row->days }} Days </td>
                </tr>
                <tr>
                    <td> <b> @lang('inputs.open_type') </b> </td>
                    <td>
                        <x-toggle-column id="{{ $row->id }}" column='open_type' value="{{ $row->open_type }}" />
                    </td>
                </tr>
                <tr>
                    <td> <b> @lang('inputs.active') </b> </td>
                    <td>
                        <x-toggle-column id="{{ $row->id }}" column='active' value="{{ $row->active }}" />
                    </td>
                </tr>
                <tr>
                    <td> <b> @lang('inputs.url') </b> </td>
                    <td> <a href='{{ $row->url }}' target="_blank" class="btn btn-sm btn-link"> {{ $row->url }} </a> </td>
                </tr>
                <tr>
                    <td> <b> @lang('inputs.desc') </b> </td>
                    <td>{!! $row->desc !!}</td>
                </tr>
            </tbody>
        </table>
    </div>

    @if ($row->image)
        <img src="{{ asset($row->image) }}" class="img-tdumbnail preview-modal-image mx-1">
    @endif
</div>
