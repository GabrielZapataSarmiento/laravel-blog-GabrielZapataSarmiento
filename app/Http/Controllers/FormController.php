<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
    public function add()
    {
        $form_action = route('blog.store');
        $form_button = 'Create Your Blog';

        return view('form', compact('form_action', 'form_button'));

    }

    public function store(Request $request){

        $blog = new BlogPost;
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->user_id = Auth::user()->id;
        $blog->save();

        return redirect('/');
    }

    public function edit($id)
    {
        $form_action = route('blog.update', ['id' => $id]);
        $form_button = 'Edit Your Blog';

        return view('form', compact('form_action', 'form_button'));
    }


    public function update(Request $request, $id)
    {
        $blogPost = BlogPost::findorfail($id);

        $blogPost->title = $request->input('title');
        $blogPost->content = $request->input('content');

        $blogPost->save();

        return redirect('/');
    }
}
