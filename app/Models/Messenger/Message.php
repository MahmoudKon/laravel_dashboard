<?php

namespace App\Models\Messenger;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['message', 'type', 'conversation_id', 'user_id'];

    protected $with = ['user'];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->diffForHumans(),
        );
    }

    protected function message(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->type == 'text' ? $value : asset("uploads/messages/$value"),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'name', 'email', 'image')->withDefault(['name' => 'User', 'email' => 'User', 'image' => '']);
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class)->withDefault(['label' => '']);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'message_user')->withPivot(['read_at', 'deleted_at']);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function($model) {
            $model->conversation->update(['last_message_id' => $model->conversation->messages()->latest()->id]);
        });
    }
}
