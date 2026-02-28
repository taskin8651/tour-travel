@extends('custom.master')

@section('content')

@php
    $mediaUrl = isset($hero) ? $hero->getFirstMediaUrl('hero_media') : null;
@endphp
  <!-- home1 Banner Section Start-->
    <div class="home1-banner-section">
        <div class="banner-video-area">
            @if(isset($hero) && $mediaUrl)

            {{-- If Video --}}
            @if(\Illuminate\Support\Str::endsWith($mediaUrl, '.mp4'))
                <video autoplay loop muted playsinline>
                    <source src="{{ $mediaUrl }}" type="video/mp4">
                </video>
            @else
                <img src="{{ $mediaUrl }}" alt="Hero Banner">
            @endif

        @else
            {{-- DEFAULT FALLBACK VIDEO --}}
            <video autoplay loop muted playsinline>
                <source src="{{ asset('assets/video/home1-banner-video.mp4') }}" type="video/mp4">
            </video>
        @endif
        </div>
        <div class="banner-content-wrap">
            <div class="container">
                <div class="banner-content">
                    @if(isset($hero))
                <h1>{{ $hero->title ?? 'All-in-one Travel Booking' }}</h1>
                <p>{{ $hero->subtitle ?? 'Book tours, hotels & experiences easily in one place.' }}</p>

                @if($hero->button_text)
                    <a href="{{ $hero->button_link ?? '#' }}"
                       class="btn btn-primary mt-3">
                        {{ $hero->button_text }}
                    </a>
                @endif
            @else
                {{-- DEFAULT TEXT --}}
                <h1>All-in-one Travel Booking</h1>
                <p>
                    Highlights convenience and simplicity, Best for agencies with online & mobile-friendly services.
                </p>
                <a href="#" class="btn btn-primary mt-3">
                    Explore Now
                </a>
            @endif
                </div>
            </div>
        </div>
    </div>


 
{{-- ================= HERO SECTION END ================= --}}
    <div class="filter-wrapper mb-100">
    <div class="container">

        {{-- CATEGORY TABS --}}
        <ul class="filter-item-list">
            @foreach($categories as $key => $category)
                <li class="single-item {{ $key == 0 ? 'active' : '' }}"
                    data-id="{{ $category->id }}"
                    data-slug="{{ $category->slug }}">

                    {{-- Travel Booking SVG --}}
                    @if($category->slug == 'travel-booking')
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <path d="M12 2L15 8H9L12 2Z"/>
                            <path d="M4 10H20V22H4V10Z"/>
                        </svg>

                    {{-- Room Booking SVG --}}
                    @elseif($category->slug == 'room-booking')
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <path d="M3 11H21V21H3V11Z"/>
                            <path d="M7 11V7H17V11"/>
                        </svg>

                    {{-- Sikkim Package SVG --}}
                    @elseif($category->slug == 'tour-package')
                        <svg width="24" height="24" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M8 12L11 15L16 9"/>
                        </svg>
                    @endif

                    <span>{{ $category->name }}</span>
                </li>
            @endforeach
        </ul>

        <div class="filter-input-wrap">

         <form method="POST" action="{{ route('frontend.enquiry.store') }}">
    @csrf

    {{-- Hidden Category --}}
    <input type="hidden"
           name="category_id"
           id="selectedCategory"
           value="{{ $categories->first()->id ?? '' }}">

    <div class="row g-3 mb-60">

        {{-- FULL NAME --}}
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-inner">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="Your Name" required>
            </div>
        </div>

        {{-- EMAIL --}}
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-inner">
                <label>Email</label>
                <input type="email" name="email" placeholder="Email" required>
            </div>
        </div>

        {{-- PHONE --}}
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-inner">
                <label>Phone</label>
                <input type="text" name="phone" placeholder="Phone" required>
            </div>
        </div>

        {{-- LISTING SELECT --}}
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="form-inner">
                <label>Select Listing</label>
                <select name="listing_id" id="listingSelect" required>
                    <option value="">Select Listing</option>

                    @foreach($listings as $listing)
    <option value="{{ $listing->id }}"
            data-category="{{ $listing->category_id }}">
        {{ $listing->title }} (₹{{ $listing->price }})
    </option>
