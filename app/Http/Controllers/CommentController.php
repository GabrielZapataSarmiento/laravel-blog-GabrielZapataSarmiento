<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function add(Request $request, $id)
    {
        $comment = new Comments();
        $comment->content = $request->input('comment');
        $comment->blog_id = $id;
        $comment->user_id = Auth::id();
        $comment->username = Auth::user()->name;

        $comment->save();

        return redirect()->back();
    }

}
