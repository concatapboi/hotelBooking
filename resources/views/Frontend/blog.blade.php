@extends('Frontend::layouts.master')
@section('content')
	<!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url(/blog/img/bg-img/17.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">Blog</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="{{action('PageController@index')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Blog</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->

    <!-- Blog Area Start -->
    <div class="roberto-news-area section-padding-100-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">

                    <!-- Single Blog Post Area -->
                    <div class="single-blog-post d-flex align-items-center mb-50 wow fadeInUp" data-wow-delay="100ms">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                            <a href="{{action('PageController@singleBlog')}}"><img src="/blog/img/bg-img/24.jpg" alt=""></a>
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
                            <a href="{{action('PageController@singleBlog')}}" class="btn continue-btn">Read More</a>
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

                <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                    <div class="roberto-sidebar-area pl-md-4">
                        <!-- Recent Post -->
                        <div class="single-widget-area mb-100">
                            <h4 class="widget-title mb-30">Recent News</h4>

                            <!-- Single Recent Post -->
                            <div class="single-recent-post d-flex">
                                <!-- Thumb -->
                                <div class="post-thumb">
                                    <a href="{{action('PageController@singleBlog')}}"><img src="/blog/img/bg-img/29.jpg" alt=""></a>
                                </div>
                                <!-- Content -->
                                <div class="post-content">
                                    <!-- Post Meta -->
                                    <div class="post-meta">
                                        <a href="#" class="post-author">Jan 29, 2019</a>
                                        <a href="#" class="post-tutorial">Event</a>
                                    </div>
                                    <a href="{{action('PageController@singleBlog')}}" class="post-title">Proven Techniques Help You Herbal Breast</a>
                                </div>
                            </div>
                        </div>

                        <!-- Popular Tags -->
                        <div class="single-widget-area mb-100 clearfix">
                            <h4 class="widget-title mb-30">Tags</h4>
                            <!-- Popular Tags -->
                            <ul class="popular-tags">
                                <li><a href="#">Bed</a></li>
                            </ul>
                        </div>

                        <!-- Instagram -->
                        <div class="single-widget-area mb-100 clearfix">
                            <h4 class="widget-title mb-30">Instagram</h4>
                            <!-- Instagram Feeds -->
                            <ul class="instagram-feeds">
                                <li><a href="#"><img src="/blog/img/bg-img/33.jpg" alt=""></a></li>
                                <li><a href="#"><img src="/blog/img/bg-img/34.jpg" alt=""></a></li>
                                <li><a href="#"><img src="/blog/img/bg-img/35.jpg" alt=""></a></li>
                                <li><a href="#"><img src="/blog/img/bg-img/36.jpg" alt=""></a></li>
                                <li><a href="#"><img src="/blog/img/bg-img/37.jpg" alt=""></a></li>
                                <li><a href="#"><img src="/blog/img/bg-img/38.jpg" alt=""></a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Area End -->
@stop