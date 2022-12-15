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
            if( isset($request['image']) && $request['image'] )
                $request['image'] = $this->uploadImage($request['image'], 'announcements');

            $request['open_type'] = $request['open_type'] ?? false;
            $row = Announcement::updateOrCreate(['id' => $id], $request);
            return $row;
        } catch (Exception $e) {
            return $e;
        }
    }
}
