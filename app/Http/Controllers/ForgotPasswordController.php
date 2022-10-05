<?php 

namespace App\Http\Controllers; 

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordEmailRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Services\ForgotPasswordServiceInterface;

class ForgotPasswordController extends Controller
{

    private ForgotPasswordServiceInterface $forgotPasswordService;

    public function __construct(ForgotPasswordServiceInterface $forgotPasswordService)
    {
        $this->forgotPasswordService = $forgotPasswordService;
    }

    public function showForgetPasswordForm()
    {
        return view('auth.forgetPassword');
    }

    public function submitForgetPasswordForm(ForgotPasswordEmailRequest $request)
    {
        $this->forgotPasswordService->submitForgetPasswordForm($request);

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function showResetPasswordForm($token) {
        // $link = URL::to("/reset-password/") . $token;
        return view('auth.forgetPasswordLink', ['token' => $token]);
    }

    public function submitResetPasswordForm(ResetPasswordRequest $request)
    {
        $submit = $this->forgotPasswordService->submitResetPasswordForm($request);

        if(!$submit){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        return redirect('/login')->with('message', 'Your password has been changed!');
    }

}