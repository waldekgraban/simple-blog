<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Services\PostServiceInterface;

class PostController extends Controller
{
    private PostServiceInterface $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getAllPaginatedPosts();

        return view('posts.index', compact('posts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostStoreRequest $request)
    {
        $result = $this->postService->storePost($request);

        if(!$result){
            return redirect()->route('posts.index')
                ->with('warning','Something went wrong.');
        }

        return redirect()->route('posts.index')
            ->with('success','Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    } 

    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $result = $this->postService->updatePost($request, $post);

        if(!$result){
            return redirect()->route('posts.index')
                ->with('warning','Something went wrong.');
        }

        return redirect()->route('posts.index')
            ->with('success','Post updated successfully');
    }

    public function destroy(Post $post)
    {
        $this->postService->deletePost($post);

        return redirect()->route('posts.index')
            ->with('success','Post deleted successfully');
    }
}