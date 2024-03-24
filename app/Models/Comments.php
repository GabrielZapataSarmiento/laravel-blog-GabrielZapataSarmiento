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
        $request->validate([
            'comment_id' => 'required|exists:comments,id',
            'user_id' => 'required|exists:users,id',
            'blog_id' => 'required|exists:blogposts,id',
        ]);

        $comment = Comments::findOrFail($request->input('comment_id', 'blog_id'));
        if ($comment->user_id != Auth::id() || $comment->blog_id != $request->input('blog_id')) {
            return redirect()->back();
        }

        $comment->delete();

        return redirect()->back();
    }


}
