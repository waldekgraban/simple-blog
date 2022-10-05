<?php

namespace App\Http\Services;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\UpdatePostRequest;

interface PostServiceInterface
{
   public function getAllPaginatedPosts(): LengthAwarePaginator;
   public function storePost(PostStoreRequest $request): bool;
   public function updatePost(UpdatePostRequest $request, Post $post): bool;
   public function deletePost(Post $post): void;
}