<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BlogPost extends Model
{
    protected $table = 'blogposts';
    use HasFactory;
    use SoftDeletes;

    public function comments()
    {
        return $this->hasMany(Comments::class, 'blog_id');
    }

    public function deleteBlog(Request $request){

        $id = $request->input('id');

        $blogPost = BlogPost::findOrFail($id);

        if ($blogPost->user_id != Auth::id() || Auth::guest()) {
            return redirect('/')->with('msg', "You don't have permission to do that");
        }

        $blogPost->delete();

        return redirect()->back()->with('msg', 'Blog has been deleted');
    }

    public static function addBlog(Request $request){

        $validatedData = $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
        ]);

        if (Auth::guest()) {
            return redirect()->route('login')->with('msg', 'You need to be logged in to do this');
        }

        $blog = new BlogPost;
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->user_id = Auth::id();
        $blog->username = Auth::user()->name;

        $blog->save();


        return redirect('/')->with('msg', 'Blog has been added');

    }

    public static function editBlog(Request $request){

        $id = $request->input('id');


        $validatedData = $request->validate([
            'title' => 'required|max:50',
            'content' => 'required',
        ]);

        $blogPost = BlogPost::findOrFail($id);

        if ($blogPost->user_id != Auth::id() || Auth::guest()) {
            return redirect('/')->with('msg', "You don't have permission to do that");
        }

        $blogPost->title = $request->input('title');
        $blogPost->content = $request->input('content');

        $blogPost->save();

        return redirect('/')->with('msg', 'Blog has been edited');
    }

}

