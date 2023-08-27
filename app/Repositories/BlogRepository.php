<?php

namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\BlogRepositoryInterface;

class BlogRepository implements BlogRepositoryInterface
{
    public function index($trash = false)
    {
        if ($trash) {
            return Blog::onlyTrashed()->get();
        } else {
            return Blog::all();
        }
    }
    public function createOrUpdate(Request $data, array $validatorsArray)
    {
        $user = Auth::user()->id;
        $slug = Str::slug($data->title);
        $data->validate($validatorsArray);
        if (isset($data['id'])) {
            $blog = Blog::findOrFail($data['id']);
        } else {
            $blog = new Blog();
        }
        $blog->posted_by = $user;
        $blog->slug = $slug;
        $blog->title = $data->title;
        $blog->save();
    }

    public function show($id)
    {
        return Blog::findOrFail($id);
    }

    public function restoreOrDelete($id, $restore = false)
    {
        if ($restore) {
            $blog = Blog::onlyTrashed()->findOrFail($id);
            $blog->restore();
            return $blog;
        } else {
            $blog = Blog::withTrashed()->findOrFail($id);
            $blog->forceDelete();
        }
    }
}
