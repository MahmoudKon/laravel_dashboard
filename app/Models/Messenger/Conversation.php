<?php

namespace App\Models\Messenger;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'type', 'image', 'user_id', 'last_message_id'];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value && file_exists('uploads/conversations/' . $value) ? asset("uploads/conversations/$value") : 'https://toppng.com/uploads/preview/conversation-icon-png-conversations-ico-11569054775fl5rx1ikvw.png',
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select('id', 'name', 'email', 'image')->withDefault(['name' => '', 'email' => '', 'image' => '']);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'conversation_user')->withPivot(['joined_at', 'role']);
    }

    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('created_at', 'DESC');
    }

    public function lastMessage()
    {
        return $this->belongsTo(Message::class, 'last_message_id')->with('user')->withDefault();
    }

    public function scopeOnlyWithAuth($query)
    {
        return $query->whereHas('users', function($query) {
                    $query->where('user_id', auth()->id());
                });
    }
}
