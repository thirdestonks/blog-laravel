<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Post/Index',['post' => Post::with('user')->all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|required',
            'content' => 'string|required|max:255',
            'image' => 'nullable|file|image'
        ]);
        // $image_path = '';

        // if($request->hasFile('image')){
        //     $image_path = $request->file('image')->store('image', 'public');
        // }

        $id = Auth::user()->id;

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $id
        ]);

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        $request->validate([
            'title' => 'string|required',
            'content' => 'string|required|max:255'
        ]);


        $post->update([
            'title' => $request->title,
            'content' =>$request->content
        ]);

        return redirect()->route('post.index');
    }

     /**
     * Get Comments of Post.
     */
     public function getCommentsByPost(string $id)
    {
        $data = Post::with('comments')->find($id);

        return [
            'data' => $data
        ];
    }

    /**
     * Comment to Post.
     */
     public function commentPost(Request $request, string $id)
    {
        $post = Post::find($id);

        $request->validate([
            'content' => 'string|required|max:255'
        ]);

        $authUser = Auth::user()->id;

        BlogComment::create([
            'content' => $request->content,
            'user_id' => $authUser,
            'post_id' => $post->id
        ]);


        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        $post->delete();

        return redirect()->back();
    }
}
