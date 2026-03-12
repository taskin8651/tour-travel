@extends('custom.master')
@section('content')


    <!-- Destination Details Gallery Section Start-->
    <div class="destination-details-gallery-section mb-50">
        <div class="swiper destination-details-gallery-slider">
            <div class="swiper-wrapper">
                 @foreach($listing->getMedia('gallery') as $media)
        <div class="swiper-slide">
            <img src="{{ $media->getUrl() }}" alt="{{ $listing->title }}">
        </div>
    @endforeach
                
            </div>
        </div>
        <div class="slider-btn-grp two">
            <div class="slider-btn destination-dt-gallery-slider-prev">
                <svg width="22" height="22" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 10.0571H22V11.9428H0V10.0571Z"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M0.942857 11.9429C5.3768 11.9429 9.00115 8.0432 9.00115 3.88457V2.94171H7.11543V3.88457C7.11543 7.04251 4.29566 10.0571 0.942857 10.0571H0V11.9429H0.942857Z"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M0.942857 10.0571C5.3768 10.0571 9.00115 13.9568 9.00115 18.1154V19.0583H7.11543V18.1154C7.11543 14.9587 4.29566 11.9428 0.942857 11.9428H0V10.0571H0.942857Z"/>
                    </g>
                </svg>
            </div>
            <div class="slider-btn destination-dt-gallery-slider-next">
                <svg width="22" height="22" viewBox="0 0 22 22" xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M22 10.0571H-5.72205e-06V11.9428H22V10.0571Z"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M21.0571 11.9429C16.6232 11.9429 12.9989 8.0432 12.9989 3.88457V2.94171H14.8846V3.88457C14.8846 7.04251 17.7043 10.0571 21.0571 10.0571H22V11.9429H21.0571Z"/>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M21.0571 10.0571C16.6232 10.0571 12.9989 13.9568 12.9989 18.1154V19.0583H14.8846V18.1154C14.8846 14.9587 17.7043 11.9428 21.0571 11.9428H22V10.0571H21.0571Z"/>
                    </g>
                </svg>
            </div>
        </div>
    </div>
    <!-- Destination Details Gallery Section End-->


     <!-- Package Details Page Start-->
    <div class="package-details-page pt-100 mb-100">
        <div class="container">
            <div class="row g-lg-4 gy-5 justify-content-between">
                <div class="col-xl-7 col-lg-8">
                    <div class="package-details-warpper">
                       
                       
                       
                        
                        
                       <div class="package-info-wrap mb-60">
    <h2>Experience Overview</h2>

<p>{!! nl2br(e($listing->description)) !!}</p>
    <ul class="package-info-list">

        {{-- Location --}}
        @if($listing->location)
        <li>
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" stroke="currentColor" stroke-width="2"/>
            </svg>
            <div class="content">
                <span>Location</span>
                <strong>{{ $listing->location }}</strong>
            </div>
        </li>
        @endif


        {{-- Sub Category --}}
        @if($listing->subCategory)
        <li>
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                <path d="M4 4h16v16H4z" stroke="currentColor" stroke-width="2"/>
            </svg>
            <div class="content">
                <span>Type</span>
                <strong>{{ $listing->subCategory->name }}</strong>
            </div>
        </li>
        @endif


        {{-- Rooms (Room Booking) --}}
        @if($listing->rooms)
        <li>
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                <path d="M3 10h18v7H3z" stroke="currentColor" stroke-width="2"/>
            </svg>
            <div class="content">
                <span>Rooms</span>
                <strong>{{ $listing->rooms }} Rooms</strong>
            </div>
        </li>
        @endif


        {{-- Guests --}}
        @if($listing->seats)
        <li>
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2"/>
                <path d="M5 21c0-4 3-6 7-6s7 2 7 6" stroke="currentColor" stroke-width="2"/>
            </svg>
            <div class="content">
                <span>Guests</span>
                <strong>{{ $listing->seats }} Guests</strong>
            </div>
        </li>
        @endif


        {{-- Duration (Tour Package) --}}
@if($listing->days || $listing->rooms)

<li>
    <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
        <rect x="3" y="4" width="18" height="18" stroke="currentColor" stroke-width="2"/>
    </svg>

    <div class="content">
        <span>Duration</span>

        <strong>
            {{ $listing->days }} Days 
            @if($listing->rooms)
                / {{ $listing->rooms }} Nights
            @endif
        </strong>

    </div>
</li>

@endif


        {{-- Price --}}
        <li>
            <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                <path d="M12 1v22M17 5H9a4 4 0 000 8h6a4 4 0 010 8H7" stroke="currentColor" stroke-width="2"/>
            </svg>
            <div class="content">
                <span>Starting Price</span>
                <strong>₹{{ number_format($listing->price) }}</strong>
            </div>
        </li>

    </ul>
