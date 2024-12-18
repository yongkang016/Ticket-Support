<?php

namespace App\Services;


class LoginServices
{
    public function authenticate(array $input)
    {
        if (auth()->attempt($input)) {

            return auth()->user(); // Returns the authenticated user
        }

        return null; // Authentication failed

    }
}
