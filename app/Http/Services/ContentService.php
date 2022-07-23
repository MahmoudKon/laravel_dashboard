<?php

namespace App\Http\Services;

use App\Constants\ContentType;
use App\Models\Content;
use App\Traits\UploadFile;
use Exception;

class ContentService {
    use UploadFile;

    public $ContentType;

    public function __construct()
    {
        $this->ContentType = new ContentType();
    }

    public function handle($request, $id = null)
    {
        try {
            $response = [];
            if(isset($request['data']) || isset($request['image'])) {
                $response = $this->ContentType->requestHandler($request['content_type_id'], $request);
                unset($request['data']);
            }

            if (isset($request['image'])) {
                $request['video_thumb'] = $this->uploadImage($request['image'], 'contents');
                unset($request['image']);
            }

            return Content::updateOrCreate(['id' => $id], array_merge($request, $response));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
