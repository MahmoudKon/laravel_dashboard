<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Announcement extends Model
{
    use HasFactory;

    protected $table = 'announcements';

    protected $fillable = ['creator_id', 'title', 'desc', 'start_date', 'end_date', 'url', 'image', 'open_type', 'active'];

    protected $append = ['days'];

    protected $cast = ['start_date' => 'timestamp', 'end_date' => 'timestamp'];

    public function slug()
    {
        return "<a href='".routeHelper($this->getTable().'.edit', $this)."'>$this->title</a>";
    }

	public function creator()
	{
		return $this->belongsTo(User::class, 'creator_id', 'id')->select('name', 'id', 'email')->withDefault(['id' => null, 'name' => '']);
	}

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value && Storage::disk('public')->exists("uploads/announcements/$value") ? "storage/uploads/announcements/$value" : null,
        );
    }

    protected function startDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('Y-m-d H:i'),
        );
    }

    protected function endDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('Y-m-d H:i'),
        );
    }

    protected function days(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($this->end_date)->diffInDays(Carbon::parse($this->start_date)),
        );
    }

    public function formatDate($column)
    {
        return Carbon::parse($this->$column)->translatedFormat('l d,Y h:i a');
    }

    public function scopeActive($query)
    {
        return $query->whereActive(true);
    }

    public function scopeDisplay($query)
    {
        return $query->active()->where('start_date', '>=', today());
    }

    public function scopeFilter($query)
    {
        return $query->when(request()->get('title'), function($query) {
                    $query->where('title', 'LIKE', '%'.request()->get('title').'%')->orWhere('title', 'LIKE', '%'.request()->get('title').'%');
                });
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderDesc', function (Builder $builder) {
            $builder->orderBy('id', 'DESC');
        });
    }
}
