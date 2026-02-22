<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'site_name','tagline','currency','maintenance_mode',
        'phone','whatsapp','email','address','google_map',
        'facebook','instagram','twitter','youtube',
        'meta_title','meta_description','google_analytics',
        'footer_about','copyright_text'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')->singleFile();
        $this->addMediaCollection('favicon')->singleFile();
    }
}