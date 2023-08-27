<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constants\CommonConstants;
use App\Repositories\BlogRepositoryInterface;

class BlogController extends Controller
{
    protected $blogRepository;
    protected $commonConstants;
    public function __construct(BlogRepositoryInterface $blogRepository, CommonConstants $commonConstants)
    {
        $this->middleware('auth');
        $this->blogRepository = $blogRepository;
        $this->commonConstants = $commonConstants;
    }
    public function index()
    {
        $data = $this->blogRepository->index();
        return view('admin.blogs.index', compact('data'));
    }

    public function trashedIndex()
    {
        $data = $this->blogRepository->index($this->commonConstants->TRASHED);
        return view('admin.blogs.trashIndex', compact('data'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }


    public function store(Request $request)
    {
        $validators = [
            'title' => 'required|string',
        ];
        $this->blogRepository->createOrUpdate($request, $validators);

        return redirect(route('blogs.index'))->with('success', 'Stored Successfully');
    }

    public function edit($id)
    {
        $blog = $this->blogRepository->show($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $validators = [
            'title' => 'required|string',
        ];
        $data['id'] = $id;
        $this->blogRepository->createOrUpdate($request, $validators);

        return redirect(route('blogs.index'))->with('success', 'Updated Successfully');
    }

    public function recover($id)
    {
        $blog = $this->blogRepository->restoreOrDelete($id, $this->commonConstants->RESTORE);
        return back()->with([
            'success' => 'Recovered Successfully',
            'recoveredItems' => $blog
        ]);
    }

    public function trash($id)
    {
        $blog = $this->blogRepository->show($id);
        $blog->delete();
        return back()->withErrors('Trashed Successfully');
    }

    public function delete(Request $request, $id)
    {
        $this->blogRepository->restoreOrDelete($id);
        return back()->withErrors('Deleted Successfully');
    }
}
