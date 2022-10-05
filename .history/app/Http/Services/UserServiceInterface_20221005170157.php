<?php

namespace App\Http\Services;

use App\Http\Requests\RegisterRequest;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    public function createUser(RegisterRequest $request): void;
    public function conditionalUserLogin(array $credentials): array;
    public function isCredentialsValidated(array $credentials): bool;
    public function isUserAllowToMenagePosts(): bool;
    public function isUserAllowToMenageUsers(): bool;
    public function getAllPaginatedUsers(): LengthAwarePaginator;
}