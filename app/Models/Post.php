<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['published_date', 'active', 'url', 'content_id', 'operator_id', 'user_id'];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter(Builder $builder)
    {
        return $builder->when(request('content'), function($query) {
            return $query->where('content_id', request('content'));
        });
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('published_date', 'DESC')->orderBy('operator_id', 'ASC');
        });

        self::creating(function($model) {
            $model->user_id = auth()->id();
            $model->url = "content/$model->content_id/operator/$model->operator_id/post/$model->id";
        });

        self::updating(function($model) {
            $model->url = "content/$model->content_id/operator/$model->operator_id/post/$model->id";
        });
    }
}
