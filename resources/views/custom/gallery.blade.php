@extends('custom.master')
@section('content')



<!-- Start Breadcrumb section -->
    <div class="breadcrumb-section" style="background-image:linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(assets/img/innerpages/breadcrumb-bg1.jpg);">  
        <div class="container">
            <div class="banner-content">
                <h1>Gallery</h1>
                <ul class="breadcrumb-list">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li>Gallery</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb section -->

  <!-- destination Page Start-->
    <div class="destination-page pt-100 mb-100">
    <div class="container">
        <div class="row gy-md-5 gy-4">

            @foreach($galleries as $gallery)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="destination-card2 two">

                    <div class="destination-img">
                        <img src="{{ $gallery->getFirstMediaUrl('gallery') ?: asset('assets/img/default.jpg') }}" 
                             alt="{{ $gallery->title }}">

                    
                    </div>

                    <div class="destination-content">
                        <h5>
                            <a href="{{ route('gallery.detail', $gallery->id) }}">
                                {{ $gallery->title }}
                            </a>
                        </h5>

                    </div>

                </div>
            </div>
            @endforeach

        </div>

        <div class="mt-5">
            {{ $galleries->links() }}
        </div>

    </div>
</div>
    <!-- detination Page End-->

    @endsection