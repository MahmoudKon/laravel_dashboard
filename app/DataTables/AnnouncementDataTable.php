<?php

namespace App\DataTables;

use App\Models\Announcement;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use App\Traits\DatatableHelper;
use App\View\Components\PreviewImage;
use App\View\Components\ToggleColumn;

class AnnouncementDataTable extends DataTable
{
    use DatatableHelper;

    protected $table = 'announcements';

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
            ->editColumn('url', function(Announcement $row) {
                return "<a href='$row->url' class='btn btn-sm btn-primary' target='_blank'> <i class='fa fa-link'></i> ".trans('inputs.url')."</a>";
            })
            ->editColumn('title', function(Announcement $row) {
                return "<a href='".routeHelper('announcements.show', $row)."' target='_blank' class='btn btn-sm btn-link'>$row->title</a>";
            })
            ->editColumn('image', function(Announcement $row) {
                $view = new PreviewImage($row->image, $row->name);
                return $view->render()->with($view->data());
            })
            ->editColumn('open_type', function(Announcement $row) {
                $view = new ToggleColumn($row->id, 'open_type', $row->open_type);
                return $view->render()->with($view->data());
            })
            ->editColumn('active', function(Announcement $row) {
                $view = new ToggleColumn($row->id, 'active', $row->active);
                return $view->render()->with($view->data());
            })
            ->editColumn('start_date', function(Announcement $row) { return $row->formatDate('start_date'); })
            ->editColumn('end_date', function(Announcement $row) { return $row->formatDate('end_date'); })
            ->addColumn('check', 'backend.includes.tables.checkbox')
            ->editColumn('action', 'backend.includes.buttons.table-buttons')
            ->rawColumns(['action', 'check', 'url', 'title', 'active', 'open_type']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Announcement $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Announcement $model)
    {
        return $model->newQuery()->filter()->with(['creator']);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->setTableId('announcements-table')
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
			Column::make('creator.name')->title(trans('inputs.creator')),
			Column::make('title')->title(trans('inputs.title')),
			Column::make('start_date')->title(trans('inputs.start_date')),
			Column::make('end_date')->title(trans('inputs.end_date')),
			Column::make('url')->title(trans('inputs.url')),
			Column::make('image')->title(trans('inputs.image')),
			Column::make('open_type')->title(trans('inputs.open_type')),
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
        return 'announcements_' . date('YmdHis');
    }
}
