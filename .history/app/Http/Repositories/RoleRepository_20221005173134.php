<?php

namespace App\Http\Repositories;

use App\Models\User;
use App\Models\Role;

class RoleRepository extends Repository implements RoleRepositoryInterface
{
    public function setToNewUserDefaultRole(User $user): void
    {
        $defaultUserRole = Role::where('name', Role::USER_ROLE)->first();

        $user->role()->associate($defaultUserRole)->save();
    }

    public setToNewUserSpecyficRole(User $user, string $specyficRole): void
    {
        $defaultUserRole = Role::where('name', $specyficRole)->first();

        $user->role()->associate($defaultUserRole)->save();
    }
}