<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Comments extends Model
{
    protected $table = 'comments';
    use HasFactory, SoftDeletes;

    public static function getComments($blogPostId)
    {
        return static::where('blog_id', $blogPostId)
            ->whereNull('deleted_at')
            ->get();
    }

    public function deleteComment(Request $request)
    {
        $commentId = $request->input('comment_id');
        $blogId = $request->input('blog_id');

        $comment = Comments::findOrFail($commentId);

        if ($comment->user_id != auth()->id() || $comment->blog_id != $blogId) {
            return redirect()->route('blogs.show', ['id' => $blogId])->with('msg', "Wacthu tryna do boyy???!");
        }

        $comment->delete();

        return redirect()->back()->with('msg', "Your comment has been deleted.");
    }

    public function add(Request $request,)
    {
        $validatedData = $request->validate([
            'comment' => 'required|max:255',
        ]);

        $id = $request->input('id');

        $comment = new Comments();

        if (Auth::guest()) {
            return redirect()->route('login')->with('msg', 'You need to be logged in to do this');
        }

        $comment->content = $request->input('comment');
        $comment->blog_id = $id;
        $comment->user_id = Auth::id();
        $comment->username = Auth::user()->name;

        $comment->save();

        return redirect()->back()->with('msg', 'Comment added successfully');


    }


}
