<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
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

    public function index()
    {
        $data = Blog::all();
        return view('admin.blogs.index', compact('data'));
    }
    public function trashedIndex()
    {
        $data = Blog::onlyTrashed()->get();
        return view('admin.blogs.trashIndex', compact('data'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }


    public function store(Request $request)
    {
        $user = Auth::user()->id;
        $slug = Str::slug($request->title);
        $request->validate([
            'title' => 'required|string',
        ]);

        $blog = new Blog();
        $blog->posted_by = $user;
        $blog->slug = $slug;
        $blog->title = $request->title;
        $blog->save();

        return redirect(route('blogs.index'))->with('success', 'Stored Successfully');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user()->id;
        $slug = Str::slug($request->title);
        $request->validate([
            'title' => 'required|string',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->posted_by = $user;
        $blog->slug = $slug;
        $blog->title = $request->title;
        $blog->save();

        return redirect(route('blogs.index'))->with('success', 'Updated Successfully');
    }

    public function recover($id)
    {
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->restore();
        return back()->with('success', 'Recovered Successfully');
    }

    public function trash($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return back()->withErrors('Trashed Successfully');
    }

    public function delete($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);
        $blog->forceDelete();
        return back()->withErrors('Deleted Successfully');
    }
}
