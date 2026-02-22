@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

<div class="bg-white shadow-xl rounded-2xl p-8">

<h2 class="text-2xl font-bold mb-8">Website Settings</h2>

@if(session('success'))
<div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-6">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('admin.settings.update') }}"
      method="POST"
      enctype="multipart/form-data"
      class="grid grid-cols-12 gap-6">
@csrf

{{-- ================= GENERAL ================= --}}
<div class="col-span-12">
<h3 class="text-lg font-semibold border-b pb-2">General Settings</h3>
</div>

<div class="col-span-12 md:col-span-6">
<label>Website Name</label>
<input type="text" name="site_name"
value="{{ $setting->site_name ?? '' }}"
class="w-full border rounded-xl px-4 py-2">
</div>

<div class="col-span-12 md:col-span-6">
<label>Tagline</label>
<input type="text" name="tagline"
value="{{ $setting->tagline ?? '' }}"
class="w-full border rounded-xl px-4 py-2">
</div>

<div class="col-span-12 md:col-span-6">
<label>Currency Symbol</label>
<input type="text" name="currency"
value="{{ $setting->currency ?? '₹' }}"
class="w-full border rounded-xl px-4 py-2">
</div>

<div class="col-span-12 md:col-span-6 flex items-center gap-3">
<label class="mt-6">
<input type="checkbox" name="maintenance_mode" value="1"
{{ isset($setting) && $setting->maintenance_mode ? 'checked' : '' }}>
Enable Maintenance Mode
</label>
</div>

{{-- Logo --}}
<div class="col-span-12 md:col-span-6">
<label>Logo</label>
@if($setting && $setting->getFirstMediaUrl('logo'))
<img src="{{ $setting->getFirstMediaUrl('logo') }}"
class="h-16 mb-3">
@endif
<input type="file" name="logo"
class="w-full border rounded-xl px-4 py-2">
</div>

{{-- Favicon --}}
<div class="col-span-12 md:col-span-6">
<label>Favicon</label>
@if($setting && $setting->getFirstMediaUrl('favicon'))
<img src="{{ $setting->getFirstMediaUrl('favicon') }}"
class="h-10 mb-3">
@endif
<input type="file" name="favicon"
class="w-full border rounded-xl px-4 py-2">
</div>

{{-- ================= CONTACT ================= --}}
<div class="col-span-12 mt-6">
<h3 class="text-lg font-semibold border-b pb-2">Contact Details</h3>
</div>

<div class="col-span-12 md:col-span-6">
<label>Phone</label>
<input type="text" name="phone"
value="{{ $setting->phone ?? '' }}"
class="w-full border rounded-xl px-4 py-2">
</div>

<div class="col-span-12 md:col-span-6">
<label>WhatsApp</label>
<input type="text" name="whatsapp"
value="{{ $setting->whatsapp ?? '' }}"
class="w-full border rounded-xl px-4 py-2">
</div>

<div class="col-span-12 md:col-span-6">
<label>Email</label>
<input type="text" name="email"
value="{{ $setting->email ?? '' }}"
class="w-full border rounded-xl px-4 py-2">
</div>

<div class="col-span-12 md:col-span-6">
<label>Address</label>
<input type="text" name="address"
value="{{ $setting->address ?? '' }}"
class="w-full border rounded-xl px-4 py-2">
</div>

<div class="col-span-12">
<label>Google Map Embed Code</label>
<textarea name="google_map"
rows="3"
class="w-full border rounded-xl px-4 py-2">{{ $setting->google_map ?? '' }}</textarea>
</div>

{{-- ================= SOCIAL ================= --}}
<div class="col-span-12 mt-6">
<h3 class="text-lg font-semibold border-b pb-2">Social Links</h3>
</div>

@foreach(['facebook','instagram','twitter','youtube'] as $social)
<div class="col-span-12 md:col-span-6">
<label>{{ ucfirst($social) }}</label>
<input type="text" name="{{ $social }}"
value="{{ $setting->$social ?? '' }}"
class="w-full border rounded-xl px-4 py-2">
</div>
@endforeach

{{-- ================= SEO ================= --}}
<div class="col-span-12 mt-6">
<h3 class="text-lg font-semibold border-b pb-2">SEO Settings</h3>
</div>

<div class="col-span-12 md:col-span-6">
<label>Meta Title</label>
<input type="text" name="meta_title"
value="{{ $setting->meta_title ?? '' }}"
class="w-full border rounded-xl px-4 py-2">
</div>

<div class="col-span-12 md:col-span-6">
<label>Meta Description</label>
<textarea name="meta_description"
rows="2"
class="w-full border rounded-xl px-4 py-2">{{ $setting->meta_description ?? '' }}</textarea>
</div>

<div class="col-span-12">
<label>Google Analytics Code</label>
<textarea name="google_analytics"
rows="3"
class="w-full border rounded-xl px-4 py-2">{{ $setting->google_analytics ?? '' }}</textarea>
</div>

{{-- ================= FOOTER ================= --}}
<div class="col-span-12 mt-6">
<h3 class="text-lg font-semibold border-b pb-2">Footer Settings</h3>
</div>

<div class="col-span-12">
<label>Footer About Text</label>
<textarea name="footer_about"
rows="3"
class="w-full border rounded-xl px-4 py-2">{{ $setting->footer_about ?? '' }}</textarea>
</div>

<div class="col-span-12 md:col-span-6">
<label>Copyright Text</label>
<input type="text" name="copyright_text"
value="{{ $setting->copyright_text ?? '' }}"
class="w-full border rounded-xl px-4 py-2">
</div>

{{-- Submit --}}
<div class="col-span-12 flex justify-end pt-6">
<button class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl shadow">
Save Settings
</button>
</div>

</form>
</div>
</div>
@endsection