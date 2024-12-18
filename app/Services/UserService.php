<?php

namespace App\Services;

use App\Constants\WebRouteName;
use App\Models\User;

class UserService
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(User $user, array $data): bool
    {
        return $user->update($data);
    }

    public function delete(User $user): bool
    {
        if ($user->projectsUnderStaff()->exists() || $user->projectsSubmittedByClient()-> exists()) {
            return false;
        }
        return $user->delete();
    }
}
