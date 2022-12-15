<?php

namespace App\Http\Services;

use App\Models\User;
use App\Traits\UploadFile;
use Exception;
use Illuminate\Support\Facades\DB;

class UserService {
    use UploadFile;

    public function handle($request, $id = null)
    {
        try {
            DB::beginTransaction();
                if(request()->image) {
                    $image = $this->uploadImage(request()->image, 'users');
                    $request['image'] = $image;
                }

                if (is_null($request['password'])) unset($request['password']);

                $user = User::updateOrCreate(['id' => $id],$request);

                $user->syncRoles($request['roles'] ?? []);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            return $e;
        }
    }
}
