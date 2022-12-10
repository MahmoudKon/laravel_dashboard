<div class="d-flex">
    <img src="{{ asset($row->image) }}" class="img-thumbnail preview-modal-image">

    <div class="table-responsive w-100 ml-2">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>@lang('inputs.username')</th>
                    <th>
                        <a href="{{ routeHelper('clients.edit', $row->id) }}" data-toggle="tooltip" data-original-title="Edit User Details">
                            {{ $row->username }}
                        </a>
                    </th>
                </tr>
                <tr>
                    <th>@lang('inputs.email')</th>
                    <th>{{ $row->email }}</th>
                </tr>
                <tr>
                    <th>@lang('inputs.phone')</th>
                    <th>{{ $row->phone }}</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
