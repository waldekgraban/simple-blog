<?php

namespace App\Http\Repositories;

use App\Models\User;

interface RoleRepositoryInterface
{
    public function setToNewUserDefaultRole(User $user): void;
    public setToNewUserSpecyficRole(User $user, string $specyficRole): void
}