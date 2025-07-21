<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        // Simple validation
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = $request->content;

        // Image upload handling
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blogs', 'public');
            $blog->image = $path;
        }

        $blog->save();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'image'   => 'nullable|image|max:2048',
            'content' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $blog->image = $request->file('image')->store('blogs', 'public');
        }

        $blog->update([
            'title'   => $request->title,
            'slug'    => Str::slug($request->title),
            'image'   => $blog->image,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted.');
    }


    public function blogsdetail($slug)
        {
            $blog = Blog::where('slug', $slug)->firstOrFail();
            $recentBlogs = Blog::latest()->take(5)->get(); // Optional: recent blogs
            return view('blog.blogshow', compact('blog', 'recentBlogs'));
        }
    public function blogview()
        {
             $blogs = Blog::latest()->paginate(6); // paginated blogs
             $recentBlogs = Blog::latest()->take(5)->get(); // recent sidebar

             return view('blog.blogindex', compact('blogs', 'recentBlogs'));
        }
}

