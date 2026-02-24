<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'category_id',
        'listing_id',
        'name',
        'email',
        'phone',

        // Travel
        'travel_date',
        'persons',

        // Room
        'checkin_date',
        'checkout_date',
        'rooms',

        // Sikkim
        'package_requirements',

        // Common
        'message',
        'status'
    ];

    protected $casts = [
        'travel_date'   => 'date',
        'checkin_date'  => 'date',
        'checkout_date' => 'date',
    ];

    // ================= Relations =================

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // ================= Status Constants =================

    const STATUS_PENDING = 'pending';
const STATUS_CONFIRMED = 'confirmed';
const STATUS_CANCELLED = 'cancelled';
}