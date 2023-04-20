<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Repositories\BlogRepository;

class BlogController extends Controller
{
    protected $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $data = [
                'blogs' => $this->blogRepository->all()
            ];
            return view('backend.blogs.index', $data);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.blogs.form');
    }
    public function store(BlogRequest $request)
    {
        try {
            $this->blogRepository->store($request->all());
            return redirect()->route('blogs.index')->with('success', 'Blog created successfully');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
    public function edit(string $id): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $data = [
                'edit' => $this->blogRepository->find($id)
            ];
            return view('backend.blogs.form', $data);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function update(BlogRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->blogRepository->update($id, $request->all());
            return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(string $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->blogRepository->destroy($id);
            return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
