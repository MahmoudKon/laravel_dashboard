<?php

namespace App\Traits;

use Yajra\DataTables\Html\Button;
use Illuminate\Support\Str;

trait DatatableHelper
{

    public function translateDatatables()
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

    public function getCreateButton()
    {
        if (session('use_button_ajax')) {
            return Button::make()
                    ->text('<i class="fa fa-plus"></i> <span class="hidden" data-yajra-href="'.routeHelper($this->table.'.create').'"></span>')
                    ->addClass('btn btn-outline-info show-modal-form '. (canUser("$this->table-create") ? "" : "remove-hidden-element"))
                    ->titleAttr(trans('menu.create-row', ['model' => trans('menu.'.Str::singular($this->table))]));

        } else {
            return Button::make()->text('<i class="fa fa-plus"></i>')
                    ->addClass('btn btn-outline-info '. (canUser("$this->table-create") ? "" : "remove-hidden-element"))
                    ->action("window.location.href = window.location.href+'/create'")
                    ->titleAttr(trans('menu.create-row', ['model' => trans('menu.'.Str::singular($this->table))]));
        }
    }

    public function getDeleteButton()
    {
        return Button::make()
                        ->text('<i class="fas fa-trash"></i>')
                        ->addClass('btn btn-outline-danger multi-delete '. (canUser($this->table."-multidelete") ? "" : "remove-hidden-element"))
                        ->titleAttr(trans('buttons.multi-delete'));

    }

    public function getPageLengthButton()
    {
        return Button::make('pageLength')
                        ->text('<i class="fa fa-sort-numeric-up"></i>')
                        ->addClass('btn btn-outline-light page-length')
                        ->titleAttr(trans('buttons.page-length'));
    }

    public function getImportButton()
    {
        return Button::make()
                    ->text('<i class="fa fa-cloud-upload"></i> <span class="hidden" data-yajra-href="'.routeHelper($this->table.'.excel.import.form').'"></span>')
                    ->addClass('btn btn-outline-primary show-modal-form'. (canUser($this->table."-import") ? "" : "remove-hidden-element"))
                    ->titleAttr('Import '.$this->table);
    }

    public function getExportButton()
    {
        return Button::make()->text('<i class="fas fa-cloud-download"></i>')
                        ->action("window.location.href = '". routeHelper($this->table.'.excel.export') ."'")
                        ->addClass('btn btn-outline-info '. (canUser($this->table."-export") ? "" : "remove-hidden-element"))
                        ->titleAttr(trans('buttons.export-excel'));
    }

    public function getSearchButton()
    {
        return Button::make()
                    ->text('<i class="fa fa-search"></i> <span class="hidden" data-yajra-href="'.routeHelper($this->table.'.search.form').'"></span>')
                    ->addClass('btn btn-outline-warning show-search-form '. (request()->has('search') ? 'hidden' : ''))
                    ->titleAttr('Open Search Form');
    }

    public function getCloseButton()
    {
        return Button::make()
                    ->text('<i class="fa fa-times"></i>')
                    ->addClass('btn btn-outline-warning close-search-button '. (request()->has('search') ? '' : 'hidden'))
                    ->titleAttr('Close Search Form');
    }
}
