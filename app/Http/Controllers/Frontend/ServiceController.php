<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
{
    $services = Service::where('status', 1)->latest()->paginate(6);
    return view('custom.service', compact('services'));
}

    public function show($id)
    {
        $service = Service::where('id', $id)->where('status', 1)->firstOrFail();
        return view('custom.service-detail', compact('service'));
    }
}
