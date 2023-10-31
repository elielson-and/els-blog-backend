<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_img',
        'title',
        'description',
        'slug',
        'content',
        'views',
        'likes',
        'user_id'
    ];

    // Relations

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
