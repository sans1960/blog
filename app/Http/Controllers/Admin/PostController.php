<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():Response
    {
        $posts = Post::all();
        return response()->view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():Response
    {
        $categories = Category::all();
        return response()->view('admin.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $request->validate([
            'title'=>'string|required|max:255',
            'subtitle'=>'string|required|max:255',
            'category_id' => 'required',
            'image' =>[ 'required' , File::types(['jpg', 'png', 'webp', 'jpeg'])

            ->max(1024)],
            'bgimage' =>[ 'required' , File::types(['jpg', 'png', 'webp', 'jpeg'])

            ->max(1024)],
            'body' => 'required',
            'summary' => 'required',

        ]);
        if ($request->hasFile('image')) {
            // put image in the public storage
            $filePath = Storage::disk('public')->put('images/posts', request()->file('image'));
        }
        if ($request->hasFile('bgimage')) {
            // put image in the public storage
            $filePathBg = Storage::disk('public')->put('images/posts', request()->file('bgimage'));
        }
        $post = new Post();
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->category_id = $request->category_id;
        $post->summary = $request->summary;
        $post->body = $request->body;
        $post->slug = Str::slug($request->title);
        $post->bgimage = $filePathBg;
        $post->image = $filePath;
        $post->save();
        session()->flash('notif.success', 'Post creado');
        return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post):Response
    {
        return response()->view('admin.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post):Response
    {
        $categories = Category::all();
        return response()->view('admin.posts.edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
