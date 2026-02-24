@extends('custom.master')
@section('content')

<!-- Start Breadcrumb section -->
    <div class="breadcrumb-section" style="background-image:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url({{ asset('assets/img/innerpages/breadcrumb-bg2.jpg') }});">  
        <div class="container">
            <div class="banner-content">
                <h1>{{ $category->name }}</h1>

<ul class="breadcrumb-list">
    <li>
        <a href="{{ route('home') }}">Home</a>
    </li>

    <li>
        <a href="{{ route('category.page', $category->slug) }}">
            {{ $category->name }}
        </a>
    </li>

    <li>Enquiry</li>
</ul>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb section -->

     <!-- Contact Page Start-->
    <div class="contact-page pt-100 mb-100">
        <div class="container">
            <div class="row g-xl-4 g-lg-3 g-4 mb-100">
                
              
    <!--Contact Map Section End-->
            <div class="contact-form">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10">
                        <div class="contact-form-wrap">
                            <div class="section-title text-center mb-60">
                                <h2>Get in Touch!</h2>
                                <p>We’re excited to hear from you! Whether you have a question about our services, want to discuss a new project.</p>
                            </div>
                    <form action="{{ route('frontend.enquiry.store') }}" method="POST">
    @csrf

    <input type="hidden" name="category_id" value="{{ $category->id }}">

    <div class="row g-4">

        {{-- Select Listing --}}
        <div class="col-md-12">
            <div class="form-inner">
                <label>
                    @if($category->slug == 'room-booking')
                        Select Room *
                    @elseif($category->slug == 'travel-booking')
                        Select Travel Plan *
                    @else
                        Select Tour Package *
                    @endif
                </label>

                <select name="listing_id" required>
                    <option value="">-- Select --</option>
                    @foreach($listings as $listing)
                        <option value="{{ $listing->id }}">
                            {{ $listing->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Common Fields --}}
        <div class="col-md-6">
            <div class="form-inner">
                <label>Full Name *</label>
                <input type="text" name="name" required>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-inner">
                <label>Email</label>
                <input type="email" name="email">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-inner">
                <label>Phone *</label>
                <input type="text" name="phone" required>
            </div>
        </div>

        {{-- Travel Booking --}}
        @if($category->slug == 'travel-booking')
            <div class="col-md-6">
                <div class="form-inner">
                    <label>Travel Date</label>
                    <input type="date" name="travel_date">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-inner">
                    <label>No. of Persons</label>
                    <input type="number" name="persons">
                </div>
            </div>
        @endif

        {{-- Room Booking --}}
        @if($category->slug == 'room-booking')
            <div class="col-md-6">
                <div class="form-inner">
                    <label>Check-in</label>
                    <input type="date" name="checkin_date">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-inner">
                    <label>Check-out</label>
                    <input type="date" name="checkout_date">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-inner">
                    <label>Rooms</label>
                    <input type="number" name="rooms">
                </div>
            </div>
        @endif

        {{-- Tour Package --}}
        @if($category->slug == 'tour-package')
            <div class="col-md-12">
                <div class="form-inner">
                    <label>Package Requirements</label>
                    <textarea name="package_requirements"></textarea>
                </div>
            </div>
        @endif

        {{-- Message --}}
        <div class="col-md-12">
            <div class="form-inner">
                <label>Message</label>
                <textarea name="message" rows="4"></textarea>
            </div>
        </div>

    </div>

    <button type="submit" class="primary-btn1 mt-4">
        <span>Submit Enquiry</span>
        <span>Submit Enquiry</span>
    </button>
</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset('assets/img/innerpages/vector/contact-page-vector1.svg') }}" alt="" class="vector1">
        <img src="{{ asset('assets/img/innerpages/vector/contact-page-vector2.svg') }}" alt="" class="vector2">
        <img src="{{ asset('assets/img/innerpages/vector/contact-page-vector3.svg') }}" alt="" class="vector3">
    </div>
    <!--Contact Page End-->

    


@endsection