@endforeach

                </select>
            </div>
        </div>

        {{-- ================= TRAVEL BOOKING ================= --}}
        <div class="category-fields travel-booking-fields col-lg-3 col-md-6 col-sm-12">
            <div class="form-inner">
                <label>Travel Date</label>
                <input type="date" name="travel_date">
            </div>
        </div>

        <div class="category-fields travel-booking-fields col-lg-3 col-md-6 col-sm-12">
            <div class="form-inner">
                <label>Persons</label>
                <input type="number" name="persons" placeholder="02">
            </div>
        </div>

        {{-- ================= ROOM BOOKING ================= --}}
        <div class="category-fields room-booking-fields d-none col-lg-3 col-md-6 col-sm-12">
            <div class="form-inner">
                <label>Check-in</label>
                <input type="date" name="checkin_date">
            </div>
        </div>

        <div class="category-fields room-booking-fields d-none col-lg-3 col-md-6 col-sm-12">
            <div class="form-inner">
                <label>Check-out</label>
                <input type="date" name="checkout_date">
            </div>
        </div>

        <div class="category-fields room-booking-fields d-none col-lg-3 col-md-6 col-sm-12">
            <div class="form-inner">
                <label>Rooms</label>
                <input type="number" name="rooms" placeholder="01">
            </div>
        </div>

        {{-- ================= TOUR PACKAGE ================= --}}
        <div class="category-fields tour-package-fields d-none col-lg-6 col-md-12">
            <div class="form-inner">
                <label>Package Requirements</label>
                <textarea name="package_requirements"
                          placeholder="Write your requirements"></textarea>
            </div>
        </div>

        {{-- MESSAGE --}}
        <div class="col-lg-6 col-md-12">
            <div class="form-inner">
                <label>Message</label>
                <textarea name="message"
                          placeholder="Your message"></textarea>
            </div>
        </div>

    </div>

    <button type="submit" class="primary-btn1">
        <span>Submit Now</span>
        <span>Submit Now</span>
    </button>

</form>


            <p>
                Can’t find what you’re looking for?
                create your <a href="">Custom Itinerary</a>
            </p>

        </div>
    </div>
</div>

