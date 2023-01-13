<div class="card-header bg-primary">
    <h4 class="card-title white">
        @lang('title.show lang files', ['lang' => $row->short_name]) <i class="{{ $row->icon }} mx-1"></i>
    </h4>
</div>

<div class="card-body">
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <td>@lang('inputs.file_name')</td>
                <td>@lang('inputs.translations_count')</td>
                <td>@lang('inputs.file_size')</td>
                <td style="width:50px">@lang('buttons.show')</td>
            </tr>
        </thead>

        <tbody>
            @foreach ($files as $file)
                <tr>
                    <td>{{ $file['name'] }}</td>
                    <td>{{ $file['count'] }}</td>
                    <td>{{ $file['size'] }}</td>
                    <td>
                        <a href="{{ routeHelper('languages.trans', [$row, $file['name']]) }}" class="btn btn-sm btn-primary"> <i class="fas fa-eye"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
