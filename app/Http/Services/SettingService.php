<?php

namespace App\Http\Services;

use App\Constants\SettingType;
use App\Models\Setting;
use Exception;

class SettingService
{
    public $ContentType;

    public function __construct()
    {
        $this->ContentType = new SettingType();
    }

    public function handle($request, $id = null)
    {
        try {
            if (isset($request['value']))
                $request['value'] = $this->ContentType->requestHandler($request);

            return Setting::updateOrCreate(['id' => $id],$request);
        } catch (Exception $e) {
            return $e;
        }
    }
}
