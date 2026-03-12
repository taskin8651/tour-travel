@extends('custom.master')

@section('content')
<div class="home2-banner-section">
    <div class="swiper home2-banner-slider">
        <div class="swiper-wrapper">

           


 @foreach($heroes as $hero)

                @php
                    $mediaUrl = $hero->getFirstMediaUrl('hero_media');
                @endphp
             <div class="swiper-slide">
                    <div class="banner-wrapper">
                        <div class="banner-img-area">
                            
                                <img src="{{ $mediaUrl }}" alt="Hero Banner">
                        </div>
                        <div class="banner-content-wrap">
                            <div class="container">
                                <div class="banner-content">
                                    <h2>{{ $hero->title }}</h2>
                                    <p>{{ $hero->subtitle }}</p>
                                </div>
                            </div>
                        </div>      
                    </div>
                </div>
                            @endforeach


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



    <section class="about-section py-100">
    <div class="container">
        <div class="row">

            <!-- Left Content -->
            <div class="col-lg-6">
                <div class="about-content">
                    <h1>About Us</h1>
                    <h2>Who We Are, What We Do</h2>

                    <p>
                        Located in Gangtok, Sikkim, Immanuel Tours & Travels specializes in crafting unforgettable travel experiences across the stunning landscapes of Sikkim and Northeast India. Our personalized tour packages cater to adventurers, culture enthusiasts, and nature lovers alike, ensuring each trip is unique and tailored to you.
                    </p>

                    <p>
                    

                    <ul class="about-list">
                        <li>✔ Best Price Guarantee</li>
                        <li>✔ Handpicked Destinations</li>
                        <li>✔ 24/7 Customer Support</li>
                        <li>✔ Trusted Travel Experts</li>
                    </ul>

                  
                </div>
            </div>

            <!-- Right Images -->
            <div class="col-lg-6">
                <div class="about-images position-relative">

                    <img src="assets/img/about/img5.jpeg"
                         class="img-fluid rounded shadow about-img1"
                         alt="About Travel">

                    <img src="assets/img/about/img7.jpeg"
                         class="img-fluid rounded shadow about-img2"
                         alt="Travel Adventure">

                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .about-section{
padding-bottom:100px;
}

.about-images{
position:relative;
}

.about-img1{
width:75%;
}

.about-img2{
width:55%;
position:absolute;
bottom:-40px;
right:0;
border:5px solid #fff;
}

.about-list{
padding-left:0;
list-style:none;
}

.about-list li{
margin-bottom:8px;
font-size:16px;
}
</style>


    <!-- home1 destination Section Start-->
 <div class="home1-destination-section mb-100">
<div class="container">

<div class="row justify-content-center mb-60">
<div class="col-lg-10">
<div class="section-title text-center">
<h2>Popular Sikkim Tour Packages</h2>
<p>Discover the best Sikkim packages with amazing prices and special offers</p>
</div>
</div>
</div>

<div class="swiper package-slider">

<div class="swiper-wrapper">

@foreach($packageCategory->subCategories as $sub)
@foreach($sub->listings as $listing)

<div class="swiper-slide">

<div class="hotel-card">

<div class="hotel-img-wrap">
<a href="{{ route('listing.detail',$listing->id) }}">
<img src="{{ $listing->getFirstMediaUrl('main') ?: asset('assets/img/default.jpg') }}">
</a>
</div>

<div class="hotel-content">

<h5>{{ $listing->title }}</h5>

<div class="location-area">
<span>{{ $listing->location }}</span>
</div>

<ul class="hotel-feature-list">

@if($listing->days)
<li>{{ $listing->days }} Days</li>
@endif

@if($listing->rooms)
<li>{{ $listing->rooms }} Nights</li>
@endif

@if($listing->seats)
<li>{{ $listing->seats }} Guests</li>
@endif

</ul>

<div class="btn-and-price-area">

<a href="{{ route('enquiry.create',$listing->category->slug) }}" class="primary-btn1">
<span>Book Now</span>
<span>Book Now</span>
</a>

<div class="price-area">
    @if($listing->price)
<h6>Per Person</h6>
<span>₹{{ number_format($listing->price) }}</span>
@endif
</div>

</div>

</div>
</div>

</div>

@endforeach
@endforeach

</div>

</div>

</div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

