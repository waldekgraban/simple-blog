<?php

namespace App\Http\Repositories;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function create(RegisterRequest $request): User;
    public function updatePassword(array $details): void;
    public function hasUserAllowsLoginRule(User $user): bool;
    getAllPaginatedUsers
}