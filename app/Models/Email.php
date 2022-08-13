<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Email extends Model
{
    use HasFactory;

    protected $table = 'emails';

    public $fillable = ['subject', 'body', 'to', 'cc', 'model', 'view', 'ids', 'who_saw', 'notifier_id'];

    protected $casts = ['who_saw' => 'array'];

    public function notifier()
    {
        return $this->belongsTo(User::class, 'notifier_id', 'id')->select('id', 'name', 'image')->withDefault(['name' => 'System', 'image' => null]);
    }

    public function isSeen()
    {
        return in_array(auth()->id(), $this->who_saw);
    }

    public function getWhoSawAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function setWhoSawAttribute($value)
    {
        $this->attributes['who_saw'] = implode(',', $value);
    }

    public function setToAttribute($value)
    {
        $this->attributes['to'] = is_array($value) ? implode(',', $value) : $value;
    }

    public function setCcAttribute($value)
    {
        $this->attributes['cc'] = is_array($value) ? implode(',', $value) : $value;
    }

    public function updateSeen()
    {
        if (! in_array(auth()->id(), $this->who_saw))
            DB::select("UPDATE `emails` SET who_saw = '".implode(',', getUniqueArray($this->who_saw, auth()->id()))."' WHERE `id` = $this->id");
    }

    public function scopeFilter($query)
    {
        return $query->sender()
                    ->search(request()->search)
                    ->seen(request()->seen)
                    ->when(request()->type != 'sent', function($query) {
                        $query->where(function($query) {
                            $query->onTo()->onCC();
                        });
                    });
    }

    public function scopeSeen($query, $seen)
    {
        return $query->when($seen !== null, function ($query) use ($seen) {
            $condition = $seen ? "" : "NOT";
            return $query->whereRaw("$condition FIND_IN_SET('".auth()->id()."', `who_saw`)");
        });
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query) use ($search) {
            return $query->where('subject', 'like', "%$search%");
        });
    }

    public function scopeOnCC($query)
    {
        return $query->orWhereRaw("FIND_IN_SET('".auth()->user()->email."', `cc`)");
    }

    public function scopeOnTo($query)
    {
        return $query->orWhereRaw("FIND_IN_SET('".auth()->user()->email."', `to`)");
    }

    public function scopeSender($query)
    {
        return $query->when(request()->type == 'sent', function($query) {
            $query->where('notifier_id', auth()->id());
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
            $model->who_saw     = [auth()->id()];
        });
    }
}
