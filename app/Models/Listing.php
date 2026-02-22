<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Listing extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'title',
        'location',
        'price',
        'rooms',
        'seats',
        'days',
        'description',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function enquiries()
{
    return $this->hasMany(Enquiry::class);
}

public function itineraries()
{
    return $this->hasMany(PackageItinerary::class)->orderBy('day_number');
}
}