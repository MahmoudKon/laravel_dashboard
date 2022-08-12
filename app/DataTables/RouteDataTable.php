<?php

namespace App\DataTables;

use App\Models\Route;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RouteDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('middleware', function (Route $route) {
                return str_replace(',', ' <br> ', $route->middleware);
            })
            ->editColumn('method', function (Route $route) {
                return str_replace(',', ' <br> ', $route->method);
            })
            ->editColumn('roles', function(Route $route) {return "$route->roles_count Role(s)";})
            ->editColumn('action', function(Route $route) {return view('backend.routes.actions', ['id' => $route->id])->render();})
            ->rawColumns(['middleware', 'action', 'method']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Route $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Route $model)
    {
        return $model->newQuery()->withCount('roles')->orderBy('namespace', 'ASC')->orderBy('controller', 'ASC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->setTableId('routes-table')
        ->columns($this->getColumns())
        ->setTableAttribute('class', 'table table-bordered table-striped table-sm w-100 dataTable')
        ->minifiedAjax()
        ->dom('Bfrtip')
        ->lengthMenu([[5, 10, 20, 25, 30, -1], [5, 10, 20, 25, 30, 'All']])
        ->pageLength(5)
        ->language(translateDatatables())
        ->buttons([
            Button::make()->text('<i class="fa fa-link"></i>')
            ->addClass('btn btn-outline-info '. (canUser("routes-create") ? "" : "remove-hidden-element"))
            ->action("window.location.href = " . '"' . routeHelper('routes.assign') . '"')
            ->titleAttr(trans('menu.assign-roles')),

            Button::make()->text('<i class="fa fa-download"></i>')
            ->addClass('btn btn-outline-primary')->action("window.location.href = " . '"' . routeHelper('routes.download'). '"')
            ->titleAttr(trans('buttons.download')),

            Button::make()->text('<i class="fa fa-rotate"></i>')
            ->addClass('btn btn-outline-success')
            ->action("window.location.href = " . '"' . routeHelper('routes.syncRoutes'). '"')
            ->titleAttr(trans('buttons.sync routes')),

            Button::make()->text('<i class="fa fa-shield-alt"></i>')
            ->addClass('btn btn-outline-warning')
            ->action("window.location.href = " . '"' . routeHelper('routes.syncPermissions'). '"')
            ->titleAttr(trans('buttons.sync permissions')),

            Button::make('pageLength')->text('<i class="fa fa-sort-numeric-up"></i>')->addClass('btn btn-outline-light page-length '. (canUser("aggregators-create") ? "" : "remove-hidden-element"))->titleAttr(trans('buttons.page-length')),
        ])
        ->responsive(true)
        ->parameters([
            'initComplete' => " function () {
                this.api().columns([0,2,3,4,5,6,7,8]).every(function () {
                    var column = this;
                    var input = document.createElement(\"input\");
                    $(input).appendTo($(column.footer()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), true, true, true).draw();
                    });
                });
            }",
        ])
        ->orderBy(0);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title("ID"),
            Column::make('roles')->title("Roles Count")->footer("Roles Count")->orderable(false)->searchable(false),
            Column::make('controller')->title(trans('inputs.controller')),
            Column::make('func')->title(trans('inputs.function')),
            Column::make('method')->title(trans('inputs.method')),
            Column::make('middleware')->title(trans('inputs.middleware')),
            Column::make('namespace')->title(trans('inputs.namespace')),
            Column::make('uri')->title(trans('inputs.uri')),
            Column::make('route')->title(trans('inputs.route')),
            Column::make('prefix')->title(trans('inputs.prefix')),
            Column::make('where')->title(trans('inputs.where')),
            Column::computed('action')->exportable(false)->printable(false)->width(75)->addClass('text-center')->footer(trans('inputs.action'))->title(trans('inputs.action')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Route_' . date('YmdHis');
    }
}
