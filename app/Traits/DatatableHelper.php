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

    public function setCreateButton($table)
    {
        if (session('use_button_ajax')) {
            return Button::make()
                    ->text('<i class="fa fa-plus"></i> <span class="hidden" data-yajra-href="'.routeHelper($table.'.create').'"></span>')
                    ->addClass('btn btn-outline-info show-modal-form '. (canUser("$table-create") ? "" : "remove-hidden-element"))
                    ->titleAttr(trans('menu.create-row', ['model' => trans('menu.'.Str::singular($table))]));

        } else {
            return Button::make()->text('<i class="fa fa-plus"></i>')
                    ->addClass('btn btn-outline-info '. (canUser("$table-create") ? "" : "remove-hidden-element"))
                    ->action("window.location.href = window.location.href+'/create'")
                    ->titleAttr(trans('menu.create-row', ['model' => trans('menu.'.Str::singular($table))]));
        }
    }
}
