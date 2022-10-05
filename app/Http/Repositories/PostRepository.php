<?php

namespace App\Http\Repositories;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostRepository extends Repository implements PostRepositoryInterface
{
    public function getAllPaginatedPosts(): LengthAwarePaginator
    {
       return Post::latest()->paginate(Post::POSTS_NUMBER_PER_PAGE);
    }

    public function storePost(array $postData): bool
    {
        $post = new Post();
        $userId = Auth::user()->id;
        $image = Arr::get($postData, 'file');

        $post->title = Arr::get($postData, 'title');
        $post->body = Arr::get($postData, 'body');
        $post->user_id = $userId;

        if(!$post->save()){
            return false;
        }
        
        if(isset($image)) {
            $this->storePostImage($image, $post->id, $userId);
        }

        return true;
    }

    public function updatePost(array $postData, Post $post): bool
    {
        return $post->update($postData)
            ? true
            : false;
    }

    public function deletePost(Post $post): void
    {
        $post->delete();
    }

    public function storePostImage($image, $postId, $userId): void
    {
        $imagePath = Storage::disk('uploads')->put('\/' .  $userId . '/posts', $image);

        PostImage::create([
            'post_image_path' => 'uploads' . $imagePath,
            'post_id' => $postId
        ]);
    } 
}