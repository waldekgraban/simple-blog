<?php

namespace App\Http\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Post;

interface PostRepositoryInterface
{
    public function getAllPaginatedPosts(): LengthAwarePaginator;
    public function storePost(array $postData): bool;
    public function updatePost(array $postData, Post $post): bool;
    public function deletePost(Post $post): void;
}