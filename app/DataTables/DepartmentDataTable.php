<?php

namespace App\DataTables;

use App\Models\Department;
use App\Traits\DatatableHelper;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DepartmentDataTable extends DataTable
{
    use DatatableHelper;

    protected $table = 'departments';

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
            ->editColumn('action', function(Department $department) {return view('backend.'.getModel(view:true).'.actions', ['id' => $department->id])->render();})
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
        ->minifiedAjax()
        ->dom('Bfrtip')
        ->setTableAttribute('class', $this->tableClass)
        ->lengthMenu($this->lengthMenu)
        ->pageLength($this->pageLength)
        ->language($this->translateDatatables())
        ->buttons([
            $this->getCreateButton(),
            $this->getDeleteButton(),
            $this->getPageLengthButton()
        ])
        ->responsive(true)
        ->parameters(
            $this->initComplete('1,2,3,4,5')
        )
        ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('check')->title('<label class="skin skin-square p-0 m-0"><input data-color="red" type="checkbox" class="switchery" id="check-all" style="width: 25px"></label>')->exportable(false)->printable(false)->orderable(false)->searchable(false)->width(15)->addClass('text-center')->footer(trans('buttons.delete')),
            Column::make('id')->title('#')->width('70px'),
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
