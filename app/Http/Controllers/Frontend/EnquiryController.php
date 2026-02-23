<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'listing_id' => 'required',
            'name' => 'required',
            'phone' => 'required'
        ]);

        Enquiry::create([
            'listing_id' => $request->listing_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'travel_date' => $request->travel_date,
            'persons' => $request->persons,
            'message' => $request->message,
            'status' => 0
        ]);

        return back()->with('success','Enquiry Sent Successfully');
    }
}