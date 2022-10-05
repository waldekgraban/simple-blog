<?php

namespace App\Http\Controllers;

use App\Http\Services\PostServiceInterface;
use App\Http\Services\UserServiceInterface;


class HomeController extends Controller
{
    private PostServiceInterface $postService;
    private UserServiceInterface $userService;

    public function __construct(PostServiceInterface $postService, UserServiceInterface $userService)
    {
        $this->postService = $postService;
        $this->userService = $userService;
    }

    public function index() 
    {
        

        $isUserAllowToMenagePosts = $this->userService->isUserAllowToMenagePosts();
        $isUserAllowToMenageUsers = $this->userService->isUserAllowToMenageUsers();

        $posts = $this->postService->getAllPaginatedPosts();

        return view('home.index', compact(['posts', 'isUserAllowToMenagePosts', 'isUserAllowToMenageUsers']))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
