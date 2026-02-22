<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'blog_category_id',
        'title','slug',
        'short_description','content',
        'meta_title','meta_description',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class,'blog_category_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('blog')->singleFile();
    }
}