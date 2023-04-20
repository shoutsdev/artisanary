<?php

namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BlogRepository
{
    public function all()
    {
        return Blog::latest()->paginate();
    }

    protected function createData($data)
    {
        if (array_key_exists('image', $data)) {
            $image = $data['image'];
            $image_name = Str::uuid() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/');

            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            Image::make($data['image'])->resize(50,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.$image_name);

            $data['image'] = 'uploads/'.$image_name;
        }

        return $data;
    }
    public function store($data)
    {
        return Blog::create($this->createData($data));
    }

    public function find($id)
    {
        return Blog::find($id);
    }

    public function update($id,$data)
    {
        $blog = $this->find($id);

        if (array_key_exists('image', $data) && $blog->image) {
            $image_path = public_path($blog->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        return $blog->update($this->createData($data));
    }

    public function destroy($id)
    {
        return Blog::destroy($id);
    }
}
