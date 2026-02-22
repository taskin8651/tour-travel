@php
$testimonials = \App\Models\Testimonial::where('status',1)->get();
@endphp

<section class="py-16 bg-gray-100">
<div class="max-w-7xl mx-auto px-6">

<h2 class="text-3xl font-bold text-center mb-12">
What Our Clients Say
</h2>

<div class="grid md:grid-cols-3 gap-8">
@foreach($testimonials as $t)
<div class="bg-white p-6 rounded-xl shadow">

@if($t->getFirstMediaUrl('testimonial'))
<img src="{{ $t->getFirstMediaUrl('testimonial') }}"
class="w-16 h-16 rounded-full mb-4 object-cover">
@endif

<div class="text-yellow-400 mb-2">
@for($i=1;$i<=$t->rating;$i++)
★
@endfor
</div>

<p class="text-gray-600 mb-4">
{{ $t->review }}
</p>

<h4 class="font-semibold">
{{ $t->name }}
</h4>

@if($t->designation)
<span class="text-sm text-gray-500">
{{ $t->designation }}
</span>
@endif

</div>
@endforeach
</div>

</div>
</section>