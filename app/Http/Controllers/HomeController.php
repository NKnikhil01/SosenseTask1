<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('editor.home');
    }

    public function post()
    {
        $userId = Auth::id();
        $posts = Post::where('user_id',$userId)->get();
        // dd($posts);
        
        return view('editor.post',compact('posts'));
    }
    public function addPost()
    {
        $categories = Category::pluck('title', 'id');
        // dd($categories);
        return view('editor.add-post',compact('categories'));
    }
    public function postPost(Request $request)
    {
        $userId = Auth::id();
        // dd($userId);
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
            'category' => 'required'
        ]);
        // dd($userId);
        $post = new Post();
            $post->title = $request->title;
            if ($request->hasFile('image')) {
                $img = $request->image;
                $fileName = $img->getClientOriginalName();
                $imageUrl = Storage::putFileAs('/public/images', $request->file('image'), $fileName);
                $post->image = $imageUrl;
            }
            $post->description = $request->description;
            $post->status = $request->status;
            $post->user_id = $userId;
            $post->category_id  = $request->category;
        $post->save();

        return redirect(route('user.post'))->with('status', 'Post Added Successfully...!');
    }
    public function editPost($id)
    {
        $post = Post::find($id);
        $categories = Category::pluck('title', 'id');
        return view('editor.edit-post', compact('post', 'categories'));
    }
    public function updatePost(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'category' => 'required'
        ]);
        $post = Post::find($id);
            $post->title = $request->title;
            if ($request->hasFile('image')) {
                $img = $request->image;
                $fileName = $img->getClientOriginalName();
                $imageUrl = Storage::putFileAs('/public/images', $request->file('image'), $fileName);
                $post->image = $imageUrl;
            }
            $post->description = $request->description;
            $post->status = $request->status;
            $post->category_id  = $request->category;
        $post->save();
        return redirect()->route('user.post')->with('status', 'Post Updated Successfully...!');
    }
    public function deletePost($id)
    {
        $post = Post::destroy($id);
        return redirect()->route('user.post')->with('status', 'Post Deleted Successfully...!');
    }

    public function getUserProfile()
    {
        $userId = Auth::id();
        $profile = User::where('id',$userId)->first();
        // dd($profile);
        return view('editor.profile',compact('profile'));
    }
    public function editUserProfile()
    {
        $userId = Auth::id();
        $profile = User::where('id', $userId)->first();
        return view('editor.edit-profile',compact('profile'));
    }
    public function updateUserProfile(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|email'
        ]);

        $profile = User::find($id);
            $profile->name = $request->name;
            $profile->email = $request->email;
        $profile->save();

        return redirect(route('user.profile'))->with('status','Profile Updated Successfully...!'); 
    }
}
