<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();

        return view('dashboard', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        return view('detail', compact('blog'));
    }

    public function create()
    {
        return view('create');
    }

    public function edit(Blog $blog)
    {
        return view('edit', compact('blog'));
    }

    public function store(StoreBlogRequest $request)
    {
        $data=$request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $data['image'] = $imagePath;
        }
    
        $data['date'] = now(); 
        $blog=Blog::create($data);

        $blogs = Blog::all();

        return view('dashboard')->with('blogs', $blogs);
    }

    public function update(UpdateBlogRequest $request,Blog $blog)
    {   
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $data['image'] = $imagePath;
        }
    
        $data['date'] = now(); 
        $blog->update($data);
    
        return redirect()->route('detail', ['blog' => $blog->id])->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        $blogs=Blog::all();

        return view('dashboard',compact('blogs'))->with('success', 'Blog deleted successfully');
    }
}
