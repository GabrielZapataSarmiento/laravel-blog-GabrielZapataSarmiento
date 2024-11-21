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

    public function edit(Request $request)
    {
        $id = $request->input('id');

        $blogPost = BlogPost::findOrFail($id);

        if ($blogPost->user_id != Auth::id() || Auth::guest()) {
            return redirect('/')->with('msg', "You don't have permission to do that");
        }


        $form_action = route('blog.update');
        $form_button = 'Edit Your Blog';

        return view('form', compact('form_action', 'form_button', 'id' , 'blogPost'));

    }

}
