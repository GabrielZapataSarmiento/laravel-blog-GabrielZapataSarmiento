<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function addLike($id){

        if (Auth::guest()) {
            return redirect()->route('login')->with('msg' , 'You need to be logged in to do this');
        }

        try {
            $like = new Likes();

            $like->blog_id = $id;
            $like->user_id = Auth::id();

            $like->save();
        } catch (\Exception $e) {

            Likes::where('blog_id', $id)->where('user_id', Auth::id())->delete();

            return redirect()->back();
        }

        return redirect()->back();
    }



}
