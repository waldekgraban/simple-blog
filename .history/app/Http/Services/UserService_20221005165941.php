<?php

namespace App\Http\Services;

use App\Models\User;
use App\Models\Role;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Repositories\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService extends Service implements UserServiceInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(RegisterRequest $request): void
    {    
        $user = $this->userRepository->create($request);

        $this->loginUser($user);
        $this->sendMailAfterRegistration($user);
    }

    private function loginUser(User $user): void
    {
        auth()->login($user);
    }

    private function sendMailAfterRegistration(User $user)
    {
        UserRegistered::dispatch($user);
    }

    public function conditionalUserLogin(array $credentials): array
    {
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        $isLoginAllowed = $this->userRepository->hasUserAllowsLoginRule($user);
        
        if($isLoginAllowed){
            $this->loginUser($user);
        }

        return $this->getOperationResult($user, $isLoginAllowed);
    }

    private function getOperationResult(User $user, bool $result): array
    {
        return ['user' => $user, 'result' => $result];
    }

    public function isCredentialsValidated(array $credentials): bool
    {
        return !Auth::validate($credentials)
            ? false
            : true;
    }

    public function isUserAllowToMenagePosts(): bool
    {
        $userRole = (Auth::check()) ? Auth::user()->role->name : null;

        return in_array($userRole, Role::LOGIN_ALLOWS_ROLE);
    }

    public function isUserAllowToMenageUsers(): bool
    {
        $userRole = (Auth::check()) ? Auth::user()->role->name : null;
        
        return $userRole == Role::ADMIN_ROLE;
    }

    public function getAllPaginatedUsers(): LengthAwarePaginator
    {
        return $this->userRepository->getAllPaginatedPosts();
    }
}