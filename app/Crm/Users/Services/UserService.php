<?php

namespace Crm\Users\Services;

use Crm\Users\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function create($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->save();

        return $user;
    }
}
