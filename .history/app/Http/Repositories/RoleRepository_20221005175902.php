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

    public function setToNewUserSpecyficRole(User $user, string $specyficRole): void
    {
        $specyficUserRole = Role::where('id', $specyficRole)->first();

        $user->role()->associate($specyficUserRole)->save();
    }
}