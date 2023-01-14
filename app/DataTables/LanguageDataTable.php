<?php

namespace App\DataTables;

use App\Models\Language;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Column;
use App\Traits\DatatableHelper;
use App\View\Components\ToggleColumn;

class LanguageDataTable extends DataTable
{
    use DatatableHelper;

    protected $table = 'languages';

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
            ->editColumn('icon', function(Language $row) { return "<i class='$row->icon'></i>"; })
            ->editColumn('active', function(Language $row) {
                if ($row->short_name == config('app.fallback_locale'))
                    return "DEFAULT";
                $view = new ToggleColumn($row->id, 'active', $row->active);
                return $view->render()->with($view->data());
            })
            ->addColumn('show', function(Language $row) {
                return "<a href='".routeHelper('languages.show', $row)."' class='btn btn-sm btn-primary'> <i class='fas fa-list'></i> ".trans('buttons.show')." </a>";
            })
            ->editColumn('action', 'backend.includes.buttons.table-buttons')
            ->rawColumns(['action', 'active', 'icon', 'show']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Language $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Language $model)
    {
        return $model->newQuery()->orderBy('active', 'DESC')->orderBy('short_name', 'ASC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->setTableId('languages-table')
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
            $this->initComplete('0,1,2')
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
			Column::make('name')->title(trans('inputs.name')),
			Column::make('native')->title(trans('inputs.native')),
			Column::make('short_name')->title(trans('inputs.short_name')),
			Column::make('show')->title(trans('buttons.show-trans')),
			Column::make('active')->title(trans('inputs.active'))->searchable(false),
			Column::make('icon')->title(trans('inputs.icon'))->searchable(false),
            Column::computed('action')->exportable(false)->printable(false)->width(75)->addClass('text-center')->title(trans('inputs.action'))->footer(trans('inputs.action')),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return stringwithRelations
     */
    protected function filename()
    {
        return 'languages_' . date('YmdHis');
    }
}
