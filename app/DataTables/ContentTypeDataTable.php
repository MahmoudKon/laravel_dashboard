<?php

namespace App\DataTables;

use App\Models\ContentType;
use App\Traits\DatatableHelper;
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
                $text = "<form method='post' action='".routeHelper('content_types.visible.toggle', $contentType->id)."' class='submit-form'> <input type='hidden' name='_token' value='".csrf_token()."'>";
                if ($contentType->visible_to_content) {
                    $text .= "<button type='submit' class='btn btn-sm btn-primary'><i class='fa fa-eye'></i> Visible</button>";
                } else {
                    $text .= "<button type='submit' class='btn btn-sm btn-warning'><i class='fa fa-eye-slash'></i> Hidden</button>";
                }
                return "$text </form>";
            })
            ->filterColumn('visible_to_content', function ($query, $keywords) {
                $check = stripos('visible', $keywords) !== false ? true : false;
                return $query->where('visible_to_content', $check);
            })
            ->addColumn('check', 'backend.includes.tables.checkbox')
            ->editColumn('action', function(ContentType $contentType) {return view('backend.includes.buttons.table-buttons', ['id' => $contentType->id])->render();})
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
                $this->getPageLengthButton()
            ])
            ->responsive(true)
            ->parameters([
                'initComplete' => " function () {
                    this.api().columns([2]).every(function () {
                        var column = this;
                        var input = document.createElement(\"input\");
                        $(input).appendTo($(column.footer()).empty())
                        .on('keyup', function () {
                            column.search($(this).val(), true, true, true).draw();
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
            Column::make('id')->hidden(),
            Column::make('check')->title('<label class="skin skin-square"><input data-color="red" type="checkbox" class="switchery" id="check-all"></label>')->exportable(false)->printable(false)->orderable(false)->searchable(false)->width(15)->addClass('text-center')->footer(trans('buttons.delete')),
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
