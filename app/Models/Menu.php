<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Spatie\Translatable\HasTranslations;

class Menu extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'menus';
    protected $fillable = ['name', 'route', 'icon', 'parent_id', 'order', 'color', 'visible'];
    public $translatable = ['name'];
    public $timestamps = false;

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
        return $this->hasMany(self::class, 'parent_id', 'id')->with('subs');
    }

    public function visibleSubs()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->getVisible()->with('visibleSubs');
    }

    public function scopeIsParent($query)
    {
        $query->whereNull('parent_id');
    }

    public function scopeGetVisible($query)
    {
        return $query->where('visible', 1);
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

    public function func()
    {
        return $this->route ? last(explode('.', $this->route)) : null;
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'ASC');
        });

        self::creating(function($model) {
            $model->order = Menu::max('order') + 1;
            Cache::forget('list_menus');
        });

        self::updating(function($model) {
            Cache::forget('list_menus');
        });
    }
}
