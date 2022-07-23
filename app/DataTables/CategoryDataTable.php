<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
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
        ->addColumn('subs', function(Category $category) {
            return $category->subs_count ? "<a href='".routeHelper('categories.subs.index', $category->id)."' class='btn btn-info btn-sm' ><i class='fa fa-list'></i> List ($category->subs_count) Subs</a>" : '';
        })
        ->editColumn('parent.name', function(Category $category) { return $category->parent?->name; })
        ->editColumn('image', function(Category $category) {return view('backend.includes.tables.image', ['image' => $category->image, 'alt' => $category->name])->render();})
        ->addColumn('check', 'backend.includes.tables.checkbox')
        ->editColumn('action', function(Category $category) {return view('backend.categories.actions', ['id' => $category->id])->render();})
        ->rawColumns(['action', 'check', 'name', 'image', 'subs']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        return $model->with('parent:id,name')->withCount('subs')->newQuery()->filter()->orderBy('parent_id', 'ASC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                ->setTableId('category-table')
                ->columns($this->getColumns())
                ->setTableAttribute('class', 'table table-bordered table-striped table-sm w-100 dataTable')
                ->minifiedAjax()
                ->dom('Bfrtip')
                ->lengthMenu([[5, 10, 20, 25, 30, -1], [5, 10, 20, 25, 30, 'All']])
                ->pageLength(5)
                ->buttons([
                    Button::make()->text('<i class="fa fa-plus"></i> <span class="hidden" data-yajra-href="'.routeHelper('categories.create').'"></span>')->addClass('btn btn-outline-info show-modal-form '. (canUser("categories-create") ? "" : "remove-hidden-element"))->titleAttr(trans('menu.create-row', ['model' => trans('menu.category')])),
                    Button::make()->text('<i class="fas fa-trash"></i>')->addClass('btn btn-outline-danger multi-delete '. (canUser("categories-multidelete") ? "" : "remove-hidden-element"))->titleAttr(trans('buttons.multi-delete')),
                    Button::make('pageLength')->text('<i class="fa fa-sort-numeric-up"></i>')->addClass('btn btn-outline-light page-length')->titleAttr(trans('buttons.page-length'))
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
            Column::make('image')->title(trans('title.avatar'))->footer(trans('title.avatar')),
            Column::make('parent.name')->title(trans('inputs.parent-category'))->footer(trans('inputs.parent-category'))->orderable(false),
            Column::computed('subs')->exportable(false)->printable(false)->width(75)->addClass('text-center')->title(trans('inputs.sub-categories'))->footer(trans('inputs.sub-categories')),
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
        return 'Category_' . date('YmdHis');
    }
}
