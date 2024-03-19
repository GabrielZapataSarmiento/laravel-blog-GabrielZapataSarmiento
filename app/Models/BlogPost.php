<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $table = 'blogposts';

    public static function getBlogs()
    {
        return static::whereNull('deleted_at')->get();
    }
}

