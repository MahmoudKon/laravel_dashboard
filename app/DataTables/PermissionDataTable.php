<?php

namespace App\DataTables;

use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PermissionDataTable extends DataTable
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
            ->addColumn('roles', function(Permission $permission) {
                $roles = "";
                foreach ($permission->roles as $role) $roles .= "$role->name | ";
                return trim($roles, ' | ');
            })
            ->filterColumn('roles', function ($query, $keywords) {
                return $query->whereHas('roles', function($query) use($keywords) {
                    return $query->where('name', 'LIKE', "%$keywords%");
                });
            })
            ->addColumn('check', 'backend.includes.tables.checkbox')
            ->addColumn('action', 'backend.includes.buttons.table-buttons')
            ->rawColumns(['action', 'check']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Spatie\Permission\Models\Permission $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Permission $model)
    {
        return $model->with('roles:id,name')->newQuery();
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
            Button::make()->text('<i class="fa fa-plus"></i> <span class="hidden" data-yajra-href="'.routeHelper('permissions.create').'"></span>')->addClass('btn btn-outline-info show-modal-form '. (canUser("permissions-create") ? "" : "remove-hidden-element"))->titleAttr(trans('menu.create-row', ['model' => trans('menu.permission')])),
            Button::make()->text('<i class="fas fa-trash"></i>')->addClass('btn btn-outline-danger multi-delete '. (canUser("permissions-multidelete") ? "" : "remove-hidden-element"))->titleAttr(trans('buttons.multi-delete')),
            Button::make('pageLength')->text('<i class="fa fa-sort-numeric-up"></i>')->addClass('btn btn-outline-light page-length')->titleAttr(trans('buttons.page-length'))
        ])
        ->responsive(true)
        ->parameters([
            'initComplete' => " function () {
                this.api().columns([2,3]).every(function () {
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
            Column::make('id')->hidden(),
            Column::make('check')->title('<label class="skin skin-square"><input data-color="red" type="checkbox" class="switchery" id="check-all"></label>')->exportable(false)->printable(false)->orderable(false)->searchable(false)->width(15)->addClass('text-center')->footer(trans('buttons.delete')),
            Column::make('name')->title(trans('inputs.name')),
            Column::make('roles')->title(trans('menu.roles'))->width("60%")->orderable(false)->footer(trans('menu.roles')),
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
        return 'Permission_' . date('YmdHis');
    }
}
