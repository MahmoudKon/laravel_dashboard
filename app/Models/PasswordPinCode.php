<?php

namespace App\Models;

use App\Mail\ForgetPassword;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class PasswordPinCode extends Model
{
    protected $table = 'password_pin_codes';

    protected $fillable = ['email', 'pincode', 'expired'];

    public $timestamps = ["created_at"];

    const UPDATED_AT = null;

    public function scopeNotExpired($query)
    {
        return $query->where('created_at', '>=', now()->subHour())->where('expired', false);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('id', 'DESC');
        });

        static::created(function($model) {
            PasswordPinCode::where('email', $model->email)->where('pincode', '!=', $model->pincode)->update(['expired' => true]);
            Mail::send(new ForgetPassword($model));
        });
    }
}
