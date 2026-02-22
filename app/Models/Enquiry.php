<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'listing_id',
        'name',
        'email',
        'phone',
        'travel_date',
        'persons',
        'message',
        'status'
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}