</div>
                      
</div>    
                </div>
                <div class="col-lg-4">
                    <div class="package-details-sidebar">
                       <div class="pricing-and-booking-area">
                            
                            <div class="price-area">
    <h6>Starting From</h6>
    <span>
        ₹{{ number_format($listing->price) }}
        <sub>
            @if($listing->category->slug == 'room-booking')
                /per night
            @else
                /per person
            @endif
        </sub>
    </span>
</div>
                            <ul>
                                <li>
                                    <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="0.5" y="0.5" width="13" height="13" rx="6.5"/>
                                        <path
                                            d="M11.0419 5.31317L6.17665 10.1811C6.09912 10.256 6.00086 10.2948 5.90268 10.2948C5.85176 10.2949 5.80132 10.2849 5.75428 10.2654C5.70724 10.2458 5.66454 10.2172 5.62863 10.1811L2.95813 7.51056C2.80562 7.36059 2.80562 7.11506 2.95813 6.96255L3.90173 6.01632C4.04655 5.8716 4.30502 5.8716 4.44983 6.01632L5.90268 7.46917L9.5503 3.81894C9.58623 3.78292 9.6289 3.75434 9.67587 3.73483C9.72285 3.71531 9.77321 3.70524 9.82408 3.70519C9.92742 3.70519 10.0257 3.74657 10.098 3.81894L11.0416 4.76525C11.1944 4.91776 11.1944 5.16329 11.0419 5.31317Z"/>
                                    </svg>
                                    Mony Back Guarentee.
                                </li>
                                <li>
                                    <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="0.5" y="0.5" width="13" height="13" rx="6.5"/>
                                        <path
                                            d="M11.0419 5.31317L6.17665 10.1811C6.09912 10.256 6.00086 10.2948 5.90268 10.2948C5.85176 10.2949 5.80132 10.2849 5.75428 10.2654C5.70724 10.2458 5.66454 10.2172 5.62863 10.1811L2.95813 7.51056C2.80562 7.36059 2.80562 7.11506 2.95813 6.96255L3.90173 6.01632C4.04655 5.8716 4.30502 5.8716 4.44983 6.01632L5.90268 7.46917L9.5503 3.81894C9.58623 3.78292 9.6289 3.75434 9.67587 3.73483C9.72285 3.71531 9.77321 3.70524 9.82408 3.70519C9.92742 3.70519 10.0257 3.74657 10.098 3.81894L11.0416 4.76525C11.1944 4.91776 11.1944 5.16329 11.0419 5.31317Z"/>
                                    </svg>
                                    Your Safety is Our Top Priority.
                                </li>
                            </ul>
                           
                           <a href="{{ route('enquiry.create', $listing->category->slug) }}"
   class="primary-btn1 transparent">

    <span>
        Submit an Enquiry
        <svg width="10" height="10" viewBox="0 0 10 10">
            <path d="M9.73535 1.14746L1.53027 9.53027"
                  stroke="currentColor"
                  stroke-width="1.5"/>
        </svg>
    </span>

    <span>
        Submit an Enquiry
        <svg width="10" height="10" viewBox="0 0 10 10">
            <path d="M9.73535 1.14746L1.53027 9.53027"
                  stroke="currentColor"
                  stroke-width="1.5"/>
        </svg>
    </span>

</a>
                            <span>
                                <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 0C3.13423 0 0 3.13423 0 7C0 10.8662 3.13423 14 7 14C10.8662 14 14 10.8666 14 7C14 3.13423 10.8662 0 7 0ZM7 12.6875C3.85877 12.6875 1.31252 10.1412 1.31252 7C1.31252 3.85877 3.85877 1.31252 7 1.31252C10.1412 1.31252 12.6875 3.85877 12.6875 7C12.6875 10.1412 10.1412 12.6875 7 12.6875ZM7.00044 3.06992C6.49908 3.06992 6.11973 3.33157 6.11973 3.75418V7.63042C6.11973 8.05347 6.49903 8.31423 7.00044 8.31423C7.48956 8.31423 7.88115 8.04256 7.88115 7.63042V3.75418C7.8811 3.3416 7.48956 3.06992 7.00044 3.06992ZM7.00044 9.1875C6.51875 9.1875 6.12673 9.57952 6.12673 10.0616C6.12673 10.5428 6.51875 10.9349 7.00044 10.9349C7.48212 10.9349 7.87371 10.5428 7.87371 10.0616C7.87366 9.57948 7.48212 9.1875 7.00044 9.1875Z"/>
                                </svg>
                                Bonus Activity Included – Limited Time!
                            </span>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Package Details Page End-->

   

            @endsection