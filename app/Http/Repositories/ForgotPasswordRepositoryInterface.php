<?php

namespace App\Http\Repositories;

interface ForgotPasswordRepositoryInterface
{
    public function logForgotPasswordToDB(array $details): void;
    public function updateResetPassword(array $details): bool;
    public function isResetPasswordValid(array $details): bool;
    public function removePasswordResetLogAfterOperation($details): void;
}