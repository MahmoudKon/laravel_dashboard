<?php

namespace App\DataTables;

use App\Models\OauthSocial;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use App\Traits\DatatableHelper;
use App\View\Components\ToggleColumn;

class OauthSocialDataTable extends DataTable
{
    use DatatableHelper;

    protected $table = 'oauth_socials';

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
            ->editColumn('active', function(OauthSocial $row) {
                $view = new ToggleColumn($row->id, 'active', $row->active);
                return $view->render()->with($view->data());
            })
            ->editColumn('icon', function(OauthSocial $row) {
                return $row->getTemplate();
            })
            ->rawColumns(['action', 'check', 'active', 'icon']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\OauthSocial $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(OauthSocial $model)
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
        ->setTableId('oauth_socials-table')
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
            $this->getImportButton(),
            $this->getExportButton(),
            $this->getSearchButton(),
            $this->getCloseButton(),
            $this->getPageLengthButton()
        ])
        ->responsive(true)
        ->parameters(
            $this->initComplete('1,2')
        );
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
			Column::make('display_name')->title(trans('inputs.display_name')),
			Column::make('name')->title(trans('inputs.name')),
			Column::make('icon')->title(trans('inputs.icon')),
			Column::make('active')->title(trans('inputs.active')),
            Column::computed('action')->exportable(false)->printable(false)->width(75)->addClass('text-center')->footer(trans('inputs.action'))->title(trans('inputs.action')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return stringwithRelations
     */
    protected function filename()
    {
        return 'oauth_socials_' . date('YmdHis');
    }
}
