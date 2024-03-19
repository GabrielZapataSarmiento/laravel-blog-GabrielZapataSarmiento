<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Comments;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index()
    {
        $blogs = BlogPost::getBlogs();
        return view('index', compact('blogs'));
    }
    public function getOneBlog($id)
    {
        $blogPost = BlogPost::findOrFail($id);
        $comments = Comments::getComments($id);

        return view('view', compact('blogPost', 'comments'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $blog = new BlogPost;
        $blog->title = $validatedData['title'];
        $blog->content = $validatedData['content'];
        $blog->save();

        return redirect()->route('blogs.index');
    }
}
