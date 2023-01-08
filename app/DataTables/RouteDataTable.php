<?php

namespace App\DataTables;

use App\Models\Route;
use App\Traits\DatatableHelper;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RouteDataTable extends DataTable
{
    use DatatableHelper;

    protected $table = 'routes';

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
            ->editColumn('action', function(Route $route) {return view('backend.'.getModel(view:true).'.actions', ['id' => $route->id])->render();})
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
        ->minifiedAjax()
        ->dom('Bfrtip')
        ->setTableAttribute('class', $this->tableClass)
        ->lengthMenu($this->lengthMenu)
        ->pageLength($this->pageLength)
        ->language($this->translateDatatables())
        ->buttons([
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

            $this->getCreateButton(),
            $this->getDeleteButton(),
            $this->getImportButton(),
            $this->getExportButton(),
            $this->getSearchButton(),
            $this->getCloseButton(),
            $this->getPageLengthButton()
        ])
        ->responsive(true)
        ->parameters(
            $this->initComplete('1,2,3,4,5,6,7,8,9,10')
        )
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
