<?php

namespace App\Http\Services;

use Exception;
use App\Models\Client;

class ClientService {

    public function handle($request, $id = null)
    {
        try {
            $row = Client::updateOrCreate(['id' => $id], $request);
            return $row;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
