<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // public function index()
    // {
        // $user = Comment::with(['post','user'])->first();
        // $user = Post::with(['comments:id,post_id,comment,user_id','user:id,name','comments.user:id,name'])->first();
        // $user = Comment::with('users')->first();
        // $user = User:: with(['posts'])->first();
        // $user = User:: with(['comment'])->first();
        // $user = Auth::user()->id;
        // dd($user->toArray());
        // return $user->toArray();
        // $trans = compact('user');
        // return view('index')->with($trans);
    // }
    public function post(Request $request)
    {
        $post = new Post;
        if ($request->file('photo')) {
            $mainfile = time()."-main.".$request->file('photo')->getClientOriginalExtension();
            $main = $request->file('photo')->storeAs('uploads',$mainfile,'public');
            Storage::disk('public')->put("uploads",$main);
            $post->photo = $main;
        }
        if ($request['description']) {
           $post->description = $request['description']; 
        }
        $post->user_id = Auth::user()->id;
        $post->save();

        // return redirect('/home');
        return response()->json([
            'status' => 200,
            'content' => 
            '<div class="post-header">
              <img src="storage/'.Auth::user()->avater.'" alt="Profile Image" class="profile-image">
              <span class="username">'.Auth::user()->name.'</span>       
            </div>

            <div class="post-content">
              <img src=storage/'.$main.' alt="Post Image" class="post-image">
              <p class="caption">'.$request["description"].'</p>
            </div>
            <div class="post-actions">
              <i id="click" onclick="click()" class="fas fa-heart"></i> <!-- Like icon -->
              <i class="fas fa-comment"></i> <!-- Comment icon -->
              <i class="fas fa-share"></i> <!-- Share icon -->
            </div>
            <div class="comments" id="Comments">
            </div>
            <form id="addComment" action="/comment" method="POST">
              <div class="comment-input row">
                <div class="col-9 p-2">
                <input type="hidden" name="post_id" value="'.$post->id.'">
                <input type="text" name="comment" class="form-control" placeholder="Write a comment...">
                </div>
                <div class="col-3 p-2">
                  <button class="btn btn-primary">Post</button>
                </div>
              </div>
            </form>
          ',
        ]);
    }
}
