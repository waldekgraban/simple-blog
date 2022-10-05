<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PostImage;

class Post extends Model
{
    use HasFactory;

    public const POSTS_NUMBER_PER_PAGE = 10;
    
    protected $fillable = [
        'title', 'body', 'user_id',
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function post_images()
    {
        return $this->hasMany(PostImage::class);
    }
}
