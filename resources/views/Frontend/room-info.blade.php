@extends('Frontend::layouts.master')
@section('content')
	<!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(/blog/img/bg-img/16.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-end">
                <div class="col-12">
                    <div class="breadcrumb-content d-flex align-items-center justify-content-between pb-5">
                        <h2 class="room-title">Room View Sea</h2>
                        <h2 class="room-price">$180 <span>/ Per Night</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

    <!-- Rooms Area Start -->
    <div class="roberto-rooms-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <!-- Single Room Details Area -->
                    <div class="single-room-details-area mb-50">
                        <!-- Room Thumbnail Slides -->
                        <div class="room-thumbnail-slides mb-50">
                            <div id="room-thumbnail--slide" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="/blog/img/bg-img/48.jpg" class="d-block w-100" alt="">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="/blog/img/bg-img/49.jpg" class="d-block w-100" alt="">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="/blog/img/bg-img/50.jpg" class="d-block w-100" alt="">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="/blog/img/bg-img/51.jpg" class="d-block w-100" alt="">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="/blog/img/bg-img/52.jpg" class="d-block w-100" alt="">
                                    </div>
                                </div>

                                <ol class="carousel-indicators">
                                    <li data-target="#room-thumbnail--slide" data-slide-to="0" class="active">
                                        <img src="/blog/img/bg-img/48.jpg" class="d-block w-100" alt="">
                                    </li>
                                    <li data-target="#room-thumbnail--slide" data-slide-to="1">
                                        <img src="/blog/img/bg-img/49.jpg" class="d-block w-100" alt="">
                                    </li>
                                    <li data-target="#room-thumbnail--slide" data-slide-to="2">
                                        <img src="/blog/img/bg-img/50.jpg" class="d-block w-100" alt="">
                                    </li>
                                    <li data-target="#room-thumbnail--slide" data-slide-to="3">
                                        <img src="/blog/img/bg-img/51.jpg" class="d-block w-100" alt="">
                                    </li>
                                    <li data-target="#room-thumbnail--slide" data-slide-to="4">
                                        <img src="/blog/img/bg-img/52.jpg" class="d-block w-100" alt="">
                                    </li>
                                </ol>
                            </div>
                        </div>

                        <!-- Room Features -->
                        <div class="room-features-area d-flex flex-wrap mb-50">
                            <h6>Size: <span>350-425sqf</span></h6>
                            <h6>Capacity: <span>Max persion 5</span></h6>
                            <h6>Bed: <span>King beds</span></h6>
                            <h6>Services: <span>Wifi, television ...</span></h6>
                        </div>

                        <p>If you live in New York City or travel to and from New York City a lot, you know all about the traffic there. Getting places is often next to impossible, even with the gazillion yellow cabs. If you’re like me you often look with envy at those shiny limousines with their unformed drivers and wish you could sit in one. Well, you can. New York limo service is more affordable than you think, whether it’s for Newark airport transportation, LaGuardia airport transportation, or to drive wherever you wish to go.</p>

                        <ul>
                            <li><i class="fa fa-check"></i> Mauris molestie lectus in irdiet auctor.</li>
                            <li><i class="fa fa-check"></i> Dictum purus at blandit molestie.</li>
                            <li><i class="fa fa-check"></i> Neque non fermentum suscipit.</li>
                            <li><i class="fa fa-check"></i> Donec id dui ac massa malesuada.</li>
                            <li><i class="fa fa-check"></i> In sit amet sapien quis orci maximus.</li>
                            <li><i class="fa fa-check"></i> Vestibulum rutrum diam vel eros tristique.</li>
                        </ul>

                        <p>Every time I hail a cab in New York City or wait for one at the airports, I hope I’ll be lucky enough to get one that’s halfway decent and that the driver actually speaks English. I have spent many anxious moments wondering if I ever get to my destination. Or whether I’d get ripped off. Even if all goes well, I can’t say I can remember many rides in New York cabs that were very pleasant. And given how much they cost by now, going with a limo makes ever more sense.</p>
                    </div>
                    <!-- Room Service -->
                    <div class="room-service mb-50">
                        <h4>Room Services</h4>

                        <ul>
                            <li><img src="/blog/img/core-img/icon1.png" alt=""> Air Conditioning</li>
                            <li><img src="/blog/img/core-img/icon2.png" alt=""> Free drinks</li>
                            <li><img src="/blog/img/core-img/icon3.png" alt=""> Restaurant quality</li>
                            <li><img src="/blog/img/core-img/icon4.png" alt=""> Cable TV</li>
                            <li><img src="/blog/img/core-img/icon5.png" alt=""> Unlimited Wifi</li>
                            <li><img src="/blog/img/core-img/icon6.png" alt=""> Service 24/24</li>
                        </ul>
                    </div>
                    <!-- Room Review -->
                    <div class="room-review-area mb-100">
                        <h4>Room Review</h4>

                        <!-- Single Review Area -->
                        <div class="single-room-review-area d-flex align-items-center">
                            <div class="reviwer-thumbnail">
                                <img src="/blog/img/bg-img/53.jpg" alt="">
                            </div>
                            <div class="reviwer-content">
                                <div class="reviwer-title-rating d-flex align-items-center justify-content-between">
                                    <div class="reviwer-title">
                                        <span>27 Aug 2019</span>
                                        <h6>Brandon Kelley</h6>
                                    </div>
                                    <div class="reviwer-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <p>Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <!-- Hotel Reservation Area -->
                    <div class="hotel-reservation--area mb-100">
                        <form action="#" method="post">
                            <div class="form-group mb-30">
                                <label for="checkInDate">Date</label>
                                <div class="input-daterange" id="datepicker">
                                    <div class="row no-gutters">
                                        <div class="col-6">
                                            <input type="text" class="input-small form-control" name="checkInDate" id="checkInDate" placeholder="Check In">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="input-small form-control" name="checkOutDate" placeholder="Check Out">
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
    <!-- Rooms Area End -->
@stop