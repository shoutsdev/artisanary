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
        $blog->unique_id = 'PR-'.$blog->id;
        $blog->save();
    }

    public function updated(Blog $blog): void
    {
        //
    }

    public function deleted(Blog $blog): void
    {
        //
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
