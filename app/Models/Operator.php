<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Operator extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'operators';

    protected $fillable = ['name', 'country_id'];

    public $translatable = ['name'];

    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id')->select('id', 'name');
    }

    public function name($lang = null)
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
        return $query->when(request('country'), function ($query) {
            return $query->where('country_id', request('country'));
        });
    }
}
