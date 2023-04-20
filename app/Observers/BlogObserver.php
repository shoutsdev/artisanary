<?php

namespace App\Observers;

use App\Models\Blog;
use Illuminate\Support\Str;

class BlogObserver
{
    public function creating(Blog $blog)
    {
        $blog->slug = Str::slug($blog->title);
    }
    public function created(Blog $blog): void
    {
        $blog->unique_id    = 'PR-'.$blog->id;
        $blog->save();
    }

    public function updating(Blog $blog): void
    {
        $blog->slug = Str::slug($blog->title);
    }
    public function updated(Blog $blog): void
    {
        //
    }

    public function deleted(Blog $blog): void
    {
        $image_path = public_path($blog->image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    public function restored(Blog $blog): void
    {
        //
    }

    public function forceDeleted(Blog $blog): void
    {
        //
    }
}
