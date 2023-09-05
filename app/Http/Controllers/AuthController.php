<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\error;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request  $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:8|max:12'
        ]);

        if (Auth::attempt($request->only('email','password'))) {
            return redirect(url('/'));
            // return response()->json([
            //     'status' => 200,
            //     'message' => 'Logged in Successfully',
            // ]);
        }

        // return response()->json([
        //     'status' => 400,
        //     'errors' => 'Invalid Credentials',
        // ]);
        return redirect(route('login'))->with(['error' => '!Invalid Credentials']);
    }

    public function register_view()
    {
        return view('auth.register');
    }

    public function register(Request  $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|min:8|max:12',
            'avater' => 'required',
        ]);

        $mainfile = time()."-main.".$request->file('avater')->getClientOriginalExtension();
        $main = $request->file('avater')->storeAs('uploads',$mainfile,'public');
        Storage::disk('public')->put("uploads",$main);

        $user = new User;
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->avater = $main;
        $user->save();

        if (Auth::attempt($request->only('email','password'))) {
            // return response()->json([
            //     'status' => 200,
            //     'message' => 'Registration & Logged in Successfully',
            // ]);
            return redirect(url('/'));
        }
        // return response()->json([]);
        return redirect(route('register'))->with(['error' => '!Invalid Credentials']);
    }

    public function logout()
    {
        session()->flush();
        Auth::logout();
        return redirect(url('/'));
    }

    public function home()
    {
        // $user = Post::with(['comments:id,post_id,comment,user_id','user','comments.user:id,name'])->latest()->get();

        return view('welcome');
    }

    public function getPost()
    {     
        $posts = Post::get();
        $data = '';
        foreach ($posts as $value) {
            $data = '
                <div class="mainPost">
                    <div class="posts">
                        <div class="post-header">
                        <img src="storage/'.$value->user->avater.'" alt="Profile Image" class="profile-image">
                        <span class="username">'.$value->user->name.'</span>       
                        </div>

                        <div class="post-content" id="'.$value->id.'">
                        <img src=storage/'.$value->photo.' alt="Post Image" class="post-image">
                        <p class="caption">'.$value->description.'</p>
                        </div>
                        <div class="post-actions">
                        <i id="click" onclick="click()" class="fas fa-heart"></i> <!-- Like icon -->
                        <i class="fas fa-comment"></i> <!-- Comment icon -->
                        <i class="fas fa-share"></i> <!-- Share icon -->
                        </div>
                    </div>
                </div>
                <form id="addComment" action="/comment" method="POST">
                    <div class="comment-input row">
                    <div class="col-9 p-2">
                        <input type="hidden" name="post_id" value="'.$value->id.'">
                        <input type="text" name="comment" class="form-control" placeholder="Write a comment...">
                    </div>
                    <div class="col-3 p-2">
                        <button type="submit" id="submit" class="btn btn-primary">Post</button>
                    </div>
                    </div>
                </form> 
            ';
            echo $data;
            foreach ($value->comments as $comment) {
                    $file = '<div class="comments" id="Comments">
                        <div class="comment" id="'.$comment->id.'">
                          <span class="comment-username">'.$comment->user->name.'</span>
                          <span class="comment-text">'.$comment->comment.'</span>
                        </div>
                      </div>
                      ';
                      echo $file;
            }
        }
    }

}
