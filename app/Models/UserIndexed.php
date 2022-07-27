<?php

namespace App\Models;

use Database\Factories\UserIndexedFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserIndexed extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'register_at',
    ];

    protected static function newFactory()
    {
        return UserIndexedFactory::new();
    }
}
