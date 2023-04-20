<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;

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
            return view('blogs.index', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        //
    }
    public function store(BlogRequest $request)
    {
        //
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        //
    }
    public function update(BlogRequest $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
