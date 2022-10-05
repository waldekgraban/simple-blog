<?php

namespace App\Http\Services;

use App\Models\Post;
use App\Http\Repositories\PostRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\UpdatePostRequest;

class PostService extends Service implements PostServiceInterface
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAllPaginatedPosts(): LengthAwarePaginator
    {
        return $this->postRepository->getAllPaginatedPosts();
    }

    public function storePost(PostStoreRequest $request): bool
    {
        $postData = $request->validated();

        return $this->postRepository->storePost($postData);
    }

    public function updatePost(UpdatePostRequest $request, Post $post): bool
    {
        $postData = $request->validated();

        return $this->postRepository->storePost($postData, $post);
    }

    public function deletePost(Post $post): void
    {
        $this->postRepository->deletePost($post);
    }
}