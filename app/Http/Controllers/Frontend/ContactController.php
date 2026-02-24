<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Contact Page
    public function index()
    {
        $setting = Setting::first(); // assuming single row

        return view('custom.contact', compact('setting'));
    }

    // Contact Form Submit
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string'
        ]);

        Enquiry::create([
            'name'   => $request->name,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'message'=> $request->message,
            'status' => Enquiry::STATUS_PENDING
        ]);

        return back()->with('success', 'Message Sent Successfully!');
    }
}