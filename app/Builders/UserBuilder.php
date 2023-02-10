<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class UserBuilder extends Builder
{
    public function withRole($role)
    {
        return $this->whereHas('roles', function($query) use($role) {
            return $query->where('name', 'LIKE', "%$role%");
        });
    }

    public function hasManager()
    {
        return $this->when(! isSuperAdmin(), function($query) {
            $query->whereHas('department', function($query) {
                $query->where('manager_id', auth()->id());
            });
        });
    }

    public function exceptAuth()
    {
        return $this->where('id', '!=', auth()->id());
    }

    public function filter()
    {
        return $this->when(request()->get('department'), function ($query) {
                        return $query->where('department_id', request('department'));
                    })->when(request()->get('name'), function ($query) {
                        return $query->where('name', 'LIKE', "%".request()->get('name')."%");
                    })->when(request()->get('email'), function ($query) {
                        return $query->where('email', 'LIKE', "%".request()->get('email')."%");
                    })->when(request()->get('id'), function ($query) {
                        return $query->where('id', request()->get('id'));
                    });
    }
}
