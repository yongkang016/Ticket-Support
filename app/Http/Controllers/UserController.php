<?php

namespace App\Http\Controllers;

use App\Constants\Role;
use App\Constants\WebRouteName;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Requests\User\UserDeleteRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userIndex(Request $userRequest)
    {
        //$data = User::all();

        // Retrieve filters from the request
        $filters = $userRequest->only('name');

        // Apply filters using the scopeFilter method in your User model
        $data = User::query()->filter($filters)->get();

        return view('/pages/user.userDashboard', [
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('/pages/user.userCreate', [
            'method' => 'POST',
            'model' => new User(),
            'action' => route(WebRouteName::WEB_ROUTE_USER_STORE),
        ]);
    }


    public function store(RegisterRequest $request)
    {
        $data = $request->validated();
        //        validated from class RegisterRequest extends **FormRequest**

        $role_id = $data['role'];
        $FindRole = \App\Models\Role::query()->find($role_id);
        $roleMapping = Role::selection();

        // Replace the numeric role with the mapped string value
        if (isset($data['role']) && array_key_exists($data['role'], $roleMapping)) {
            $role = $roleMapping[$data['role']];
        }




        $registerService = app(UserService::class);
        $user = $registerService->create($data);

        // Assign the role to the user
        if ($user && $FindRole) {
            $user->assignRole($FindRole);
        }

        return redirect()->route(WebRouteName::WEB_ROUTE_USER_INDEX)
            ->with('success', 'User created successfully.');

    }

    public function update(UserUpdateRequest $request)
    {
        $data = $request->validated();

        $data['role'] = $data['roleUpdate'];

        /** @var UserService $userService */
        $userService = app(UserService::class);

        $user_id = \App\Models\User::findOrFail($data['id']);

        // Call a service to handle the update logic
        $result = $userService->update($user_id, $data);

        if ($result) {
            return redirect()->route(WebRouteName::WEB_ROUTE_USER_INDEX)->with('success', 'User updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update user.');
        }
    }

    public function delete(UserDeleteRequest $request)
    {
        // Validate the incoming request data
        $data = $request->validated();

        /** @var UserService $userService */
        $userService = app(UserService::class);

        // Find the user to be deleted
        $user = \App\Models\User::findOrFail($data['id']);

        // Call the service to delete the user
        $result = $userService->delete($user);

        if ($result) {
            return redirect()->route(WebRouteName::WEB_ROUTE_USER_INDEX)
                ->with('success', 'User deleted successfully.');
        } else {
            return redirect()->back()
                ->withErrors([
                    'custom_errors' =>
                    'Failed to delete the user.  The user has associated projects/ticket.'
                    //Key => value
                ]);
        }
    }

}
