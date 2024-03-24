<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BlogPost extends Model
{
    protected $table = 'blogposts';
    use HasFactory;
    use SoftDeletes;

    public static function getBlogs()
    {
        return static::whereNull('deleted_at')->get();
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'blog_id');
    }

    public function deleteBlog($id){
        $blogPost = BlogPost::findOrFail($id);

        $blogPost->delete();

        return redirect()->back()->with('msg', 'Blog has been deleted');
    }

}

