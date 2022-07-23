<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'countries';

    protected $fillable = ['name'];

    public $translatable = ['name'];

    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function operators()
    {
        return $this->hasMany(Operator::class);
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
}
