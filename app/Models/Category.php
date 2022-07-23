<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Category extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'categories';

    protected $fillable = ['name', 'image', 'parent_id'];

    public $translatable = ['name'];

    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function subs()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value && file_exists('uploads/categories/' . $value) ? "uploads/categories/$value" : null,
        );
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->getName(),
        );
    }

    public function getName($lang = null)
    {
        $lang = $lang ?? app()->getLocale();
        return $this->getTranslations('name')[$lang] ?? '';
    }

    public function slug()
    {
        return $this->name;
    }

    public function scopeFilter($query)
    {
        $query->where('parent_id', request()->category);
        return $query;
    }
}
