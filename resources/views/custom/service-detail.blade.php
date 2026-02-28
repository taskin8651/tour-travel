@extends('custom.master')
@section('content')

<!-- Breadcrumb -->
<div class="breadcrumb-section"
     style="background-image:linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)), url({{ $service->getFirstMediaUrl('banner_image') }});">
    <div class="container">
        <div class="banner-content">
            <h1>{{ $service->title }}</h1>
            <ul class="breadcrumb-list">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>{{ $service->title }}</li>
            </ul>
        </div>
    </div>
</div>

<div class="package-details pt-100 mb-100">
    <div class="container">

        <!-- Featured Image -->
        <div class="mb-4">
            <img src="{{ $service->getFirstMediaUrl('featured_image') }}"
                 class="img-fluid rounded">
        </div>

        <!-- Description -->
        <div>
            <p>{!! nl2br(e($service->description)) !!}</p>
        </div>

        <!-- Gallery -->
        @if($service->getMedia('gallery')->count())
        <div class="row mt-5">
            @foreach($service->getMedia('gallery') as $media)
                <div class="col-md-4 mb-4">
                    <img src="{{ $media->getUrl() }}"
                         class="img-fluid rounded">
                </div>
            @endforeach
        </div>
        @endif

    </div>
</div>

@endsection