<?php

namespace App\Http\Services;

use App\Models\Category;
use App\Traits\UploadFile;
use Exception;

class CategoryService {
    use UploadFile;

    public function handle($request, $id = null)
    {
        try {
            if(isset($request['image'])) {
                $request['image'] = $this->uploadImage($request['image'], 'categories');
            }

            return Category::updateOrCreate(['id' => $id],$request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
