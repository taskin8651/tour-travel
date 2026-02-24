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
    // dd($request->all());
    $request->validate([
        'status' => 'required|in:pending,confirmed,cancelled'
    ]);

    $enquiry->update([
        'status' => $request->status
    ]);
    // dd($enquiry->status);

    return redirect()
            ->route('admin.enquiries.show', $enquiry->id)
            ->with('success','Status Updated Successfully');
}

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();

        return back()->with('success','Enquiry Deleted');
    }
}