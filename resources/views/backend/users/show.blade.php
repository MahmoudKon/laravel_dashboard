<div class="table-responsive">
    <table class="table table-bordered mb-0">
        <thead>
            <tr>
                <th>@lang('inputs.finger-print-id')</th>
                <th>{{ $row->finger_print_id }}</th>
                <th rowspan="6">
                    <img src="{{ asset($row->image) }}" class="img-thumbnail w-100">
                </th>
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
                <th>@lang('inputs.behalf')</th>
                <th>
                    @if($row->behalf_id)
                        <a href="{{ routeHelper('users.show', $row->behalf_id) }}" data-toggle="tooltip" data-original-title="Show User Details">
                            {{ $row->behalf->name }}
                        </a>
                    @endif
                </th>
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
                <th>@lang('menu.aggregator')</th>
                <th>{{ $row->aggregator?->title }}</th>
            </tr>
            <tr>
                <th>@lang('inputs.annual-credit')</th>
                <th>{{ $row->annual_credit }}</th>
            </tr>
            <tr>
                <th>@lang('inputs.salary')</th>
                <th>{{ $row->salary_per_monthly }}</th>
            </tr>
            <tr>
                <th>@lang('inputs.insurance-deduction')</th>
                <th>{{ $row->insurance_deduction }}</th>
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
