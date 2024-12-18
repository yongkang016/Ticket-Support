<?php

namespace App\Http\Controllers;

use App\Constants\WebRouteName;
use App\Http\Requests\User\RegisterRequest;
use App\Services\UserService;

class RegisterController extends Controller
{
    public function registerIndex()
    {
        // Return the login view
        return view('/pages/user.register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        //        validated from class RegisterRequest extends **FormRequest**

        $data['role'] = 'Client';

        $registerService = app(UserService::class);
        //        dd($request,$data);
        $registerService->create($data);

        return redirect()->route(WebRouteName::WEB_ROUTE_LOGIN_INDEX)
            ->with('success', 'User created successfully.');

    }
}
