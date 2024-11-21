<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|nullable',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;

        if ($request->hasFile('image')) {
            $post->image = $request->file('image')->store('images' , 'public');
        }

        $post->save();
        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function show($id)
    {
    $post = Post::findOrFail($id);
    return view('posts.show', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|nullable',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->description = $request->description;

        // تحديث الصورة إذا كانت موجودة
        if ($request->hasFile('image')) {
            
            $post->image = $request->file('image')->store('images' , 'public');
        }

        $post->save();
        return redirect()->route('posts.index');
    }

    // حذف البوست
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
