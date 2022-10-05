<?php

namespace App\Http\Services;

use App\Http\Requests\ForgotPasswordEmailRequest;
use App\Http\Requests\ResetPasswordRequest;

interface ForgotPasswordServiceInterface
{
    public function submitForgetPasswordForm(ForgotPasswordEmailRequest $request): void;
    public function generateEmailToken(): string;
    public function sendEmailWithLink(array $details): void;
    public function submitResetPasswordForm(ResetPasswordRequest $request): bool;
    public function getLinkToPasswordReset(string $token): string;
}