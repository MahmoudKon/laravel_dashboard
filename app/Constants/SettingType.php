<?php

namespace App\Constants;

use App\Models\ContentType;
use App\Traits\UploadFile;
use Carbon\Carbon;

class SettingType {
    use UploadFile;

    public static $type_name = null;
    const ADVANCED_TEXT = "Advanced Text";
    const NORMAL_TEXT   = "Normal Text";
    const IMAGE         = "Image";
    const AUDIO         = "Audio";
    const VIDEO         = "Video";
    const EXTERNAL_LINK = "External Link";
    const SELECT        = "Select";
    const TIME          = "Time";
    const WEEKEND_DAYS  = "Weekend Days";
    const FILE          = "File";
    const DATE          = "Date";
    const LANGUAGES     = "Languages";
    const PATH          = "uploads/settings/";
    const VIEW_PATH     = "backend.includes.components.";

    public static function viewHandler(int $type_id) :string
    {
        self::$type_name = ContentType::findOrFail($type_id)->name ?? null;
        $view_path = '';
        switch (self::$type_name) {
            case self::ADVANCED_TEXT:
                $view_path = self::VIEW_PATH.'advanced_text';
                break;

            case self::NORMAL_TEXT:
                $view_path = self::VIEW_PATH.'normal_text';
                break;

            case self::IMAGE:
                $view_path = self::VIEW_PATH.'image';
                break;

            case self::AUDIO:
                $view_path = self::VIEW_PATH.'audio';
                break;

            case self::VIDEO:
                $view_path = self::VIEW_PATH.'video';
                break;

            case self::EXTERNAL_LINK:
                $view_path = self::VIEW_PATH.'external_link';
                break;

            case self::SELECT:
                $view_path = self::VIEW_PATH.'select';
                break;

            case self::TIME:
                $view_path = self::VIEW_PATH.'time';
                break;

            case self::DATE:
                $view_path = self::VIEW_PATH.'date';
                break;

            case self::WEEKEND_DAYS:
                $view_path = self::VIEW_PATH.'weekend_days';
                break;

            case self::FILE:
                $view_path = self::VIEW_PATH.'file';
                break;

            case self::LANGUAGES:
                $view_path = self::VIEW_PATH.'languages';
                break;
        }
        return $view_path;
    }

    public static function validaionHandler(int $type_id) :array
    {
        self::$type_name = ContentType::findOrFail($type_id)->name ?? null;
        $validations = [];
        $validation = request()->route('setting') ? "nullable" : "required";

        switch (self::$type_name) {
            case self::ADVANCED_TEXT:
            case self::NORMAL_TEXT:
                $validations["value"] = 'required|string';
                break;

            case self::LANGUAGES:
                $validations["value"] = 'required|string|in:'. implode(',', config('languages'));
                break;

            case self::IMAGE:
                $validations["value"] = "$validation|image|mimes:png,jpg,jpeg";
                break;

            case self::AUDIO:
                $validations['value'] = "$validation|mimes:mp3,wav";
                break;

            case self::VIDEO:
                $validations['value'] = "$validation|mimes:mp4";
                break;

            case self::EXTERNAL_LINK:
                $validations['value'] = 'required|url';
                break;

            case self::SELECT:
                $validations['value'] = 'required|boolean';
                break;

            case self::TIME:
            case self::DATE:
                $validations['value'] = 'required';
                break;

            case self::WEEKEND_DAYS:
                $validations['value'] = 'required|array';
                $validations['value.*'] = 'required|between:0,6';
                break;

            case self::FILE:
                $validations['value'] = "$validation|file|mimes:xlsx,csv,xls,pdf,doc,docx,jpeg,png";
                break;
        }

        return $validations;
    }

    public function requestHandler(array $request) :string
    {
        self::$type_name = ContentType::findOrFail($request['content_type_id'])->name ?? null;

        $response = [];
        switch (self::$type_name) {
            case self::ADVANCED_TEXT:
            case self::NORMAL_TEXT:
            case self::EXTERNAL_LINK:
            case self::TIME:
            case self::DATE:
            case self::SELECT:
            case self::LANGUAGES:
                $response = $request['value'];
                break;

            case self::IMAGE:
            case self::AUDIO:
            case self::VIDEO:
            case self::FILE:
                [$width, $height] = getimagesize($request['value']);
                $response = $this->uploadImage($request['value'], 'settings', $width, $height, true);
                break;

            case self::WEEKEND_DAYS:
                $response = implode(',', $request['value']);
                break;
        }

        return $response;
    }

    public static function displatHtmlHandler(int $type_id, $value)
    {
        self::$type_name = ContentType::findOrFail($type_id)->name ?? null;

        $view_path = '';
        switch (self::$type_name) {
            case self::ADVANCED_TEXT:
            case self::NORMAL_TEXT:
            case self::DATE:
            case self::TIME:
            case self::LANGUAGES:
                $view_path = $value;
                break;

            case self::SELECT:
                $view_path = $value ? "TURE" : "FALSE";
                break;

            case self::WEEKEND_DAYS:
                foreach (explode(',', $value) as $day)
                    $view_path .= Carbon::getDays()[$day].", ";
                $view_path = rtrim($view_path, ', ');
                break;

            case self::EXTERNAL_LINK:
            case self::IMAGE:
            case self::AUDIO:
            case self::VIDEO:
            case self::FILE:
                $view_path = view(self::VIEW_PATH.'preview-button', compact('value'))->render();
            break;
        }

        return $view_path;
    }
}
