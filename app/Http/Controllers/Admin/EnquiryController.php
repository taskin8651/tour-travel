<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::with('listing')
                        ->latest()
                        ->get();

        return view('admin.enquiries.index', compact('enquiries'));
    }

    public function show(Enquiry $enquiry)
    {
        return view('admin.enquiries.show', compact('enquiry'));
    }

    public function update(Request $request, Enquiry $enquiry)
    {
        $enquiry->update([
            'status' => $request->status
        ]);

        return back()->with('success','Status Updated');
    }

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();

        return back()->with('success','Enquiry Deleted');
    }
}