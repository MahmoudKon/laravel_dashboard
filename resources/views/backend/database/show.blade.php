<div class="card-header bg-primary">
    <h4 class="card-title white text-capitalize text-center">
        <i class="fa fa-info-circle"></i><span class="mx-1">{{ str_replace('_', ' ', $table) }} Table</span>
    </h4>
</div>

@if ( count($row['columns']) )
    <div class="card-content collpase show">
        <h4 class="py-1 text-center bg-blue-grey bg-darken-1 text-white"> <i class="fas fa-list"></i> Columns </h4>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-hover table-bordered mb-0">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Field</th>
                            <th scope="col">Type</th>
                            <th scope="col">Null</th>
                            <th scope="col">Key</th>
                            <th scope="col">Default</th>
                            <th scope="col">Extra</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($row['columns'] as $column)
                            <tr>
                                <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                <td>{{ $column->Field }}</td>
                                <td>{{ $column->Type }}</td>
                                <td class="text-center">{{ $column->Null }}</td>
                                <td class="text-center">
                                    @if ( $column->Key == 'PRI' )
                                        <i class="fa-solid fa-key text-warning" title="Primary Key"></i>
                                    @endif

                                    @if ( $column->Key == 'UNI' )
                                        <i class="fa-solid fa-key text-success" title="Unique Key"></i>
                                    @endif

                                    @if ( $column->Key == 'MUL' || isset( $row['relations'][$column->Field] ) )
                                        <i title="Foreign Key To {{ isset( $row['relations'][$column->Field] ) ? $row['relations'][$column->Field]->fk_table : '' }}" class="fa-solid fa-key text-secondary"></i>
                                    @endif

                                    {{ $column->Key }}
                                </td>
                                <td class="text-center">{{ $column->Default }}</td>
                                <td class="text-center">{{ $column->Extra }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

@if ( count($row['relations']) )
    <div class="card-content collpase show">
        <h4 class="py-1 text-center bg-blue-grey bg-darken-1 text-white"> <i class="fa-solid fa-diagram-project"></i> Relations </h4>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-hover table-bordered mb-0">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">FK Column</th>
                            <th scope="col">Related Table</th>
                            <th scope="col">Refrence</th>
                            <th scope="col">Show</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($row['relations'] as $relation)
                            <tr>
                                <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                <td>{{ $relation->column_name }}</td>
                                <td>{{ $relation->fk_table }}</td>
                                <td class="text-center">{{ $relation->fk_column }}</td>
                                <td class="text-center">
                                    <a href='{{ routeHelper('database.show', $relation->fk_table) }}' class="btn btn-sm btn-info show-modal-form"> <i class="fas fa-eye"></i> @lang('buttons.cover') </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
