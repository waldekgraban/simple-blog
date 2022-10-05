<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Services\UserServiceInterface;

class LoginController extends Controller
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();
        
        $isCredentialsValidated = $this->userService->isCredentialsValidated($credentials);

        if(!$isCredentialsValidated) {
            return redirect()->to('login')->withErrors(trans('auth.failed'));
        }

        $loginResult = $this->userService->conditionalUserLogin($credentials);

        if(!$this->isLoginSuccess($loginResult['result'])){
            return redirect()->to('login')->withErrors(trans('auth.unacceptable_role'));
        }

        return $this->authenticated($request, $loginResult['user']);
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }

    private function isLoginSuccess($isSuccess): bool
    {
        return $isSuccess;
    }
}
