<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ClientDataTable;
use App\Http\Controllers\BackendController;
use App\Models\Client;
use App\Http\Services\ClientService;
use App\Http\Requests\ClientRequest;
use Exception;

class ClientController extends BackendController
{
    public bool $use_form_ajax   = true;
    public bool $use_button_ajax = true;

    public function store(ClientRequest $request, ClientService $ClientService)
    {
        $row = $ClientService->handle($request->validated());
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.client')]));
    }

    public function update(ClientRequest $request, ClientService $ClientService, $id)
    {
        $row = $ClientService->handle($request->validated(), $id);
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.client')]));
    }

    public function model() :\Illuminate\Database\Eloquent\Model { return new Client; }

    public function dataTable() :\Yajra\DataTables\Services\DataTable { return new ClientDataTable; }
}
