@php
$gallery = \App\Models\Gallery::where('status',1)->latest()->first();
@endphp

@if($gallery)
<section class="py-16 bg-gray-100">
<div class="max-w-7xl mx-auto px-6">

@if($gallery->title)
<h2 class="text-3xl font-bold text-center mb-10">
{{ $gallery->title }}
</h2>
@endif

<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
@foreach($gallery->getMedia('gallery') as $image)
<img src="{{ $image->getUrl() }}"
class="rounded-xl shadow hover:scale-105 transition">
@endforeach
</div>

</div>
</section>
@endif