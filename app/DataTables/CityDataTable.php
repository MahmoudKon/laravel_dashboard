<?php

namespace App\DataTables;

use App\Models\City;
use App\Traits\DatatableHelper;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CityDataTable extends DataTable
{
    use DatatableHelper;

    protected $table = 'cities';

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
            ->editColumn('name', function(City $city) {
                $text = '<ul>';
                foreach ($city->getTranslations()['name'] as $name)
                    $text .= "<li>$name</li>";
                return "$text </ul>";
            })
            ->filterColumn('governorate_id', function ($query, $keywords) {
                return $query->whereHas('governorate', function($query) use($keywords) {
                    return $query->where('name', 'LIKE', "%$keywords%");
                });
            })
            ->editColumn('governorate_id', function(City $city) { return $city->governorate?->name; })
            ->addColumn('check', 'backend.includes.tables.checkbox')
            ->addColumn('action', 'backend.includes.buttons.table-buttons')
            ->rawColumns(['action', 'check', 'name']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\City $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(City $model)
    {
        return $model->newQuery()->filter();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('city-table')
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
                        $this->initComplete('1,2,3')
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
            Column::make('id')->title('#')->width('70px'),
            Column::make('name')->title(trans('inputs.name')),
            Column::make('governorate_id')->title(trans('menu.governorate')),
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
        return 'City_' . date('YmdHis');
    }
}
