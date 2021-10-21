<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Checks if a particular user has liked a post
     */
    public function likedBy(User $user): bool
    {
        return $this->likes->contains('user_id', $user->id); // Collection
    }

    /**
     * Checks if a particular Post belongs to a User
     */
    public function ownedBy(User $user): bool
    {
        return $this->user_id == $user->id;
    }
}
