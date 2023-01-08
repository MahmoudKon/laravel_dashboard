<?php

namespace App\DataTables;

use App\Models\Setting;
use App\Traits\DatatableHelper;
use App\View\Components\ToggleColumn;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SettingDataTable extends DataTable
{
    use DatatableHelper;

    protected $table = 'settings';


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
            ->editColumn('autoload', function(Setting $setting) {
                $view = new ToggleColumn($setting->id, 'autoload', $setting->autoload);
                return $view->render()->with($view->data());
            })
            ->editColumn('active', function(Setting $setting) {
                $view = new ToggleColumn($setting->id, 'active', $setting->active);
                return $view->render()->with($view->data());
            })
            ->filterColumn('active', function ($query, $keywords) {
                $check = stripos('yes', $keywords) !== false ? true : false;
                return $query->where('active', $check);
            })

            ->addColumn('value', function(Setting $setting) {
                return $setting->value();
            })
            ->addColumn('contentType.name', function(Setting $setting) {
                return $setting->contentType->name;
            })
            ->filterColumn('contentType.name', function ($query, $keywords) {
                return $query->whereHas('contentType', function($query) use($keywords) {
                    return $query->where('name', 'LIKE', "%$keywords%");
                });
            })
            ->addColumn('check', 'backend.includes.tables.checkbox')
            ->editColumn('action', 'backend.includes.buttons.table-buttons')
            ->rawColumns(['action', 'check', 'value', 'autoload']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Setting $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Setting $model)
    {
        return $model->newQuery()->with('contentType');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('setting-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->setTableAttribute('class', $this->tableClass)
                    ->lengthMenu($this->lengthMenu)
                    ->pageLength($this->pageLength)
                    ->language($this->translateDatatables())
                    ->fixedHeader(true)
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
                        $this->initComplete('1,2,4')
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
            Column::make('check')->title('<label class="skin skin-square"><input data-color="red" type="checkbox" class="switchery" id="check-all"></label>')->exportable(false)->printable(false)->orderable(false)->searchable(false)->width(15)->addClass('text-center')->footer(trans('buttons.delete')),
            Column::make('id')->title('#')->width('70px'),
            Column::make('key')->title(trans('inputs.key')),
            Column::make('value')->title(trans('inputs.value')),
            Column::make('contentType.name')->title(trans('menu.content_type')),
            Column::make('active')->title(trans('inputs.active')),
            Column::make('autoload')->title(trans('inputs.autoload')),
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
        return 'Setting_' . date('YmdHis');
    }
}
