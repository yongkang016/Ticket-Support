<?php

namespace App\Http\Controllers;


use App\Constants\WebRouteName;
use App\Http\Requests\User\LoginRequest;
use App\Services\LoginServices;


class LoginController extends Controller
{
    public function loginIndex()
    {
        // Return the login view
        return view('/pages/user.login');
    }


    public function login(LoginRequest $request)
    {
        // Retrieve the email and password input
        $input = $request->only('email', 'password');

        // Call the UserServices to handle authentication
        $userService = app(LoginServices::class);
        $user = $userService->authenticate($input);

        if ($user) {
            // Login successful
            return redirect()->route(WebRouteName::WEB_ROUTE_TICKET_INDEX);
             // Redirect to the dashboard
        } else {
            // Login failed
            return redirect()->route(WebRouteName::WEB_ROUTE_LOGIN_INDEX)
                ->with('failed', 'Login Failed. Account does not exist.');
           // Redirect back with input
        }
    }

}
