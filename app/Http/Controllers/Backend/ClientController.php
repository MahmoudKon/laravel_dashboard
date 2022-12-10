<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ClientDataTable;
use App\Http\Controllers\BackendController;
use App\Models\Client;
use App\Http\Services\ClientService;
use App\Http\Requests\ClientRequest;

class ClientController extends BackendController
{
    public $use_form_ajax   = true;
    public $use_button_ajax = true;

    public function store(ClientRequest $request, ClientService $ClientService)
    {
        $row = $ClientService->handle($request->validated());
        if (is_string($row)) return $this->throwException($row);
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.client')]));
    }

    public function update(ClientRequest $request, ClientService $ClientService, $id)
    {
        $row = $ClientService->handle($request->validated(), $id);
        if (is_string($row)) return $this->throwException($row);
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.client')]));
    }

    public function model() { return new Client; }

    public function dataTable() { return new ClientDataTable; }
}
