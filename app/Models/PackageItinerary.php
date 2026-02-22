<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageItinerary extends Model
{
    protected $fillable = [
        'listing_id',
        'day_number',
        'title',
        'description'
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}