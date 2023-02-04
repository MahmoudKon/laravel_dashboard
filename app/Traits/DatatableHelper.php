<?php

namespace App\Traits;

use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Html\Button;
use Illuminate\Support\Str;

trait DatatableHelper
{
    public $pageLength = 10;
    public $lengthMenu = [[5, 10, 20, 25, 30, -1], [5, 10, 20, 25, 30, 'All']];
    public $tableClass = 'table table-bordered table-striped table-sm w-100 dataTable';

    public function setPageLength(int|null $length = null) :void
    {
        $this->pageLength = $length;
    }

    public function setLengthMenu(array|null $arr = null) :void
    {
        $this->lengthMenu = $arr;
    }

    public function setTableClass(string|null $classes = null) :void
    {
        $this->tableClass = $classes;
    }

    public function translateDatatables() :array
    {
        return [
            "decimal"        => trans('datatable.decimal'),
            "emptyTable"     => trans('datatable.emptyTable'),
            "info"           => trans('datatable.info'),
            "infoEmpty"      => trans('datatable.infoEmpty'),
            "infoFiltered"   => trans('datatable.infoFiltered'),
            "infoPostFix"    => trans('datatable.infoPostFix'),
            "thousands"      => trans('datatable.thousands'),
            "lengthMenu"     => trans('datatable.lengthMenu'),
            "loadingRecords" => trans('datatable.loadingRecords'),
            "processing"     => trans('datatable.processing'),
            "search"         => trans('datatable.search'),
            "zeroRecords"    => trans('datatable.zeroRecords'),
            "paginate"       => [
                "first"    =>  trans('datatable.paginate.first'),
                "last"     =>  trans('datatable.paginate.last'),
                "next"     =>  trans('datatable.paginate.next'),
                "previous" =>  trans('datatable.paginate.previous')
            ],
            "aria" => [
                "sortAscending" =>  trans('datatable.aria.sortAscending'),
                "sortDescending" => trans('datatable.aria.sortDescending')
            ]
        ];
    }

    public function getCreateButton() :Button
    {
        if ( !canUser("$this->table-create") || !Route::has(getRoutePrefex('.')."$this->table.create")) return new Button();
        $route = routeHelper($this->table.'.create', getUrlQuery());
        if (cache()->get('use_button_ajax')) {
            return Button::make()
                    ->text('<i class="fa fa-plus"></i> <span class="hidden" data-yajra-href="'.$route.'"></span>')
                    ->addClass('btn btn-outline-info show-modal-form')
                    ->titleAttr(trans('menu.create-row', ['model' => trans('menu.'.Str::singular($this->table))]));

        } else {
            return Button::make()->text('<i class="fa fa-plus"></i>')
                    ->addClass('btn btn-outline-info')
                    ->action("window.location.href = '$route'")
                    ->titleAttr(trans('menu.create-row', ['model' => trans('menu.'.Str::singular($this->table))]));
        }
    }

    public function getDeleteButton() :Button
    {
        if ( !canUser($this->table."-multidelete") || !Route::has(getRoutePrefex('.')."$this->table.multidelete") ) return new Button();
        return Button::make()
                        ->text('<i class="fas fa-trash"></i>')
                        ->addClass('btn btn-outline-danger multi-delete')
                        ->titleAttr(trans('buttons.multi-delete'));

    }

    public function getPageLengthButton() :Button
    {
        return Button::make('pageLength')
                        ->text('<i class="fa fa-sort-numeric-up"></i>')
                        ->addClass('btn btn-outline-light page-length')
                        ->titleAttr(trans('buttons.page-length'));
    }

    public function getImportButton() :Button
    {
        if ( !canUser($this->table."-import") || !Route::has(getRoutePrefex('.')."$this->table.excel.import.form") ) return new Button();
        return Button::make()
                    ->text('<i class="fa fa-cloud-upload"></i> <span class="hidden" data-yajra-href="'.routeHelper($this->table.'.excel.import.form').'"></span>')
                    ->addClass('btn btn-outline-primary show-modal-form')
                    ->titleAttr('Import '.$this->table);
    }

    public function getExportButton() :Button
    {
        if ( !Route::has(getRoutePrefex('.')."$this->table.excel.export") ) return new Button();
        return Button::make()->text('<i class="fas fa-cloud-download"></i>')
                        ->action("window.location.href = '". routeHelper($this->table.'.excel.export') ."'")
                        ->addClass('btn btn-outline-info '. (canUser($this->table."-export") ? "" : "remove-hidden-element"))
                        ->titleAttr(trans('buttons.export-excel'));
    }

    public function getSearchButton() :Button
    {
        if ( !Route::has(getRoutePrefex('.')."$this->table.search.form") ) return new Button();
        return Button::make()
                    ->text('<i class="fa fa-search"></i> <span class="hidden" data-yajra-href="'.routeHelper($this->table.'.search.form').'"></span>')
                    ->addClass('btn btn-outline-warning show-search-form ' . (request()->has('search') ? 'hidden' : ''))
                    ->titleAttr('Open Search Form');
    }

    public function getCloseButton() :Button
    {
        if ( !Route::has(getRoutePrefex('.')."$this->table.search.form") ) return new Button();
        return Button::make()
                    ->text('<i class="fa fa-times"></i>')
                    ->addClass('btn btn-outline-warning close-search-button ' . (request()->has('search') ? '' : 'hidden'))
                    ->titleAttr('Close Search Form');
    }

    public function initComplete($search_columns = '2') :array
    {
        return [
            'initComplete' => " function () {
                                    this.api().columns([$search_columns]).every(function () {
                                        var column = this;
                                        var input = document.createElement(\"input\");
                                        $(input).appendTo($(column.footer()).empty())
                                        .on('keyup', function () {
                                            column.search($(this).val(), false, false, true).draw();
                                        });
                                    });
                                    document.getElementById('load-data').classList.remove('load');
                                }"
        ];
    }
}
