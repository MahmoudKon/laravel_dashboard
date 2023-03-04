<div class="mb-2 d-flex justify-content-between">
    @if (canUser('users-edit'))
        <a href="{{ routeHelper('users.edit', $row) }}" class="btn btn-sm btn-primary {{ $use_button_ajax ? 'show-modal-form' : '' }}"> <i class="fa fa-edit"></i> @lang('buttons.edit') </a>
    @endif
</div>

<div class="d-flex">
    <img src="{{ asset($row->image) }}" class="img-thumbnail preview-modal-image">

    <div class="table-responsive w-100 ml-2">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>@lang('inputs.code')</th>
                    <th>{{ $row->code }}</th>
                </tr>
                <tr>
                    <th>@lang('inputs.name')</th>
                    <th>{{ $row->name }}</th>
                </tr>
                <tr>
                    <th>@lang('inputs.email')</th>
                    <th>{{ $row->email }}</th>
                </tr>
                <tr>
                    <th>@lang('menu.roles')</th>
                    <th>
                        @forelse ($row->roles as $role)
                            {{ $role->name }} {{ $loop->last ? '' : ' | ' }}
                        @empty
                            No Roles
                        @endforelse
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>
