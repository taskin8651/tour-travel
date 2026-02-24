@extends('custom.master')
@section('content')

<!-- Start Breadcrumb section -->
    <div class="breadcrumb-section" style="background-image:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(assets/img/innerpages/breadcrumb-bg2.jpg);">  
        <div class="container">
            <div class="banner-content">
                <h1>Contact Us</h1>
                <ul class="breadcrumb-list">
                    <li><a href="index.html">Home</a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb section -->

     <!-- Contact Page Start-->
    <div class="contact-page pt-100 mb-100">
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
    <!--Contact Page End-->

    


@endsection