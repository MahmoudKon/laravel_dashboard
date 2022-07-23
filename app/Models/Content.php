<?php

namespace App\Models;

use App\Constants\ContentType as ConstantsContentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Content extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'contents';

    protected $fillable = ['title', 'data', 'video_thumb', 'content_type_id', 'category_id', 'patch_number'];

    public $translatable = ['title', 'data'];

    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function contentType()
    {
        return $this->belongsTo(ContentType::class, 'content_type_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    protected function videoThumb(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value && file_exists("uploads/contents/$value") ? "uploads/contents/$value" : null,
        );
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getTitle(),
        );
    }

    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getData(),
        );
    }

    public function getTitle($lang = null)
    {
        $lang = $lang ?? app()->getLocale();
        return $this->getTranslations('title')[$lang] ?? '';
    }

    public function getData($lang = null)
    {
        $lang = $lang ?? app()->getLocale();
        $data = $this->getTranslations('data')[$lang] ?? '';
        return ConstantsContentType::dataHandler($this->content_type_id, $data);
    }

    public function getDataHtml($lang = null)
    {
        $lang = $lang ?? app()->getLocale();
        $data = $this->getTranslations('data')[$lang] ?? '';
        return ConstantsContentType::displatHtmlHandler($this->content_type_id, $data, 'contents/');
    }

    public function slug()
    {
        return $this->title;
    }
}
