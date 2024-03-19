<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public static function getComments($blogPostId)
    {
        return static::where('blog_id', $blogPostId)
            ->whereNull('deleted_at')
            ->get();
    }
}
