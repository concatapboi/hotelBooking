@extends('Frontend::layouts.master')
@section('content')
	<!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(/blog/img/bg-img/17.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">Hotels || Motels || Homestay</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{action('PageController@index')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">All Hotels</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

    <!-- Items Area Start -->
    <div class="roberto-news-area section-padding-100-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-7">

                    <!-- Single Blog Post Area -->
                    <div class="single-blog-post d-flex align-items-center mb-50 wow fadeInUp" data-wow-delay="100ms">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                            <a href="#"><img src="/blog/img/bg-img/24.jpg" alt=""></a>
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <!-- Post Meta -->
                            <div class="post-meta">
                                <a href="#" class="post-author">Jan 02, 2019</a>
                                <a href="#" class="post-tutorial">Event</a>
                            </div>
                            <!-- Post Title -->
                            <a href="#" class="post-title">Cdc Issues Health Alert Notice For Travelers To Usa From Hon</a>
                            <p>A round-the-world trip remains the world’s greatest journey. For two out of every three people, this is the ultimate travel experience, according to recent research...</p>
                            <a href="{{action('PageController@hotelInfo')}}" class="btn continue-btn">Read More</a>
                        </div>
                    </div>
                    <!-- Pagination -->
                    <nav class="roberto-pagination wow fadeInUp mb-100" data-wow-delay="600ms">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i> Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next <i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </nav>
                </div>

                <div class="col-12 col-lg-5">
                    <!-- Hotel Reservation Area -->
                    <div class="hotel-reservation--area mb-100">
                        <form action="#" method="post">
                            <div class="form-group mb-30">
                                <label for="checkInDate">Date</label>
                                <div >
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="date" class="form-control" name="checkin-date">
                                        </div>
                                        <div class="col-6">
                                            <input type="date" class="form-control"  name="checkout-date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-30">
                                <label for="guests">Guests</label>
                                <div class="row">
                                    <div class="col-6">
                                    	<span>Adult: </span><input type="number" name="adults" id="guests" class="form-control" min="1" value="1">
                                    </div>
                                    <div class="col-6">
                                    	<span>Children: </span><input type="number" name="children" id="children" class="form-control" min="0" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-30">
                                <label for="guests">Price</label>
                                <div class="row">
                                    <div class="col-6">
                                    	<span>Min: </span><input type="number" name="min_price" id="min_price" class="form-control" min="1" value="1">
                                    </div>
                                    <div class="col-6">
                                    	<span>Max: </span><input type="number" name="max_price" id="max_price" class="form-control" min="2" value="10000" max="10000">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn roberto-btn w-100">Check Available</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Items Area End -->
@stop
