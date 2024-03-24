<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Comments;
use App\Models\Likes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    public function index()
    {
        $blogs = BlogPost::orderBy('created_at', 'desc')->paginate(5);

        return view('index', compact('blogs'));
    }

    public function getOneBlog($id)
    {
        $blogPost = BlogPost::findOrFail($id);
        $comments = Comments::getComments($id);
        $likes = Likes::getLikes($id);

        return view('view', compact('blogPost', 'comments', 'likes'));
    }
    public function myBlogs()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $blogs = BlogPost::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);

            return view('index', compact('blogs'));
        } else {
            return redirect()->route('login')->with('msg', 'You need to be logged in to do this');
        }
    }

}