{{-- ========================= --}}
{{-- SCRIPT --}}
{{-- ========================= --}}
<script>
document.addEventListener("DOMContentLoaded", function () {

    const tabs = document.querySelectorAll('.filter-item-list .single-item');
    const hiddenCategory = document.getElementById('selectedCategory');
    const listingSelect = document.getElementById('listingSelect');
    const allCategoryFields = document.querySelectorAll('.category-fields');

    // Store original options once
    if (!listingSelect.dataset.originalOptions) {
        listingSelect.dataset.originalOptions = listingSelect.innerHTML;
    }

    // ============================
    // Hide All Category Fields
    // ============================
    function hideAllFields() {
        allCategoryFields.forEach(field => field.classList.add('d-none'));
    }

    // ============================
    // Show Fields by Slug
    // ============================
    function showFields(slug) {

        hideAllFields();

        if (slug === 'travel-booking') {
            document.querySelectorAll('.travel-booking-fields')
                .forEach(el => el.classList.remove('d-none'));
        }

        if (slug === 'room-booking') {
            document.querySelectorAll('.room-booking-fields')
                .forEach(el => el.classList.remove('d-none'));
        }

        if (slug === 'tour-package') {
            document.querySelectorAll('.tour-package-fields')
                .forEach(el => el.classList.remove('d-none'));
        }
    }

    // ============================
    // Filter Listings (Rebuild Select)
    // ============================
    function filterListings(categoryId) {

        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = `<select>${listingSelect.dataset.originalOptions}</select>`;
        const allOptions = tempDiv.querySelectorAll('option');

        listingSelect.innerHTML = '<option value="">Select Listing</option>';

        allOptions.forEach(option => {

            if (!option.value) return;

            if (option.dataset.category == categoryId) {
                listingSelect.appendChild(option.cloneNode(true));
            }

        });

        listingSelect.value = "";

        // 🔥 Reinitialize Nice Select properly
        if (typeof $ !== 'undefined') {

            if ($(listingSelect).next('.nice-select').length) {
                $(listingSelect).niceSelect('destroy');
            }

            $(listingSelect).niceSelect();
        }
    }

    // ============================
    // Tab Click
    // ============================
    tabs.forEach(tab => {

        tab.addEventListener('click', function () {

            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            const categoryId = this.dataset.id;
            const slug = this.dataset.slug;

            hiddenCategory.value = categoryId;

            filterListings(categoryId);
            showFields(slug);

        });

    });

    // ============================
    // Initial Load
    // ============================
    const activeTab = document.querySelector('.filter-item-list .single-item.active');

    if (activeTab) {
        const categoryId = activeTab.dataset.id;
        const slug = activeTab.dataset.slug;

        hiddenCategory.value = categoryId;

        filterListings(categoryId);
        showFields(slug);
    }

});
</script>

    <!-- home1 Banner Section End-->




    <!-- home1 destination Section Start-->
   <div class="home1-destination-section mb-100">
    <div class="container">

        <div class="row justify-content-center mb-60">
            <div class="col-lg-10">
                <div class="section-title text-center">
                    <h2>Featured Packages</h2>
                </div>

                {{-- NAV TABS --}}
                <ul class="nav nav-pills justify-content-center" role="tablist">

                    {{-- ALL TAB --}}
                    <li class="nav-item">
                        <button class="nav-link active"
                                data-bs-toggle="pill"
                                data-bs-target="#sub-all"
                                type="button">
                            All
                        </button>
                    </li>

                    {{-- SUB CATEGORY TABS --}}
                    @foreach($packageCategory->subCategories as $sub)
                        <li class="nav-item">
                            <button class="nav-link"
                                    data-bs-toggle="pill"
                                    data-bs-target="#sub-{{ $sub->id }}"
                                    type="button">
                                {{ $sub->name }}
                            </button>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>

        {{-- TAB CONTENT --}}
        <div class="tab-content">

            {{-- ================= ALL TAB ================= --}}
            <div class="tab-pane fade show active" id="sub-all">

                <div class="swiper home1-destination-slider mb-40">
                    <div class="swiper-wrapper">

                        @foreach($packageCategory->subCategories as $sub)
                            @foreach($sub->listings as $listing)
                               <div class="swiper-slide">
    <div class="destination-card">

        <a href="{{ route('listing.detail', $listing->id) }}" class="destination-img">
            <img src="{{ $listing->getFirstMediaUrl('main') ?: asset('assets/img/default.jpg') }}"
                 alt="{{ $listing->title }}">
        </a>

        <div class="destination-content">
            <a href="{{ route('listing.detail', $listing->id) }}" class="title-area">
                {{ $listing->title }}
            </a>

            <div class="content">
                <p>
                    ₹{{ number_format($listing->price) }}
                    | {{ $listing->days }} Days
                </p>
            </div>
        </div>

    </div>
</div>
                            @endforeach
                        @endforeach

                    </div>
                </div>

            </div>

            {{-- ================= SUB CATEGORY TABS ================= --}}
            @foreach($packageCategory->subCategories as $sub)

                <div class="tab-pane fade" id="sub-{{ $sub->id }}">

                    <div class="swiper home1-destination-slider mb-40">
                        <div class="swiper-wrapper">

                            @foreach($sub->listings as $listing)
<div class="swiper-slide">
    <div class="destination-card">

        <a href="{{ route('listing.detail', $listing->id) }}" class="destination-img">
            <img src="{{ $listing->getFirstMediaUrl('main') ?: asset('assets/img/default.jpg') }}"
                 alt="{{ $listing->title }}">
        </a>

        <div class="destination-content">
            <a href="{{ route('listing.detail', $listing->id) }}" class="title-area">
                {{ $listing->title }}
            </a>

            <div class="content">
                <p>
                    ₹{{ number_format($listing->price) }}
                    | {{ $listing->days }} Days
                </p>
            </div>
        </div>

    </div>
</div>                            @endforeach

                        </div>
                    </div>

                </div>

            @endforeach

        </div>

    </div>
</div>

