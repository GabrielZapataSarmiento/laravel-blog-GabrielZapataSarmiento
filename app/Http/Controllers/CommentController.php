<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function add(Request $request, $id)
    {
        $validatedData = $request->validate([
            'comment' => 'required|max:255',
        ]);

        $comment = new Comments();

        if (Auth::guest()) {
            return redirect()->route('login')->with('msg', 'You need to be logged in to do this');
        }

        $comment->content = $request->input('comment');
        $comment->blog_id = $id;
        $comment->user_id = Auth::id();
        $comment->username = Auth::user()->name;

        $comment->save();

        return redirect()->back();
    }

}
