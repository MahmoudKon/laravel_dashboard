<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ClientDataTable;
use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Services\ClientService;
use App\Http\Requests\ClientRequest;

class ClientController extends BackendController
{
    public $full_page_ajax  = false;
    public $use_form_ajax   = false;
    public $use_button_ajax = false;

    public function __construct(ClientDataTable $dataTable, Client $Client)
    {
        parent::__construct($dataTable, $Client);
    }

    public function store(ClientRequest $request, ClientService $ClientService)
    {
        $row = $ClientService->handle($request->validated());
        if (is_string($row)) return $this->throwException($row);
        return $this->redirect("Row Created Successfully!");
    }

    public function update(ClientRequest $request, ClientService $ClientService, $id)
    {
        $row = $ClientService->handle($request->validated(), $id);
        if (is_string($row)) return $this->throwException($row);
        return $this->redirect("Row Updated Successfully!");
    }

    public function append(): array
    {
        return [
            
			'users' => \App\Models\User::pluck('name', 'id'),
			'departments' => \App\Models\Department::pluck('title', 'id'),
        ];
    }

    public function query($id) :object|null
    {
        return $this->model::find($id);
    }
}
