<?php

namespace App\Models\RBT;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttachmentType extends Model
{
    use HasFactory;

    protected $table = 'employee_attachment_types';

    protected $fillable = ['email', 'active', 'name', 'desc', 'image', 'audio', 'video', 'attachment', 'user_id'];
    
	protected $timestamps = false;

    public function slug()
    {
        return $this->id;
    }
    
	public function user() { 
		return $this->belongsTo(App\Models\User::class)->withDefault(['id' => null]); 
	}

    public function scopeFilter($query)
    {
        return $query;
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderDesc', function (Builder $builder) {
            $builder->orderBy('id', 'DESC');
        });
    }
}