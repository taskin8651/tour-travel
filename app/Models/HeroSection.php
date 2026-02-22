<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class HeroSection extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'subtitle',
        'button_text',
        'button_link',
        'status'
    ];

    public function registerMediaCollections(): void
{
    $this->addMediaCollection('hero_media')
         ->singleFile(); // video ya image ek hi file
}
}