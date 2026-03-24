@extends('custom.master')
@section('content')

<!-- Start Breadcrumb section -->
<div class="breadcrumb-section" style="background-image:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(assets/img/innerpages/breadcrumb-bg1.jpg);">  
    <div class="container">
        <div class="banner-content text-center">
            <h1>Gallery</h1>
            <ul class="breadcrumb-list d-flex justify-content-center gap-2">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li> / </li>
                <li>Gallery</li>
            </ul>
        </div>
    </div>
</div>
<!-- End Breadcrumb section -->


<!-- Gallery Page Start -->
<div class="guider-page pt-100 mb-100">
    <div class="container">
        <div class="row gy-md-5 gy-4">

            @forelse($galleries as $gallery)
            <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp">

                <div class="tour-guide-card two">

                    <div class="guide-img-wrap">

                        <!-- IMAGE -->
                        <a href="{{ route('gallery.detail', $gallery->id) }}" class="guide-img">
                            <img 
                                src="{{ $gallery->getFirstMediaUrl('gallery') ?: asset('assets/img/default.jpg') }}" 
                                alt="{{ $gallery->title }}">
                        </a>

                        <!-- ICON -->
                        <ul class="social-list">
                            <li>
                                <a href="{{ route('gallery.detail', $gallery->id) }}">
                                    <i class="bx bx-search"></i>
                                </a>
                            </li>
                        </ul>

                    </div>

                    <!-- CONTENT -->
                    <div class="guide-info text-center">
                        <h5>
                            <a href="{{ route('gallery.detail', $gallery->id) }}">
                                {{ $gallery->title }}
                            </a>
                        </h5>
                        <span>Gallery</span>
                    </div>

                </div>

            </div>
            @empty
            <div class="col-12 text-center">
                <p>No gallery found.</p>
            </div>
            @endforelse

        </div>

        <!-- Pagination -->
        <div class="mt-5 d-flex justify-content-center">
            {{ $galleries->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>
<!-- Gallery Page End -->


<!-- 🔥 CUSTOM CSS -->
<style>

/* Square Image Fix */
.tour-guide-card .guide-img img {
    border-radius: 0 !important;
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: 0.3s;
}

/* Wrapper */
.tour-guide-card .guide-img-wrap {
    border-radius: 10px;
    overflow: hidden;
    position: relative;
}

/* Hover Zoom */
.tour-guide-card:hover .guide-img img {
    transform: scale(1.05);
}

/* Icon Position */
.tour-guide-card .social-list {
    position: absolute;
    top: 10px;
    right: 10px;
}

/* Icon Style */
.tour-guide-card .social-list li a {
    background: rgba(0,0,0,0.7);
    color: #fff;
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

/* Title */
.guide-info h5 {
    margin-top: 12px;
    font-size: 16px;
}

/* Pagination Fix */
.pagination {
    display: flex;
    padding-left: 0;
    list-style: none;
}

.page-item {
    margin: 0 4px;
}

.page-link {
    padding: 0.5rem 0.75rem;
    color: #0d6efd;
    background-color: #fff;
    border: 1px solid #dee2e6;
}

.page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: #fff;
}

</style>

@endsection