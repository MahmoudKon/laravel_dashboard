<?php

namespace App\Http\Services;

use App\Models\User;
use App\Traits\UploadFile;
use Exception;
use Illuminate\Support\Facades\DB;

class UserService
{
    use UploadFile;

    public function handle($request, $id = null)
    {
        try {
            DB::beginTransaction();
                $this->saveFiles($request);

                $user = User::updateOrCreate(['id' => $id],$request);

                $user->syncRoles($request['roles'] ?? []);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            return $e;
        }
    }

    protected function saveFiles(&$request)
    {
        foreach (request()->allFiles() as $key => $value) {
            if ($value && isset($request[$key]))
                $request[$key] = $this->uploadImage($value, (new User)->getTable(), 200, 200);
        }
    }
}
