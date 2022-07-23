<?php

namespace App\Observers;

use App\Models\Category;
use App\Traits\UploadFile;

class CategoryObserver
{
    use UploadFile;

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\Category $category
     * @return void
     */
    public function updated(Category $category)
    {
        if ($category->isDirty('image')) {
            $this->remove($category->getOriginal('image'));
        }
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(Category $category)
    {
        $this->remove($category->image);
    }
}
