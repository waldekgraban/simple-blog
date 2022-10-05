<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Services\UserServiceInterface;

class RegisterController extends Controller
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function show()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $this->userService->createUser($request);

        return redirect('/')->with('success', "Account successfully registered.");
    }
}
