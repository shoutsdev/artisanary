<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Repositories\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    protected $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            $data = [
                'blogs' => BlogResource::collection($this->blogRepository->all())
            ];
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'title'         => 'required|string|max:255|unique:blogs,title',
            'description'   => 'required',
            'image'         => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        try {
            $data = $request->all();
            $data['user_id'] = 1;

            $this->blogRepository->store($data);
            return response()->json([
                'success' => 'Blog created successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $data = [
                'edit' => $this->blogRepository->find($id)
            ];
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'title'         => 'required|string|max:255|unique:blogs,title,'.$id,
            'description'   => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }
        try {
            $this->blogRepository->update($id, $request->all());
            return response()->json([
                'success' => 'Blog updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        try {
            $this->blogRepository->destroy($id);
            return response()->json([
                'success' => 'Blog deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
