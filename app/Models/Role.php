<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;

    public const USER_ROLE = "Użytkownik";
    public const ADMIN_ROLE = "Administrator";
    public const EDITOR_ROLE = "Redaktor";
    
    public const LOGIN_ALLOWS_ROLE = [
        self::ADMIN_ROLE,
        self::EDITOR_ROLE
    ];


    public function users()
    {
        return $this->hasMany(User::class);
    }
}
