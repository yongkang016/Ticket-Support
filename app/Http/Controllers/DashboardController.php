<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController
{
    public function index()
    {


        /** @var User $user */
        $user = Auth::user();
//        $user->removeRole(\App\Constants\Role::ADMIN);/
//        $user->assignRole(\App\Constants\Role::ADMIN);

        //dd($user->getRoleNames(), $user);

        // Return the dashboard view
        return view('/pages/dashboard.dashboard', [
            'title' => 'xxx'
        ]);
    }
}
