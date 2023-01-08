<?php

namespace App\DataTables;

use App\Models\SocialMedia;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use App\Traits\DatatableHelper;
use App\View\Components\ToggleColumn;

class SocialMediaDataTable extends DataTable
{
    use DatatableHelper;

    protected $table = 'social_medias';

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
            ->editColumn('is_visible', function(SocialMedia $row) {
                $view = new ToggleColumn($row->id, 'is_visible', $row->is_visible);
                return $view->render()->with($view->data());
            })
            ->addColumn('url', function(SocialMedia $row) {
                return $row->getTemplate();
            })
            ->addColumn('check', 'backend.includes.tables.checkbox')
            ->editColumn('action', 'backend.includes.buttons.table-buttons')
            ->rawColumns(['action', 'check', 'is_visible', 'url']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SocialMedia $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SocialMedia $model)
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
        ->setTableId('social_medias-table')
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
            $this->initComplete('')
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
			Column::make('name')->title(trans('inputs.name')),
			Column::make('url')->title(trans('inputs.url')),
			Column::make('is_visible')->title(trans('inputs.is_visible')),
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
        return 'social_medias_' . date('YmdHis');
    }
}
