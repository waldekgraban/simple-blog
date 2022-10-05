<?php

namespace App\Http\Repositories;

use App\Models\PasswordReset;
use Illuminate\Support\Arr;

class ForgotPasswordRepository extends Repository implements ForgotPasswordRepositoryInterface
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function logForgotPasswordToDB(array $details): void
    {
        $reset = new PasswordReset();

        $reset->email = Arr::get($details, 'email');
        $reset->token = Arr::get($details, 'token');

        $reset->save();
    }

    public function updateResetPassword(array $details): bool
    {
        if(!$this->isResetPasswordValid($details)){
            return false;
        }

        $this->userRepository->updatePassword($details);
        
        return true;
    }

    public function isResetPasswordValid($details): bool
    {
        return PasswordReset::where('email', '=', $details['email'])->first()
            ? true
            : false;
    }

    public function removePasswordResetLogAfterOperation($details): void
    {
        PasswordReset::where(['email'=> $details['email']])->delete();
    }
}