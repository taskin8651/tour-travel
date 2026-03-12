@extends('custom.master')
@section('content')


 <!-- Breadcrumb section Start-->
    <div class="breadcrumb-section three mb-50" style="background-image:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url({{ asset('assets/img/innerpages/breadcrumb-bg6.jpg') }});">  
        <div class="container">
            <div class="banner-content">
                <h1>{{ $category->name }}</h1>

    <ul class="breadcrumb-list">
        <li>
            <a href="{{ url('/') }}">Home</a>
        </li>

        @if(request('sub_category'))
            @php
                $activeSub = $subCategories->where('id', request('sub_category'))->first();
            @endphp

            <li>
                <a href="{{ route('category.page', $category->slug) }}">
                    {{ $category->name }}
                </a>
            </li>

            @if($activeSub)
                <li>{{ $activeSub->name }}</li>
            @endif
        @else
            <li>{{ $category->name }}</li>
        @endif

    </ul>
            </div>
        </div>
    </div>


     <div class="hotel-grid-page mb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="package-sidebar-area">
                        <div class="sidebar-wrapper">
                            <div class="title-area">
                                <h5>Filter</h5>
                                <a href="{{ route('category.page', $category->slug) }}" id="clear-filters">   Clear All</a>
                            </div>
                            <div class="single-widgets">
                                <div class="widget-title">
                                    <h5>Sub Category</h5>
                                </div>
                                <div class="checkbox-container two">
                                 <form method="GET" action="{{ route('category.page', $category->slug) }}">

<ul>
@foreach($subCategories as $sub)
    <li>
        <label class="containerss">
            <input type="radio"
                   name="sub_category"
                   value="{{ $sub->id }}"
                   onchange="this.form.submit()"
                   {{ request('sub_category') == $sub->id ? 'checked' : '' }}>
            <span class="checkmark"></span>
            <strong>
                <span>{{ $sub->name }}</span>
                <span>{{ $sub->listings()->where('status',1)->count() }}</span>
            </strong>
        </label>
    </li>
@endforeach
</ul>

</form>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="list-grid-product-wrap">
                        <div class="row gy-md-5 gy-4">
                            @foreach($listings as $listing)
                            <div class="col-md-6 item wow animate fadeInDown" data-wow-delay="200ms" data-wow-duration="1500ms">
    <div class="hotel-card">

        <div class="hotel-img-wrap">
                  <a href="{{ route('listing.detail', $listing->id) }}">
                    <img src="{{ $listing->getFirstMediaUrl('main') ?: asset('assets/img/default.jpg') }}"
                     alt="{{ $listing->title }}">
            </a>
        </div>

        <div class="hotel-content">

            <h5>{{ $listing->title }}</h5>

            <div class="location-area">
                <span>{{ $listing->location }}</span>
            </div>

            <ul class="hotel-feature-list">

               @if($category->slug == 'room-booking')

    @if($listing->rooms)
        <li>{{ $listing->rooms }} Rooms</li>
    @endif

    @if($listing->seats)
        <li>{{ $listing->seats }} Guests</li>
    @endif

    @if($listing->days)
        <li>{{ $listing->days }} Booking Days</li>
    @endif

@endif


@if($category->slug == 'travel-booking')

    @if($listing->days)
        <li>{{ $listing->days }} Days</li>
    @endif

    @if($listing->seats)
        <li>{{ $listing->seats }} Guests</li>
    @endif

@endif


@if($category->slug == 'tour-package')

    @if($listing->days)
        <li>{{ $listing->days }} Days</li>
    @endif

    @if($listing->rooms)
        <li>{{ $listing->rooms }} Nights</li>
    @endif

    @if($listing->seats)
        <li>{{ $listing->seats }} Guests</li>
    @endif

@endif

            </ul>

            <div class="btn-and-price-area">
                <a href="{{ route('enquiry.create', $listing->category->slug) }}" class="primary-btn1">
                    <span>Book Now</span>
                    <span>Book Now</span>
                </a>

                <div class="price-area">
                    <h6>
                        @if($category->slug == 'room-booking')
                            Per Night
                        @else
                            Per Person
                        @endif
                    </h6>

                    <span>₹{{ number_format($listing->price) }}</span>
                </div>
            </div>

        </div>
    </div>
</div>
@endforeach

                            
                        </div>
                    </div>
                  @if ($listings->hasPages())
<div class="pagination-area mt-60 wow animate fadeInUp">

    {{-- Previous Button --}}
    <div class="paginations-button">
        @if ($listings->onFirstPage())
            <span class="disabled">
                <svg width="10" height="10" viewBox="0 0 10 10">
                    <path d="M7.86133 9.28516C7.14704 7.49944 3.57561 5.71373 1.43276 4.99944C3.57561 4.28516 6.7899 3.21373 7.86133 0.713728" stroke-width="1.5" stroke-linecap="round" />
                </svg>
                Prev
            </span>
        @else
            <a href="{{ $listings->previousPageUrl() }}">
                <svg width="10" height="10" viewBox="0 0 10 10">
                    <path d="M7.86133 9.28516C7.14704 7.49944 3.57561 5.71373 1.43276 4.99944C3.57561 4.28516 6.7899 3.21373 7.86133 0.713728" stroke-width="1.5" stroke-linecap="round" />
                </svg>
                Prev
            </a>
        @endif
    </div>

    {{-- Page Numbers --}}
    <ul class="paginations">
        @foreach ($listings->getUrlRange(1, $listings->lastPage()) as $page => $url)
            <li class="page-item {{ $page == $listings->currentPage() ? 'active' : '' }}">
                <a href="{{ $url }}">
                    {{ str_pad($page, 2, '0', STR_PAD_LEFT) }}
                </a>
            </li>
        @endforeach
    </ul>

    {{-- Next Button --}}
    <div class="paginations-button">
        @if ($listings->hasMorePages())
            <a href="{{ $listings->nextPageUrl() }}">
                Next
                <svg width="10" height="10" viewBox="0 0 10 10">
                    <path d="M1.42969 9.28613C2.14397 7.50042 5.7154 5.7147 7.85826 5.00042C5.7154 4.28613 2.50112 3.21471 1.42969 0.714705" stroke-width="1.5" stroke-linecap="round" />
                </svg>
            </a>
        @else
            <span class="disabled">
                Next
                <svg width="10" height="10" viewBox="0 0 10 10">
                    <path d="M1.42969 9.28613C2.14397 7.50042 5.7154 5.7147 7.85826 5.00042C5.7154 4.28613 2.50112 3.21471 1.42969 0.714705" stroke-width="1.5" stroke-linecap="round" />
                </svg>
            </span>
        @endif
    </div>

</div>
@endif
                </div>
            </div>
        </div>
    </div>
@endsection