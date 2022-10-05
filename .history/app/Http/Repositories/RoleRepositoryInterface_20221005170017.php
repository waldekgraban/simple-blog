<?php

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface RoleRepositoryInterface
{
    public function setToNewUserDefaultRole(User $user): void;
    public function getAllPaginatedUsers(): LengthAwarePaginator
}