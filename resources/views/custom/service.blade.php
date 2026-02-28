@extends('custom.master')
@section('content')

<!-- Breadcrumb -->
<div class="breadcrumb-section"
     style="background-image:linear-gradient(rgba(0,0,0,0.4),rgba(0,0,0,0.4)), url({{ asset('assets/img/innerpages/breadcrumb-bg3.jpg') }});">
    <div class="container">
        <div class="banner-content">
            <h1>Tour Packages</h1>
            <ul class="breadcrumb-list">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Tour Packages</li>
            </ul>
        </div>
    </div>
</div>

<!-- Package Grid -->
<div class="package-grid-page pt-100 mb-100">
    <div class="container">
        <div class="row gy-4">

            @forelse($services as $service)
            <div class="col-lg-4 col-md-6">

                <div class="package-card four">

                    <!-- Image -->
                    <div class="package-img-wrap">
                        <a href="{{ route('service.detail', $service->slug) }}"
                           class="package-img">

                            <img src="{{ $service->getFirstMediaUrl('featured_image') ?: asset('assets/img/innerpages/tour-package-img1.jpg') }}"
                                 alt="{{ $service->title }}">
                        </a>

                        <div class="batch">
                            <span>Hot Deal</span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="package-content">
                        <div class="package-content-title-area">

                            <h5>
                                <a href="{{ route('service.detail', $service->slug) }}">
                                    {{ $service->title }}
                                </a>
                            </h5>

                            <p>
                                {{ \Illuminate\Support\Str::limit($service->short_description, 100) }}
                            </p>
                        </div>

                        <div class="btn-and-price-area mt-3">
                            <a href="{{ route('service.detail', $service->slug) }}"
                               class="primary-btn1">
                                <span>View Details</span>
                                <span>View Details</span>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
            @empty
            <div class="col-12 text-center">
                <h4>No Packages Available</h4>
            </div>
            @endforelse

        </div>

        <!-- Pagination -->
        <div class="pagination-area mt-60">
            {{ $services->links() }}
        </div>

    </div>
</div>

@endsection