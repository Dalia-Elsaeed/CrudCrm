<?php

namespace App\Http\Controllers;

use Crm\Users\Requests\UserCreation;
use Crm\Users\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    private UserService $userService;
    const TOKEN_NAME= 'personal';

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(UserCreation $request)
    {
        $user = $this->userService->create($request);

        $user->api_token = Str::random(60);
        $user->save();

        return response()->json(
            [
                'user'=> $user,
                'token' => $user->api_token
            ]
        );
    }
}
