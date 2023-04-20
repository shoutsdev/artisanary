<?php

namespace App\Repositories;

use App\Models\Blog;

class BlogRepository
{
    public function all()
    {
        return Blog::latest()->paginate();
    }
}
