<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function postComment(Request $request)
    {
        
        $comment = new Comment;
        $comment->comment = $request['comment'];
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request['post_id'];
        $comment->save();
        return response()->json([
            'status' => 300,
            'content' => '
            <div class="comment" id="'.$comment->id.'">
                <span class="comment-username">'.Auth::user()->name.'</span>
                <span class="comment-text">'.$request['comment'].'</span>
            </div>'
        ]);

        // return redirect('/');
    }
}
