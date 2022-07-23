<?php

namespace App\Http\Services;

use App\Models\Post;
use Exception;

class PostService {

    public function handle($request, $id = null)
    {
        try {
            return Post::updateOrCreate(['id' => $id], $request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