<script>
document.querySelectorAll('button[data-bs-toggle="pill"]').forEach(tab => {
    tab.addEventListener('shown.bs.tab', function () {

        document.querySelectorAll('.swiper').forEach(swiperEl => {
            if (swiperEl.swiper) {
                swiperEl.swiper.update();
            }
        });

    });
});
</script>



 <!-- home1 travel package Section Start-->
    <div class="home1-travel-package-section mb-100">
    <div class="container">

        <div class="row justify-content-center mb-50">
            <div class="col-xl-6 col-lg-8">
                <div class="section-title text-center">
                    <h2>Popular Travel Package</h2>
                    <p>A curated list of the most popular travel packages.</p>
                </div>
            </div>
        </div>

        <div class="row gy-lg-5 gy-4">

            @foreach($travelListings as $listing)

                <div class="col-lg-4 col-md-6">
                    <div class="package-card">

                        {{-- IMAGE --}}
                        <div class="package-img-wrap">
                            <a href="{{ route('listing.detail', $listing->id) }}" class="package-img">
                                <img src="{{ $listing->getFirstMediaUrl('main') ?: asset('assets/img/default.jpg') }}"
                                     alt="{{ $listing->title }}">
                            </a>
                        </div>

                        <div class="package-content">

                            {{-- TITLE --}}
                            <h5>
                                <a href="{{ route('listing.detail', $listing->id) }}">
                                    {{ $listing->title }}
                                </a>
                            </h5>

                            {{-- LOCATION + DAYS --}}
                            <div class="location-and-time">

                                <div class="location">
                                    <svg width="14" height="14">
                                        <circle cx="7" cy="7" r="6"/>
                                    </svg>
                                    <span>{{ $listing->location }}</span>
                                </div>

                                <span>{{ $listing->days }} Days</span>
                            </div>

                            {{-- BUTTON + PRICE --}}
                            <div class="btn-and-price-area">

                                <a href="{{ route('enquiry.create', $listing->category->slug) }}" class="primary-btn1">
                                    <span>Book Now</span>
                                    <span>Book Now</span>
                                </a>

                                <div class="price-area">
                                    <h6>Per Person</h6>
                                    <span>₹{{ number_format($listing->price) }}</span>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

            @endforeach

        </div>

    </div>
</div>
    <!-- home1 travel package Section End-->



     <!-- Home10 Hotel And Room Section Start -->
    <div class="home10-hotel-and-room-section">
        <div class="container">
            <div class="row justify-content-center mb-60">
                <div class="col-xl-5 col-lg-7">
                    <div class="section-title white text-center">
                        <h2>Luxury Living Spaces</h2>
                        <p>A curated list of the most popular travel packages based on
                            different destinations.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mb-60">
            <div class="hotel-and-room-slider-wrapper">
                <div class="swiper home10-hotel-slider">
                    <div class="swiper-wrapper">
                       @foreach($roomListings as $listing)

        <div class="swiper-slide">
            <div class="hotel-room-card">

                {{-- IMAGE --}}
                <div class="hotel-room-img-area">
                    <img src="{{ $listing->getFirstMediaUrl('main') ?: asset('assets/img/default.jpg') }}"
                         alt="{{ $listing->title }}">

                    <div class="price">
                        <h6>₹{{ number_format($listing->price) }}</h6>
                        <span>/per night</span>
                    </div>

                    <ul class="room-details">

                        {{-- Room Size (if stored in description or custom field) --}}
                        <li class="single-room">
                            <div class="single-room-content">
                                <h6>{{ $listing->rooms ?? 1 }}</h6>
                                <span>Rooms</span>
                            </div>
                        </li>

                        {{-- Seats / Guests --}}
                        <li class="single-room">
                            <div class="single-room-content">
                                <h6>{{ $listing->seats ?? 2 }} Guest</h6>
                            </div>
                        </li>

                    </ul>
                </div>

                {{-- CONTENT --}}
                <div class="hotel-room-content">
                    <h4>
                        <a href="{{ route('listing.detail', $listing->id) }}">
                            {{ $listing->title }}
                        </a>
                    </h4>

                    <div class="rating-area-and-text">
                        <ul class="rating-area">
                            <li><i class="bi bi-star-fill"></i></li>
                            <li><i class="bi bi-star-fill"></i></li>
                            <li><i class="bi bi-star-fill"></i></li>
                            <li><i class="bi bi-star-fill"></i></li>
                            <li><i class="bi bi-star-fill"></i></li>
                        </ul>
                        <span>(5.0)</span>
                    </div>
                </div>

            </div>
        </div>

        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="slider-btn-grp">
                <div class="slider-btn home10-room-hotel-slider-prev">
                    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.5999 20.3917C11.7476 20.3956 11.8933 20.3567 12.0195 20.2797C12.3911 20.0509 12.5043 19.5541 12.2807 19.1829C12.2619 19.1501 9.92625 15.2525 5.46785 12.7997H22.7999C23.2411 12.7997 23.5999 12.4409 23.5999 11.9997C23.5999 11.5585 23.2411 11.1997 22.7999 11.1997H5.46785C9.90145 8.76086 12.2635 4.84606 12.2867 4.80686C12.5055 4.43326 12.3843 3.93606 12.0111 3.71486C11.6327 3.49046 11.1343 3.62046 10.9083 4.00086C10.5447 4.58086 7.13505 9.78046 1.01945 11.2193C0.653454 11.3093 0.399853 11.6297 0.399853 12.0001C0.399853 12.3705 0.651854 12.6917 1.01265 12.7793C7.15425 14.2233 10.5523 19.4297 10.9195 20.0189C11.0635 20.2497 11.3299 20.3865 11.5999 20.3917Z" />
                    </svg>
                </div>
                <div class="progress-pagination2"></div>
                <div class="slider-btn home10-room-hotel-slider-next">
                    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.4001 20.3917C12.2524 20.3956 12.1067 20.3567 11.9805 20.2797C11.6089 20.0509 11.4957 19.5541 11.7193 19.1829C11.7381 19.1501 14.0737 15.2525 18.5321 12.7997H1.20015C0.758946 12.7997 0.400146 12.4409 0.400146 11.9997C0.400146 11.5585 0.758946 11.1997 1.20015 11.1997H18.5321C14.0985 8.76086 11.7365 4.84606 11.7133 4.80686C11.4945 4.43326 11.6157 3.93606 11.9889 3.71486C12.3673 3.49046 12.8657 3.62046 13.0917 4.00086C13.4553 4.58086 16.8649 9.78046 22.9805 11.2193C23.3465 11.3093 23.6001 11.6297 23.6001 12.0001C23.6001 12.3705 23.3481 12.6917 22.9873 12.7793C16.8457 14.2233 13.4477 19.4297 13.0805 20.0189C12.9365 20.2497 12.6701 20.3865 12.4001 20.3917Z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <!-- Home10 Hotel And Room Section End -->

    <!-- Home3 Gallery Section Start -->
