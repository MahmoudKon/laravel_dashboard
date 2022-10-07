<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $table = 'emails';

    public $fillable = ['subject', 'body', 'to', 'cc', 'model', 'view', 'ids', 'notifier_id'];

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function notifier()
    {
        return $this->belongsTo(User::class, 'notifier_id', 'id')->select('id', 'name', 'image')->withDefault(['name' => 'System', 'image' => null]);
    }

    public function recipients()
    {
        return $this->belongsToMany(User::class, 'email_recipient', 'email_id', 'recipient_id')->withPivot(['seen', 'email_id', 'recipient_id']);
    }

    public function isSeen()
    {
        return $this->notifier_id == auth()->id() || $this->recipients()->where('recipient_id', auth()->id())->first()?->pivot?->seen;
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->diffForHumans(),
        );
    }

    public function to(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => is_array($value) ? implode(',', $value) : $value
        );
    }

    public function cc(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => is_array($value) ? implode(',', $value) : $value
        );
    }

    public function updateSeen()
    {
        $this->recipients()->updateExistingPivot(auth()->id(), ['seen' => true, 'seen_time' => now()]);
    }

    public function scopeFilter($query)
    {
        return $query->search(request()->search)->sender()
                    ->seen(request()->seen);
    }

    public function scopeSeen($query, $seen = null, $is_sender = false)
    {
        return $query->when(request()->type != 'sent', function($query) use($seen, $is_sender) {
                    $query->whereHas('recipients', function($query) use($seen, $is_sender) {
                        $query->where('recipient_id', auth()->id())
                                ->where('is_sender', $is_sender)
                                ->when($seen !== null, function($query) use($seen) {
                                    $query->where('seen', $seen);
                                });
                    });
                });
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query) use ($search) {
            return $query->where('subject', 'like', "%$search%");
        });
    }

    public function scopeSender($query)
    {
        return $query->when(request()->type == 'sent', function($query) {
                    $query->whereHas('recipients', function($query) {
                        $query->where(['recipient_id' => auth()->id(), 'is_sender' => true]);
                    });
                });
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('id', 'DESC');
        });

        self::creating(function($model) {
            $model->notifier_id = auth()->id();
        });
    }
}
