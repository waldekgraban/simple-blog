<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\UserRepository;
use App\Http\Repositories\UserRepositoryInterface;
use App\Http\Repositories\PostRepository;
use App\Http\Repositories\PostRepositoryInterface;
use App\Http\Repositories\RoleRepository;
use App\Http\Repositories\RoleRepositoryInterface;
use App\Http\Repositories\ForgotPasswordRepository;
use App\Http\Repositories\ForgotPasswordRepositoryInterface;
use App\Http\Services\UserService;
use App\Http\Services\UserServiceInterface;
use App\Http\Services\ForgotPasswordService;
use App\Http\Services\ForgotPasswordServiceInterface;
use App\Http\Services\PostService;
use App\Http\Services\PostServiceInterface;


class InterfaceBindingProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(ForgotPasswordRepositoryInterface::class, ForgotPasswordRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(ForgotPasswordServiceInterface::class, ForgotPasswordService::class);
        $this->app->bind(PostServiceInterface::class, PostService::class);

        
    }
}
