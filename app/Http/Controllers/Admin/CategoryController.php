<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():Response
    {
        $categories = Category::all();
        return response()->view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():Response
    {
        return response()->view('admin.categories.create');  

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $request->validate([
            'name'=>'string|required|max:255',
            'subname'=>'string|required|max:255',
            'image' => [ 'required' , File::types(['jpg', 'png', 'webp', 'jpeg'])

            ->max(1024)],
            'body' => 'required',
            'caption' =>'required'

        ]);
        if ($request->hasFile('image')) {
            // put image in the public storage
            $filePath = Storage::disk('public')->put('images/categories', request()->file('image'));
        }
        $category = new Category();
        $category->name = $request->name;
        $category->subname = $request->subname;
        $category->body = $request->body;
        $category->slug = Str::slug($request->name);
        $category->image = $filePath;
        $category->caption = $request->caption;
        $category->save();
        session()->flash('notif.success', 'Categoria creada');
            return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category):Response
    {
        return response()->view('admin.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category):Response
    {
        return response()->view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category):RedirectResponse
    {
        $request->validate([
            'name'=>'string|required|max:255',
            'subname'=>'string|required|max:255',
            'image' => ['nullable', File::types(['jpg', 'png', 'webp', 'jpeg'])

            ->max(1024)],
            'body' => 'required',
            'caption' => 'required'

        ]);
        if ($request->hasFile('image')) {
            // delete image
            Storage::disk('public')->delete($category->image);

            $filePath = Storage::disk('public')->put('images/categories', request()->file('image'), 'public');          
            $category->image = $filePath;
        }
        $category->name = $request->name;
        $category->subname = $request->subname;
        $category->body = $request->body;
        $category->slug = Str::slug($request->name);
        $category->caption = $request->caption;
        
        $category->update();
        session()->flash('notif.success', 'Categoria actualizada');
            return redirect()->route('admin.categories.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category):RedirectResponse
    {
        Storage::disk('public')->delete($category->image);
        $delete = $category->delete();
        session()->flash('notif.success', 'Categoria eliminada');
        return redirect()->route('admin.categories.index');
    }
}
