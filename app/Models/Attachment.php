<?php

namespace App\Models;

use App\Traits\UploadFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Attachment extends Model
{
    use UploadFile;

    protected $fillable = ['email_id', 'attachment', 'info'];

    public $timestamps = false;

    public function email()
    {
        return $this->belongsTo(Email::class);
    }

    protected function attachment(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value && Storage::disk('public')->exists( 'uploads/emails/' . $value ) ? 'storage/uploads/emails/' . $value : null,

        );
    }

    protected function info(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value),
            set: fn ($value) => json_encode($value, true),
        );
    }

    public function upload($attachment)
    {
        return $this->uploadImage($attachment, 'emails', null);;
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderDesc', function (Builder $builder) {
            $builder->orderBy('id', 'DESC');
        });
    }
}
