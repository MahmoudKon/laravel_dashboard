@if ($rows)
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <td style="width: 25%">@lang('inputs.key')</td>
                <td>@lang('inputs.value')</td>
                <td style="width: 70px">@lang('buttons.edit')</td>
            </tr>
        </thead>

        <tbody>
            @foreach ($rows as $key => $value)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $value }}</td>
                    <td>
                        <a href="{{ routeHelper('languages.trans.edit', [$row, $key]) }}?file={{ $file }}" class="btn btn-sm btn-success show-modal-form"> <i class="fas fa-edit"></i> </a>
                    </td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <td colspan="10">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center flex-wrap">
                            <li class="page-item {{ $rows->currentPage() == 1 ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ routeHelper('languages.show', $row) }}?page=1" aria-label="Previous">
                                    <span aria-hidden="true">« @lang('datatable.paginate.first')</span>
                                </a>
                            </li>

                            <li class="page-item {{ $rows->currentPage() == 1 ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ routeHelper('languages.show', $row) }}?page={{ $rows->currentPage() - 1 }}" aria-label="Previous">
                                    <span aria-hidden="true">@lang('pagination.previous')</span>
                                </a>
                            </li>
                            
                            @for ($i = 1; $i <= $rows->lastPage(); $i++)
                                <li class="page-item {{ $rows->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ routeHelper('languages.show', $row) }}?page={{ $i }}"> {{ $i }} </a>
                                </li>
                            @endfor
                    
                            <li class="page-item {{ $rows->currentPage() == $rows->lastPage() ? 'disabled' :'' }}">
                                <a class="page-link" href="{{ routeHelper('languages.show', $row) }}?page={{ $rows->currentPage() + 1 }}" aria-label="Next">
                                    <span aria-hidden="true">@lang('pagination.next')</span>
                                </a>
                            </li>
                    
                            <li class="page-item {{ $rows->currentPage() == $rows->lastPage() ? 'disabled' :'' }}">
                                <a class="page-link" href="{{ routeHelper('languages.show', $row) }}?page={{ $rows->lastPage() }}" aria-label="Next">
                                    <span aria-hidden="true">@lang('datatable.paginate.last') »</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </td>
            </tr>
        </tfoot>
    </table>
@else
    <p class="alert alert-warning text-center">
        @lang('title.the language does not have translation files', ['lang' => $row->native])
    </p>
@endif