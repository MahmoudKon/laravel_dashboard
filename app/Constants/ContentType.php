<?php

namespace App\Constants;

use App\Traits\UploadFile;

class ContentType {
    use UploadFile;

    const ADVANCED_TEXT = 1;
    const NORMAL_TEXT   = 2;
    const IMAGE         = 3;
    const AUDIO         = 4;
    const VIDEO         = 5;
    const EXTERNAL_LINK = 6;
    const FILE          = 10;

    public static function viewHandler(int $type_id) :string
    {
        $view_path = '';
        switch ($type_id) {
            case self::ADVANCED_TEXT:
                $view_path = 'backend.contents.inputs.advanced_text';
                break;

            case self::NORMAL_TEXT:
                $view_path = 'backend.contents.inputs.normal_text';
                break;

            case self::IMAGE:
                $view_path = 'backend.contents.inputs.image';
                break;

            case self::AUDIO:
                $view_path = 'backend.contents.inputs.audio';
                break;

            case self::VIDEO:
                $view_path = 'backend.contents.inputs.video';
                break;

            case self::EXTERNAL_LINK:
                $view_path = 'backend.contents.inputs.external_link';
                break;

            default:
                $view_path = 'backend.contents.inputs.image';
                break;
        }
        return $view_path;
    }

    public static function validaionHandler(int $type_id) :array
    {
        $validations = [];
        switch ($type_id) {
            case self::ADVANCED_TEXT:
                foreach (config('languages') as $lang) {
                    $validations["data"] = 'nullable|array|min:1';
                    $validations["data.$lang"] = 'nullable|string';
                }
                break;

            case self::NORMAL_TEXT:
                foreach (config('languages') as $lang) {
                    $validations["data"] = 'nullable|array|min:1';
                    $validations["data.$lang"] = ($lang == app()->getLocale() ? 'required' : 'nullable').'|string';
                }
                break;

            case self::IMAGE:
                $validations['data'] = 'required_without:id|image|mimes:png,jpg,jpeg';
                break;

            case self::AUDIO:
                $validations['data'] = 'required_without:id|mimes:mp3';
                break;

            case self::VIDEO:
                $validations['image'] = 'nullable|image|mimes:png,jpg,jpeg';
                $validations['data'] = 'required_without:id|mimes:mp4';
                break;

            case self::EXTERNAL_LINK:
                $validations['data'] = 'required|url';
                break;
        }
        return $validations;
    }

    public function requestHandler(int $type_id, array $request) :array
    {
        $response = [];
        switch ($type_id) {
            case self::ADVANCED_TEXT:
            case self::NORMAL_TEXT:
            case self::EXTERNAL_LINK:
                $response['data'] = $request['data'];
                break;

            case self::IMAGE:
                [$width, $height] = getimagesize($request['value']);
                $response = $this->uploadImage($request['value'], 'contents', $width, $height);
                break;

            case self::AUDIO:
            case self::FILE:
                $response = $this->uploadImage($request['value'], 'contents');
                break;

            case self::VIDEO:
                    $response['data'] = $this->uploadImage($request['data'], 'contents');
                    $response['video_thumb'] = $this->videoImagePreview($response['data'], 'contents');
                break;
        }

        return $response;
    }

    public static function dataHandler(int $type_id, $data)
    {
        $response = '';
        switch ($type_id) {
            case self::ADVANCED_TEXT:
            case self::NORMAL_TEXT:
            case self::EXTERNAL_LINK:
                $response = $data;
                break;

            case self::IMAGE:
            case self::AUDIO:
            case self::VIDEO:
                $response = "uploads/contents/$data";
                break;
        }

        return $response;
    }

    public static function displatHtmlHandler(int $type_id, $data, $folder = '')
    {
        $view_path = '';
        switch ($type_id) {
            case self::ADVANCED_TEXT:
            case self::EXTERNAL_LINK:
            case self::NORMAL_TEXT:
                $view_path = $data;
                break;

            case self::IMAGE:
                $view_path = view('backend.includes.content_types.image', ['image' => "uploads/$folder$data"])->render();
                break;

            case self::AUDIO:
                $view_path = view('backend.includes.content_types.audio', ['audio' => "uploads/$folder$data"])->render();
                break;

            case self::VIDEO:
                $view_path = view('backend.includes.content_types.video', ['video' => "uploads/$folder$data"])->render();
                break;
        }
        return $view_path;
    }
}