new Swiper(".package-slider", {

slidesPerView: 3,
spaceBetween: 30,
loop: true,

autoplay:{
delay:3000,
disableOnInteraction:false,
},

breakpoints:{

0:{
slidesPerView:1
},

768:{
slidesPerView:2
},

992:{
slidesPerView:3
}

}

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
                    <h2>Our Services</h2>
                    <p>Services we provide to you.</p>
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

 <div class="contact-page pt-10 mb-100">
        <div class="container">
            <div class="row g-xl-4 g-lg-3 g-4 mb-100">
                
                <div class="col-lg-4 col-md-6">
                    <div class="single-contact three">
                        <div class="icon">
                            <svg width="36" height="36" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                                <path
                                d="M17.9981 1.125C15.0037 1.12887 12.133 2.32012 10.0156 4.4375C7.89824 6.55489 6.70699 9.42557 6.70313 12.42C6.70312 16.2056 10.7587 22.2638 13.92 26.4037C9.99937 27.0562 7.51875 28.6087 7.51875 30.4706C7.51875 32.9794 12.0244 34.875 17.9981 34.875C23.9719 34.875 28.4831 32.9794 28.4831 30.4706C28.4831 28.6087 26.0025 27.0562 22.0762 26.4037C25.2375 22.2581 29.2931 16.2056 29.2931 12.42C29.2893 9.42557 28.098 6.55489 25.9806 4.4375C23.8632 2.32012 20.9926 1.12887 17.9981 1.125ZM17.9981 29.6663C16.0237 27.3488 7.82812 17.415 7.82812 12.42C7.82812 9.72275 8.8996 7.13597 10.8068 5.22872C12.7141 3.32148 15.3009 2.25 17.9981 2.25C20.6954 2.25 23.2822 3.32148 25.1894 5.22872C27.0966 7.13597 28.1681 9.72275 28.1681 12.42C28.1681 17.415 19.9725 27.3488 17.9981 29.6663Z"/>
                                <path
                                d="M17.9966 18.1294C21.4853 18.1294 24.3134 15.3012 24.3134 11.8125C24.3134 8.3238 21.4853 5.49564 17.9966 5.49564C14.5078 5.49564 11.6797 8.3238 11.6797 11.8125C11.6797 15.3012 14.5078 18.1294 17.9966 18.1294Z"/>
                            </svg>
                        </div>
                        <h4>{{ $setting->site_name }}</h4>
                        
                        <h6>
                            <span>Contact :</span>
                            <a href="tel:{{ $setting->phone }}">{{ $setting->phone }}</a>
                        </h6>
                        
                        <p>{{ $setting->address }}</p>
                    </div>
                </div>
                
                <div class="col-lg-8 col-md-6">
                    <!--Contact Map Section Start-->
                    <div class="contact-map-section" >
                        

                        <iframe src="https://www.google.com/maps/embed?pb={!! $setting->google_map !!}" width="600"  height="200" style="border:0; min-height:200px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
</div>
</div>
    <!--Contact Map Section End-->
            <div class="contact-form">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10">
                        <div class="contact-form-wrap">
                            <div class="section-title text-center mb-60">
                                <h2>Get in Touch!</h2>
                                <p>We’re excited to hear from you! Whether you have a question about our services, want to discuss a new project.</p>
                            </div>
                           <form action="{{ route('contact.store') }}" method="POST">
    @csrf

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4 mb-60">

        {{-- Full Name --}}
        <div class="col-md-6">
            <div class="form-inner">
                <label>Full Name *</label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Enter your full name"
                       required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- Email --}}
        <div class="col-md-6">
            <div class="form-inner">
                <label>Email Address *</label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="info@example.com"
                       required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- Phone --}}
        <div class="col-md-6">
            <div class="form-inner">
                <label>Phone Number</label>
                <input type="text"
                       name="phone"
                       value="{{ old('phone') }}"
                       placeholder="+91 98765 43210">
                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- Subject --}}
        <div class="col-md-6">
            <div class="form-inner">
                <label>Subject</label>
                <input type="text"
                       name="subject"
                       value="{{ old('subject') }}"
                       placeholder="Subject of inquiry">
            </div>
        </div>

        {{-- Message --}}
        <div class="col-md-12">
            <div class="form-inner">
                <label>Message *</label>
                <textarea name="message"
                          placeholder="Write your message here..."
                          rows="5"
                          required>{{ old('message') }}</textarea>
                @error('message')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- Privacy Policy --}}
        <div class="col-md-12">
            <div class="form-inner2">
                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="agree"
                           value="1"
                           required>
                    <label class="form-check-label">
                        I agree to the privacy policy & terms & conditions.
                    </label>
                </div>
            </div>
        </div>

    </div>

    {{-- Submit Button --}}
    <button type="submit" class="primary-btn1">
        <span>
            Submit Now
            <svg width="10" height="10" viewBox="0 0 10 10">
                <path d="M9.73535 1.14746L1.53027 9.53027" stroke="currentColor" stroke-width="1.5"/>
            </svg>
        </span>
        <span>
            Submit Now
            <svg width="10" height="10" viewBox="0 0 10 10">
                <path d="M9.73535 1.14746L1.53027 9.53027" stroke="currentColor" stroke-width="1.5"/>
            </svg>
        </span>
    </button>

</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="assets/img/innerpages/vector/contact-page-vector1.svg" alt="" class="vector1">
        <img src="assets/img/innerpages/vector/contact-page-vector2.svg" alt="" class="vector2">
        <img src="assets/img/innerpages/vector/contact-page-vector3.svg" alt="" class="vector3">
    </div>

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