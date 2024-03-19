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
}
