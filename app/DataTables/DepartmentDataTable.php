<?php

namespace App\DataTables;

use App\Models\Department;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DepartmentDataTable extends DataTable
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
            ->editColumn('manager', function(Department $department) {return $department->manager?->name;})
            ->editColumn('managerOfManager', function(Department $department) {return $department->managerOfManager?->name;})
            ->editColumn('action', function(Department $department) {return view('backend.departments.actions', ['id' => $department->id])->render();})
            ->filterColumn('manager', function ($query, $keywords) {
                return $query->whereHas('manager', function($query) use($keywords) {
                    return $query->where('name', 'LIKE', "%$keywords%");
                });
            })
            ->filterColumn('managerOfManager', function ($query, $keywords) {
                return $query->whereHas('managerOfManager', function($query) use($keywords) {
                    return $query->where('name', 'LIKE', "%$keywords%");
                });
            })
            ->rawColumns(['action', 'check', 'image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Department $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Department $model)
    {
        return $model->with('manager:id,name', 'managerOfManager:id,name')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->setTableId('departments-table')
        ->columns($this->getColumns())
        ->setTableAttribute('class', 'table table-bordered table-striped table-sm w-100 dataTable')
        ->minifiedAjax()
        ->dom('Bfrtip')
        ->lengthMenu([[5, 10, 20, 25, 30, -1], [5, 10, 20, 25, 30, 'All']])
        ->pageLength(5)
        ->language(translateDatatables())
        ->buttons([
            Button::make()->text('<i class="fa fa-plus"></i>')->addClass('btn btn-outline-info '. (canUser("departments-create") ? "" : "remove-hidden-element"))->action("window.location.href = " . '"' . routeHelper('departments.create') . '"')->titleAttr(trans('menu.create-row', ['model' => trans('menu.department')])),
            Button::make()->text('<i class="fas fa-trash"></i>')->addClass('btn btn-outline-danger multi-delete '. (canUser("departments-multidelete") ? "" : "remove-hidden-element"))->titleAttr(trans('buttons.multi-delete')),
            Button::make('pageLength')->text('<i class="fa fa-sort-numeric-up"></i>')->addClass('btn btn-outline-light page-length')->titleAttr(trans('buttons.page-length'))
        ])
        ->responsive(true)
        ->parameters([
            'initComplete' => " function () {
                this.api().columns([2,3,4,5]).every(function () {
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
            Column::make('title')->title(trans('inputs.title')),
            Column::make('email')->title(trans('inputs.email')),
            Column::make('manager')->title(trans('inputs.manager'))->footer(trans('inputs.manager'))->orderable(false),
            Column::make('managerOfManager')->title(trans('inputs.manager-of-manager'))->footer(trans('inputs.manager-of-manager'))->orderable(false),
            Column::computed('action')->exportable(false)->printable(false)->width(75)->addClass('text-center')->title(trans('inputs.action'))->footer(trans('inputs.action')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Department_' . date('YmdHis');
    }
}
