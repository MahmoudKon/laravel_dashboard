<?php

namespace App\Models;

use App\Constants\SettingType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = ['key', 'value', 'input_type_id', 'active', 'autoload'];

    public $timestamps = false;

    public function inputType()
    {
        return $this->belongsTo(InputType::class, 'input_type_id', 'id');
    }

    public function slug()
    {
        return $this->key;
    }

    protected function system(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => "System $value",
        );
    }

    public function value()
    {
        return SettingType::displatHtmlHandler($this->input_type_id, $this->value);
    }

    public function getDataHtml()
    {
        return SettingType::displatHtmlHandler($this->input_type_id, $this->value);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeAutoload($query)
    {
        $query->active()->where('autoload', true);
    }
}