<div class="home3-destination-section mb-100">
    <div class="container">

        <div class="row justify-content-center mb-50">
            <div class="col-lg-8">
                <div class="section-title text-center">
                    <span>Our Travel Moments</span>
                    <h2>Explore Our Gallery</h2>
                    <p>A collection of beautiful travel memories captured during our amazing journeys.</p>
                </div>
            </div>
        </div>

        <div class="destination-slider-area">
            <div class="swiper home3-destination-slider">
                <div class="swiper-wrapper">

                    @forelse($galleryImages as $gallery)
                        @foreach($gallery->getMedia('gallery') as $image)
                            <div class="swiper-slide">
                                <div class="destination-card2 two">
                                    <div class="destination-img">
                                        <img src="{{ $image->getUrl() }}" alt="{{ $gallery->title }}">

                                        <!-- Optional Fancybox Preview -->
                                        <a data-fancybox="gallery" 
                                           href="{{ $image->getUrl() }}" 
                                           class="arrow">
                                            <svg width="14" height="14" viewBox="0 0 14 14">
                                                <path d="M1 13C5.9 8 13 1 13 1" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                        </a>
                                    </div>

                                    <div class="destination-content text-center">
                                        <h5>{{ $gallery->title }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @empty
                        <div class="swiper-slide">
                            <div class="text-center">
                                <p>No gallery images available.</p>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>

            <!-- Slider Buttons -->
            <div class="slider-btn-grp two">
                <div class="slider-btn destination-slider-prev">‹</div>
                <div class="slider-btn destination-slider-next">›</div>
            </div>

        </div>
    </div>
</div>
<!-- Home3 Gallery Section End -->

    <!-- home1 offer banner Section Start-->
    <div class="home1-offer-banner-section mb-100" style="background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.3) 100%), url(assets/img/home1/home1-offer-banner-bg.jpg);">
        <div class="container">
            <div class="banner-content">
                <span>Make Meet Happiness.</span>
                <h2>Travel isn’t a luxury, it’s a way of life!</h2>
                <div class="author-area">
                    <span>CEO, {{ $setting->site_name }}</span>
                </div>
                <a href="{{ route('contact.page') }}" class="primary-btn1 two">
                    <span>
                        Grab the Deal Now
                        <svg width="10" height="10" viewBox="0 0 10 10" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.73535 1.14746C9.57033 1.97255 9.32924 3.26406 9.24902 4.66797C9.16817 6.08312 9.25559 7.5453 9.70214 8.73633C9.84754 9.12406 9.65129 9.55659 9.26367 9.70215C8.9001 9.83849 8.4969 9.67455 8.32812 9.33398L8.29785 9.26367L8.19921 8.98438C7.73487 7.5758 7.67054 5.98959 7.75097 4.58203C7.77875 4.09598 7.82525 3.62422 7.87988 3.17969L1.53027 9.53027C1.23738 9.82317 0.762615 9.82317 0.469722 9.53027C0.176829 9.23738 0.176829 8.76262 0.469722 8.46973L6.83593 2.10254C6.3319 2.16472 5.79596 2.21841 5.25 2.24902C3.8302 2.32862 2.2474 2.26906 0.958003 1.79102L0.704097 1.68945L0.635738 1.65527C0.303274 1.47099 0.157578 1.06102 0.310542 0.704102C0.463655 0.347333 0.860941 0.170391 1.22363 0.28418L1.29589 0.310547L1.48828 0.387695C2.47399 0.751207 3.79966 0.827571 5.16601 0.750977C6.60111 0.670504 7.97842 0.428235 8.86132 0.262695L9.95312 0.0585938L9.73535 1.14746Z"/>
                        </svg>
                    </span>
                    <span>
                        Grab the Deal Now
                        <svg width="10" height="10" viewBox="0 0 10 10" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.73535 1.14746C9.57033 1.97255 9.32924 3.26406 9.24902 4.66797C9.16817 6.08312 9.25559 7.5453 9.70214 8.73633C9.84754 9.12406 9.65129 9.55659 9.26367 9.70215C8.9001 9.83849 8.4969 9.67455 8.32812 9.33398L8.29785 9.26367L8.19921 8.98438C7.73487 7.5758 7.67054 5.98959 7.75097 4.58203C7.77875 4.09598 7.82525 3.62422 7.87988 3.17969L1.53027 9.53027C1.23738 9.82317 0.762615 9.82317 0.469722 9.53027C0.176829 9.23738 0.176829 8.76262 0.469722 8.46973L6.83593 2.10254C6.3319 2.16472 5.79596 2.21841 5.25 2.24902C3.8302 2.32862 2.2474 2.26906 0.958003 1.79102L0.704097 1.68945L0.635738 1.65527C0.303274 1.47099 0.157578 1.06102 0.310542 0.704102C0.463655 0.347333 0.860941 0.170391 1.22363 0.28418L1.29589 0.310547L1.48828 0.387695C2.47399 0.751207 3.79966 0.827571 5.16601 0.750977C6.60111 0.670504 7.97842 0.428235 8.86132 0.262695L9.95312 0.0585938L9.73535 1.14746Z"/>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
    <!-- home1 offer banner Section End-->

    <!-- home1 offer package Section Start-->
<div class="home1-offer-package-section mb-100">
    <div class="container">

        <div class="row justify-content-center mb-50">
            <div class="col-xl-6 col-lg-8">
                <div class="section-title text-center">
                    <h2>Last Minute Deals!</h2>
                    <p>Explore our latest travel packages.</p>
                </div>
            </div>
        </div>

        <div class="row gy-md-5 gy-4">

            @foreach($services as $service)
            <div class="col-lg-4 col-md-6">
                <div class="package-card">

                    <!-- Image Slider -->
                    <div class="package-img-wrap">
                        <div class="swiper package-card-img-slider">
                            <div class="swiper-wrapper">

                                {{-- Featured Image --}}
                                @if($service->getFirstMediaUrl('featured_image'))
                                <div class="swiper-slide">
                                    <a href="{{ route('service.detail', $service->slug) }}" class="package-img">
                                        <img src="{{ $service->getFirstMediaUrl('featured_image') }}"
                                             alt="{{ $service->title }}">
                                    </a>
                                </div>
                                @endif

                                {{-- Gallery Images --}}
                                @foreach($service->getMedia('gallery') as $media)
                                <div class="swiper-slide">
                                    <a href="{{ route('service.detail', $service->slug) }}" class="package-img">
                                        <img src="{{ $media->getUrl() }}" alt="">
                                    </a>
                                </div>
                                @endforeach

                            </div>
                        </div>

                        <div class="batch">
                            <span>Hot Deal</span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="package-content">

                        <h5>
                            <a href="{{ route('service.detail', $service->slug) }}">
                                {{ $service->title }}
                            </a>
                        </h5>

                        <p>
                            {{ \Illuminate\Support\Str::limit($service->short_description, 80) }}
                        </p>

                        <div class="btn-and-price-area">
                            <a href="{{ route('service.detail', $service->slug) }}"
                               class="primary-btn1">
                                <span>View Details</span>
                                <span>View Details</span>
                            </a>
                        </div>

                    </div>

                </div>
            </div>
            @endforeach

        </div> 
    </div>
</div>
<!-- home1 offer package Section End-->


    <!-- home1 testimonial Section Start-->
<div class="home1-testimonial-section mb-100">
    <div class="container">
        <div class="row justify-content-center mb-50">
            <div class="col-xl-6 col-lg-8">
                <div class="section-title text-center">
                    <h2>Hear It from Travelers</h2>
                    <p>We go beyond just booking trips—we create unforgettable travel experiences that match your dreams!</p>
                </div>
            </div>
        </div>  

        <div class="row mb-40">
            <div class="col-lg-12">
                <div class="swiper home1-testimonial-slider">
                    <div class="swiper-wrapper">

                        @forelse($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="testimonial-card">
                                    
                                    <!-- Author Area -->
                                    <div class="author-area">
                                        <div class="author-img">
                                            <img 
                                                src="{{ $testimonial->getFirstMediaUrl('testimonial') ?: asset('assets/img/default-user.png') }}" 
                                                alt="{{ $testimonial->name }}"
                                            >
                                        </div>
                                        <div class="author-info">
                                            <h5>{{ $testimonial->name }}</h5>
                                            <span>{{ $testimonial->designation }}</span>
                                        </div>
                                    </div>

                                    <!-- Rating -->
                                    <ul class="rating-area">
                                        @php
                                            $fullStars = floor($testimonial->rating);
                                            $halfStar = ($testimonial->rating - $fullStars) >= 0.5 ? 1 : 0;
                                            $emptyStars = 5 - ($fullStars + $halfStar);
                                        @endphp

                                        @for($i = 0; $i < $fullStars; $i++)
                                            <li><i class="bi bi-circle-fill"></i></li>
                                        @endfor

                                        @if($halfStar)
                                            <li><i class="bi bi-circle-half"></i></li>
                                        @endif

                                        @for($i = 0; $i < $emptyStars; $i++)
                                            <li><i class="bi bi-circle"></i></li>
                                        @endfor
                                    </ul>

                                    <!-- Review -->
                                    <div class="content">
                                        <p>{{ $testimonial->review }}</p>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <div class="testimonial-card text-center">
                                    <p>No testimonials available.</p>
                                </div>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>

        <!-- Static Review Section (Optional) -->
        <div class="review-wrap text-center">
            <p>Rated 4.5 out of 5 based on 2K reviews</p>
        </div>

    </div>
</div>
<!-- home1 testimonial Section End-->

     <!-- home1 partner area Section Start-->
   <div class="partner-section mb-100">
    <div class="container">

        <div class="partner-title">
            <h5>Those Company You Can Easily Trust!</h5>
        </div>

        <div class="partner-wrap">
            <div class="marquee">

                {{-- First Group --}}
                <div class="marquee__group">

                    @foreach($brands as $brand)
                        <a href="{{ $brand->website_url ?? '#' }}" target="_blank">
                            <img src="{{ $brand->getFirstMediaUrl('brand_logo') ?: asset('assets/img/default.jpg') }}"
                                 alt="{{ $brand->name }}">
                        </a>
                    @endforeach

                </div>

                {{-- Duplicate for Infinite Scroll --}}
                <div class="marquee__group" aria-hidden="true">

                    @foreach($brands as $brand)
                        <a href="{{ $brand->website_url ?? '#' }}" target="_blank">
                            <img src="{{ $brand->getFirstMediaUrl('brand_logo') ?: asset('assets/img/default.jpg') }}"
                                 alt="{{ $brand->name }}">
                        </a>
                    @endforeach

                </div>

            </div>
        </div>

    </div>
</div>
    <!-- home1 partner area Section End-->

    @endsection