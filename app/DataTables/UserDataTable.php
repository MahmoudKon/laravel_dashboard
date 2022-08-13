<?php

namespace App\DataTables;

use App\Models\User;
use App\Traits\DatatableHelper;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    use DatatableHelper;

    protected $table = 'users';

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
            ->editColumn('department', function(User $user) {
                return $user->department_id
                        ? "<a href='".routeHelper('departments.edit', $user->department_id)."' title='Edit Department' target='_blank'>".($user->department->title ?? "")."</a>"
                        : "";
            })
            ->filterColumn('department', function ($query, $keywords) {
                return $query->whereHas('department', function($query) use($keywords) {
                    return $query->where('title', 'LIKE', "%$keywords%");
                });
            })
            ->editColumn('image', function(User $user) {return view('backend.includes.tables.image', ['image' => $user->image, 'alt' => $user->name])->render();})
            ->editColumn('action', function(User $user) {return view('backend.users.actions', ['id' => $user->id])->render();})
            ->rawColumns(['action', 'check', 'image', 'department']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->hasManager()->exceptAuth()->filter();
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
            $this->getCreateButton(),
            $this->getDeleteButton(),
            $this->getImportButton(),
            $this->getExportButton(),
            $this->getSearchButton(),
            $this->getCloseButton(),
            $this->getPageLengthButton()
        ])
        ->responsive(true)
        ->language($this->translateDatatables())
        ->parameters([
            'initComplete' => " function () {
                this.api().columns([2,3,5]).every(function () {
                    var column = this;
                    var input = document.createElement(\"input\");
                    $(input).appendTo($(column.footer()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                });
                document.getElementById('load-data').classList.remove('load');
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
            Column::make('id')->hidden()->exportable(false),
            Column::make('check')->title('<label class="skin skin-square"><input data-color="red" type="checkbox" class="switchery" id="check-all"></label>')->exportable(false)->printable(false)->orderable(false)->searchable(false)->width(15)->addClass('text-center')->footer(trans('buttons.delete')),
            Column::make('name')->title(trans('inputs.name')),
            Column::make('email')->title(trans('inputs.email')),
            Column::make('image')->title(trans('title.avatar'))->footer(trans('title.avatar'))->orderable(false),
            Column::make('department')->title(trans('menu.department'))->footer(trans('menu.department'))->orderable(false),
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
        return 'Users_' . date('YmdHis');
    }
}
