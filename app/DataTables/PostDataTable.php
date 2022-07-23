<?php

namespace App\DataTables;

use App\Models\Post;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PostDataTable extends DataTable
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
            ->addColumn('check', 'backend.includes.tables.checkbox')
            ->editColumn('content_id', function(Post $post) {return $post->content->title;})
            ->editColumn('operator_id', function(Post $post) {return "{$post->operator->name} - {$post->operator->country->name}";})
            ->editColumn('active', function(Post $post) {
                return "<input type='checkbox' class='switchery active-toggle' ".($post->active ? 'checked' : '')." data-post-id='$post->id'>";
            })
            ->editColumn('url', function(Post $post) {
                return $post->url ? "<button class='btn btn-sm copy-url primary' data-url='".url($post->url)."' data-toggle='tooltip' title='".trans('buttons.copy')."' >Copy URL</button>" : '';
            })
            ->filterColumn('active', function ($query, $keywords) {
                $active = stripos('TRUE', $keywords) !== false ? true : false;
                return $query->where('active', $active);
            })
            ->filterColumn('published_date', function ($query, $keywords) {
                $date = Carbon::parse($keywords)->format('Y-m-d');
                return $query->where('published_date', $date);
            })
            ->filterColumn('content_id', function ($query, $keywords) {
                return $query->whereHas('content', function($query) use($keywords) {
                    return $query->where('title', 'LIKE', "%$keywords%");
                });
            })
            ->filterColumn('operator_id', function ($query, $keywords) {
                $keywords = explode('-', $keywords);
                return $query->whereHas('operator', function($query) use($keywords) {
                    $query->where('name', 'LIKE', "%".trim($keywords[0])."%")->when(isset($keywords[1]), function($query) use($keywords) {
                        return $query->whereHas('country', function($query) use($keywords) {
                            $query->where('name', 'LIKE', "%".trim($keywords[1])."%");
                        });
                    });
                });
            })
            ->editColumn('action', function(Post $post) {return view('backend.posts.actions', ['id' => $post->id])->render();})
            ->rawColumns(['action', 'check', 'active', 'url']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Post $model)
    {
        return $model->filter()->with('content:id,title', 'operator:id,name,country_id', 'operator.country:id,name');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('post-table')
                    ->columns($this->getColumns())
                    ->setTableAttribute('class', 'table table-bordered table-striped table-sm w-100 dataTable')
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->lengthMenu([[5, 10, 20, 25, 30, -1], [5, 10, 20, 25, 30, 'All']])
                    ->pageLength(20)
                    ->buttons([
                        Button::make()->text('<i class="fa fa-plus"></i>')->addClass('btn btn-outline-info '. (canUser("posts-create") ? "" : "remove-hidden-element"))->action("window.location.href = window.location.href+'/create'")->titleAttr(trans('menu.create-row', ['model' => trans('menu.post')])),
                        Button::make()->text('<i class="fas fa-trash"></i>')->addClass('btn btn-outline-danger multi-delete '. (canUser("posts-multidelete") ? "" : "remove-hidden-element"))->titleAttr(trans('buttons.multi-delete')),

                        Button::make('pageLength')->text('<i class="fa fa-sort-numeric-up"></i>')->addClass('btn btn-outline-light page-length')->titleAttr(trans('buttons.page-length'))
                    ])
                    ->responsive(true)
                    ->parameters([
                        'initComplete' => " function () {
                            this.api().columns([1,2,3,5,6]).every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on('keyup', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }",
                    ])
                    ->orderBy(2);
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
            Column::make('id')->title('ID')->width(60),
            Column::make('published_date')->title(trans('inputs.published_date')),
            Column::make('active')->title(trans('inputs.active')),
            Column::make('url')->title(trans('inputs.url')),
            Column::make('content_id')->title(trans('menu.content')),
            Column::make('operator_id')->title(trans('menu.operator')),
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
        return 'Post_' . date('YmdHis');
    }
}
