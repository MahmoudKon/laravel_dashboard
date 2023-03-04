<?php

namespace App\DataTables;

use App\Models\User;
use App\Traits\DatatableHelper;
use App\View\Components\LinkTag;
use App\View\Components\PreviewImage;
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
            ->editColumn('roles', function(User $user) {
                return $user->roles->implode('name', ' | ');
            })
            ->editColumn('image', function(User $user) {
                $view = new PreviewImage($user->image, $user->name);
                return $view->render()->with($view->data());
            })
            ->editColumn('name', function(User $user) {
                $view = new LinkTag(routeHelper('users.show', $user), $user->name, trans('buttons.cover'), 'btn-link');
                return $view->render()->with($view->data());
            })
            ->editColumn('logged_in', function(User $user) {
                if (! $user->logged_in || ! canUser('users-forceLogout')) return '';
                $view = new LinkTag(routeHelper('users.force.logout', ['id' => $user->id]), '', trans('menu.logout'), 'btn-sm btn-danger do-single-process', 'fa-solid fa-arrow-right-from-bracket');
                return $view->render()->with($view->data());
            })
            ->editColumn('action', 'backend.includes.buttons.table-buttons')
            ->rawColumns(['action', 'check', 'image', 'logged_in']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->exceptAuth()->filter();
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
        ->minifiedAjax()
        ->dom('Bfrtip')
        ->setTableAttribute('class', $this->tableClass)
        ->lengthMenu($this->lengthMenu)
        ->pageLength($this->pageLength)
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
        ->parameters(
            $this->initComplete('1, 2,3')
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
            Column::make('code')->title('#')->width('70px'),
            Column::make('name')->title(trans('inputs.name')),
            Column::make('email')->title(trans('inputs.email')),
            Column::make('roles')->title(trans('menu.roles')),
            Column::make('image')->title(trans('title.avatar'))->footer(trans('title.avatar'))->orderable(false),
            Column::make('logged_in')->title(trans('menu.logout'))->class(canUser('users-forceLogout') ? '' : 'hidden')->footer(trans('menu.logout'))->searchable(false)->orderable(false),
            Column::computed('action')->exportable(false)->printable(false)->width(75)->addClass('text-center')->footer(trans('inputs.action'))->title(trans('inputs.action')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
