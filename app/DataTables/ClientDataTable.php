<?php

namespace App\DataTables;

use App\Models\Client;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class ClientDataTable extends DataTable
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
            ->editColumn('action', 'backend.includes.buttons.table-buttons')
            ->rawColumns(['action', 'check']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Client $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Client $model)
    {
        return $model->newQuery()->with(['user', 'department']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->setTableId('clients-table')
        ->columns($this->getColumns())
        ->setTableAttribute('class', 'table table-bordered table-striped table-sm w-100 dataTable')
        ->minifiedAjax()
        ->dom('Bfrtip')
        ->lengthMenu([[5, 10, 20, 25, 30, -1], [5, 10, 20, 25, 30, 'All']])
        ->pageLength(5)
        ->buttons([
            Button::make()->text('<i class="fa fa-plus"></i>')->addClass('btn btn-outline-info '. (canUser("clients-create") ? "" : "remove-hidden-element"))->action("window.location.href = window.location.href+'/create'")->titleAttr(trans('menu.create-row', ['model' => trans('menu.client')])),
            Button::make()->text('<i class="fas fa-trash"></i>')->addClass('btn btn-outline-danger multi-delete '. (canUser("clients-multidelete") ? "" : "remove-hidden-element"))->titleAttr(trans('buttons.multi-delete')),
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
            Column::make('id')->hidden(),
            Column::make('check')->title('<label class="skin skin-square"><input data-color="red" type="checkbox" class="switchery" id="check-all"></label>')->exportable(false)->printable(false)->orderable(false)->searchable(false)->width(15)->addClass('text-center')->footer(trans('buttons.delete')),
            
			Column::make('name')->title(trans('inputs.name')),
			Column::make('email')->title(trans('inputs.email')),
			Column::make('image')->title(trans('inputs.image')),
			Column::make('active')->title(trans('inputs.active')),
			Column::make('user.name')->title(trans('menu.users')),
			Column::make('department.title')->title(trans('menu.departments')),
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
        return 'clients_' . date('YmdHis');
    }
}
