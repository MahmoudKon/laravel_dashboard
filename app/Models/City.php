<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'cities';

    protected $fillable = ['name', 'governorate_id'];

    protected $with = ['governorate'];

    public $translatable = ['name'];

    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
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

    public function scopeFilter($query)
    {
        return $query->when(request()->governorate, function($query) {
            $query->where('governorate_id', request()->governorate);
        });
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class, 'governorate_id', 'id')->select('id', 'name');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('governorate_id', 'ASC')->orderBy('id', 'DESC');
        });
    }
}
