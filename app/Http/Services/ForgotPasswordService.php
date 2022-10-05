<?php

namespace App\Http\Services;

use App\Http\Requests\ForgotPasswordEmailRequest;
use App\Http\Repositories\ForgotPasswordRepositoryInterface;
use App\Jobs\SendForgetPasswordEmailJob;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class ForgotPasswordService extends Service implements ForgotPasswordServiceInterface
{

    private ForgotPasswordRepositoryInterface $forgotPasswordRepository;

    public function __construct(ForgotPasswordRepositoryInterface $forgotPasswordRepository)
    {
        $this->forgotPasswordRepository = $forgotPasswordRepository;
    }

    public function submitForgetPasswordForm(ForgotPasswordEmailRequest $request): void
    {
        $userData = $request->validated();

        $details['email'] = $userData['email'];
        $details['token'] = $this->generateEmailToken();
        $details['link'] = $this->getLinkToPasswordReset($details['token']);

        $this->forgotPasswordRepository->logForgotPasswordToDB($details);

        $this->sendEmailWithLink($details);
    }

    public function sendEmailWithLink(array $details): void
    {   
        dispatch(new SendForgetPasswordEmailJob($details));
    }

    public function generateEmailToken(): string
    {
        return Str::random(64);
    }

    public function submitResetPasswordForm($request): bool
    {
        $details = $request->validated();

        $update = $this->forgotPasswordRepository->updateResetPassword($details);

        if(!$update) {
            return false;
        }

        $this->forgotPasswordRepository->removePasswordResetLogAfterOperation($details);

        return true;
    }

    public function getLinkToPasswordReset(string $token): string
    {
        return URL::to("/reset-password/") . '/' . $token;
    }
}