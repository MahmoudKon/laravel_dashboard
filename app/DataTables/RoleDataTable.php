<?php

namespace App\DataTables;

use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role as ModelsRole;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
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
            ->addColumn('check', 'backend.includes.tables.checkbox')
            ->addColumn('action', 'backend.includes.buttons.table-buttons')
            ->editColumn('action', function(Role $role) {return view('backend.roles.actions', ['id' => $role->id])->render();})
            ->rawColumns(['action', 'check']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ModelsRole $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->setTableId('users-table')
        ->columns($this->getColumns())
        ->setTableAttribute('class', 'table table-bordered table-striped table-sm w-100 dataTable')
        ->minifiedAjax()
        ->dom('Bfrtip')
        ->lengthMenu([[5, 10, 20, 25, 30, -1], [5, 10, 20, 25, 30, 'All']])
        ->pageLength(5)
        ->buttons([
            Button::make()->text('<i class="fa fa-plus"></i> <span class="hidden" data-yajra-href="'.routeHelper('roles.create').'"></span>')->addClass('btn btn-outline-info show-modal-form '. (canUser("routes.assign") ? "" : "remove-hidden-element"))->titleAttr(trans('menu.create-row', ['model' => trans('menu.role')])),
            Button::make()->text('<i class="fas fa-trash"></i>')->addClass('btn btn-outline-danger multi-delete '. (canUser("routes-multidelete") ? "" : "remove-hidden-element"))->titleAttr(trans('buttons.multi-delete')),
            Button::make('excel')->text('<i class="fas fa-download"></i>')->addClass('btn btn-outline-success')->titleAttr(trans('buttons.export-file')),
            Button::make('pageLength')->text('<i class="fa fa-sort-numeric-up"></i>')->addClass('btn btn-outline-light page-length')->titleAttr(trans('buttons.page-length'))
        ])
        ->responsive(true)
        ->parameters([
            'initComplete' => " function () {
                this.api().columns([2]).every(function () {
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
            Column::make('id')->hidden()->exportable(false)->printable(false),
            Column::make('check')->title('<label class="skin skin-square"><input data-color="red" type="checkbox" class="switchery" id="check-all"></label>')->exportable(false)->printable(false)->orderable(false)->searchable(false)->width(15)->addClass('text-center')->footer(trans('buttons.delete')),
            Column::make('name')->title(trans('inputs.name')),
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
        return 'Role_' . date('YmdHis');
    }
}
