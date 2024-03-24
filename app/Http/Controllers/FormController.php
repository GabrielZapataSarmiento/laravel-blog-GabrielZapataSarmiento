<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BlogPostController;

class FormController extends Controller
{
    public function add()
    {
        if (Auth::guest()) {
            return redirect()->route('login')->with('msg', 'You need to be logged in to do this');
        }

        $form_action = route('blog.store');
        $form_button = 'Create Your Blog';


        return view('form', compact('form_action', 'form_button'));

    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'title' => 'required',
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



    public function edit($id)
    {
        $blogPost = BlogPost::findOrFail($id);


        if ($blogPost->user_id != Auth::id() || Auth::guest()) {
            return redirect('/')->with('msg', "You don't have permission to do that");
        }


        $form_action = route('blog.update', ['id' => $id]);
        $form_button = 'Edit Your Blog';

        return view('form', compact('form_action', 'form_button', 'blogPost'));
    }


    public function update(Request $request, $id)
    {

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
