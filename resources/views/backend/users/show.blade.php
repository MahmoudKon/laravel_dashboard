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
                    <th>
                        <a href="{{ routeHelper('users.edit', $row->id) }}" data-toggle="tooltip" data-original-title="Edit User Details">
                            {{ $row->name }}
                        </a>
                    </th>
                </tr>
                <tr>
                    <th>@lang('inputs.email')</th>
                    <th>{{ $row->email }}</th>
                </tr>
                <tr>
                    <th>@lang('menu.department')</th>
                    <th>
                        @if($row->department_id)
                            <a href="{{ routeHelper('departments.edit', $row->department_id) }}" data-toggle="tooltip" data-original-title="Edit Department Details">
                                {{ $row->department->title }}
                            </a>
                        @endif
                    </th>
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
