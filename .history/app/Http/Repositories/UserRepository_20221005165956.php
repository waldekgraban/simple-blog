<?php

namespace App\Http\Repositories;

use App\Models\User;
use App\Models\Role;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository implements UserRepositoryInterface
{
    private RoleRepositoryInterface $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function create(RegisterRequest $request): User
    {
        $userData = $request->validated();
        $rowPassword = Arr::get($userData, 'password');
        $rowPasswordConfirmation = Arr::get($userData, 'password_confirmation');
        
        $user = new User();
        $user->password = $this->getHashedPassword($rowPassword, $rowPasswordConfirmation);
        $user->email = Arr::get($userData, 'email');
        $user->username = Arr::get($userData, 'username');
        $user->save();

        $this->roleRepository->setToNewUserDefaultRole($user);

        return $user;
    }

    private function getHashedPassword(string $rowPassword, string $rowPasswordConfirmation): string
    {
        if($this->isPasswordConfirmed($rowPassword, $rowPasswordConfirmation)) {
            return Hash::make($rowPassword);
        }
    }

    private function isPasswordConfirmed(string $rowPassword, string $rowPasswordConfirmation): bool
    {
        return $rowPassword === $rowPasswordConfirmation;
    }

    public function updatePassword(array $details): void
    {
        User::where('email', $details['email'])
            ->update(['password' => $this->getHashedPassword($details['password'], $details['password_confirmation'])]);
    }

    public function hasUserAllowsLoginRule(User $user): bool
    {
        return in_array($user->role->name, Role::LOGIN_ALLOWS_ROLE);
    }

    public function getAllPaginatedUsers(): LengthAwarePaginator
}