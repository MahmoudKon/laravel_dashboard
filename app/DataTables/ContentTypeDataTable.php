<?php

namespace App\DataTables;

use App\Models\ContentType;
use App\Traits\DatatableHelper;
use App\View\Components\ToggleColumn;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ContentTypeDataTable extends DataTable
{
    use DatatableHelper;

    protected $table = 'content_types';

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
            ->editColumn('visible_to_content', function(ContentType $contentType) {
                $view = new ToggleColumn($contentType->id, 'visible_to_content', $contentType->visible_to_content);
                return $view->render()->with($view->data());
            })
            ->filterColumn('visible_to_content', function ($query, $keywords) {
                $check = stripos('visible', $keywords) !== false ? true : false;
                return $query->where('visible_to_content', $check);
            })
            ->addColumn('check', 'backend.includes.tables.checkbox')
            ->editColumn('action', 'backend.includes.buttons.table-buttons')
            ->rawColumns(['action', 'check', 'visible_to_content']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ContentType $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ContentType $model)
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
            ->setTableId('contenttype-table')
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
                $this->initComplete('2')
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
            Column::make('name')->title(trans('inputs.name')),
            Column::make('visible_to_content')->title(trans('inputs.visible_to_content')),
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
        return 'ContentType_' . date('YmdHis');
    }
}
