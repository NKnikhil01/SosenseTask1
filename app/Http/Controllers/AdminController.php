<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        // dd($users);
        return view('admin.admin-home',compact('users'));
    }

    public function addUser()
    {
        return view('admin.add-user');
    }

    public function postUser(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required',
            'password' => 'required'
        ]);
        // dd($);
        $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->is_admin = $request->role;
            $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('admin.home')->with('status','User Added Successfully...!');
    }

    public function editUser($id)
    {  
        $user = User::find($id);
        // dd($user);
        if (! Gate::denies(route('user.edit',$user->id),$user)) {
            abort(403);
        }
        return view('admin.user-edit',compact('user'));
    }

    public function updateUser(Request $request,$id)
    {
        // dd($id);
        $this->validate($request,[
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'role' => 'required'
        ]);

        $user = User::find($id);
        // dd($user);
        if (!Gate::denies(route('user.update', $user->id), $user)) {
            abort(403);
        }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->is_admin = $request->role;
        $user->save();
        return redirect()->route('admin.home')->with('status','User Record Updated Successfully...!');
    }

    public function deleteUser($id)
    {
        // dd($id);
        $user = User::find($id);
        if (!Gate::denies(route('user.delete', $user->id), $user)) {
            abort(403);
        }
        $user->delete();
        return redirect()->route('admin.home')->with('status','User Deleted Successfully...!');
    }

    public function category()
    {
        $category = Category::all();
        return view('admin.category',compact('category'));
    }
    public function addCategory(Request $request)
    {
        // dd("hi");
       return view('admin.add-category');
    }
    public function postCategory(Request $request)
    {
        // dd("hi post category");
        $this->validate($request,[
            'title' => 'required'
        ]);
        // dd($request->all());
        $category = new Category();
            $category->title = $request->title;
        $category->save();

        return redirect(route('admin.category'))->with('status','Category Added Successfully...!');
    }
    public function categoryEdit($id)
    {
        $category = Category::find($id);
        if (!Gate::denies(route('category.edit', $category->id), $category)) {
            abort(403);
        }
        return view('admin.edit-category',compact('category'));
    }
    public function categoryUpdate(Request $request, $id)
    {
        $category = Category::find($id);
        if (!Gate::denies(route('category.update', $category->id), $category)) {
            abort(403);
        }
            $category->title = $request->title;
        $category->save();
        return redirect()->route('admin.category')->with('status', 'Category Updated Successfully...!');
    }
    public function categoryDelete($id)
    {
        $category = Category::find($id);
        // dd($category);
        if (!Gate::denies(route('category.delete', $category->id), $category)) {
            abort(403);
        }
        $category->delete();
        return redirect()->route('admin.category')->with('status', 'Category Deleted Successfully...!');
    }



    public function post()
    {
        $posts = Post::get();
        // dd($posts);
        return view('admin.post',compact('posts'));
    }
    public function addPost()
    {
        $categories = Category::pluck('title','id');
        // dd($categories);
        return view('admin.add-post',compact('categories'));
    }
    public function postPost(Request $request)
    {
        $userId = Auth::id();
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required',
            'description' => 'required',
            'status' => 'required',
            'category' => 'required'
        ]);
        // dd($userId);
        $post = new Post();
            $post->title = $request->title;
            if ($request->hasFile('image')) {
                $img = $request->image;
                $fileName = $img->getClientOriginalName();
                $imageUrl = Storage::putFileAs('/public/images',$request->file('image'), $fileName);
                $post->image = $imageUrl;
            }
            $post->description = $request->description;
            $post->status = $request->status;
            $post->user_id = $userId;
            $post->category_id  = $request->category;
        $post->save();

        return redirect(route('admin.post'))->with('status', 'Post Added Successfully...!');
    }
    public function postEdit($id)
    {
        $post = Post::find($id);
        // dd($post);
        if (!Gate::denies(route('post.edit', $post->id), $post)) {
            abort(403);
        }
        $categories = Category::pluck('title', 'id');
        // dd($post);
        return view('admin.edit-post',compact('post', 'categories'));
    }
    public function postUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'category' => 'required'
        ]);
        $post = Post::find($id);
        if (!Gate::denies(route('post.update', $post->id), $post)) {
            abort(403);
        }
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
        return redirect()->route('admin.post')->with('status', 'Post Updated Successfully...!');
    }
    public function postDelete($id)
    {
        $post = Post::find($id);
        if (!Gate::denies(route('post.delete', $post->id), $post)) {
            abort(403);
        }
        $post->delete();
        return redirect()->route('admin.post')->with('status','Post Deleted Successfully...!');
    }
}
