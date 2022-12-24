<?php

namespace App\Http\Services;

use Exception;
use App\Models\Announcement;
use App\Traits\UploadFile;

class AnnouncementService
{
    use UploadFile;

    public function handle($request, $id = null)
    {
        try {
            $this->saveFiles($request);

            return Announcement::updateOrCreate(['id' => $id], $request);
        } catch (Exception $e) {
            return $e;
        }
    }

    protected function saveFiles(&$request)
    {
        foreach (request()->allFiles() as $key => $value) {
            if ($value && isset($request[$key]))
                $request[$key] = $this->uploadImage($value, (new Announcement)->getTable(), 200, 200);
        }
    }
}
