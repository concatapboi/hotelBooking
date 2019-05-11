<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="UTF-8">
      <meta name="description" content="">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Title -->
      <title>Roberto - Hotel &amp; Resort HTML Template</title>

      <!-- Favicon -->
      <link rel="icon" href="{{asset('blog/img/core-img/favicon.png')}}">

      <!-- Stylesheet -->
      <link rel="stylesheet" href="{{asset('blog/style.css')}}">        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Styles -->
    </head>
    <body>
      
    <div id="preloader">
  		<div class="loader"></div>
      </div>
      @if($err)
      <header class="header-area">
        <!-- Search Form -->
        <div class="search-form d-flex align-items-center">
            <div class="container">
                <form action="index.html" method="get">
                    <input type="search" name="search-form-input" id="searchFormInput" placeholder="Type your keyword.Ex: name of place/hotels/motels/homestay...">
                    <button type="submit"><i class="icon_search"></i></button>
                </form>
            </div>
        </div>

        <!-- Top Header Area Start -->
        <div class="top-header-area">
            <div class="container">
                <div class="row">
                  <div class="col-6">
                        <div class="top-header-content">
                            <a href="#"><i class="icon_phone"></i> <span>+12-34-567-890</span></a>
                            <a href="#"><i class="icon_mail"></i> <span>xxx@gmail.com</span></a>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="top-header-content">
                            <!-- Top Social Area -->
                            <div class="top-social-area ml-auto">
                                <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="https://plus.google.com/" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                <a href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                                <a href="https://www.tumblr.com/" target="_blank"><i class="fa fa-tumblr" aria-hidden="true"></i></a>
                                <a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Top Header Area End -->

        <!-- Main Header Start -->
        <div class="main-header-area">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Classy Menu -->
                    <nav class="classy-navbar justify-content-between" id="robertoNav">

                        <!-- Logo -->
                        <a class="nav-brand" href="#"><img src="{{asset('/blog/./img/core-img/logo.png')}}" alt=""></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                                                <div class="classy-menu">
                            <!-- Menu Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>
                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul id="nav">
                                    <li class="active"><a href="/">Home</a></li>									
                                    <li><a href="/about.html">About</a></li>
                                    <li><a href="/contact/html">Contact</a></li>
                                </ul>

                                <!-- Search -->
                                <div class="search-btn ml-4">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </div>

                                <!-- Book Now -->
                                <div class="book-now-btn ml-3 ml-lg-5">
                                    <a href="#" data-toggle="modal" data-target="#login-modal">Login<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <!-- Nav End -->
                        </div>

                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Breadcrumb Area Start -->
    <div class="breadcrumb-area bg-img bg-overlay jarallax" style="background-image: url('/blog/img/bg-img/16.jpg');">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcrumb-content text-center">
                        <h2 class="page-title">404 PAGE NOT FOUND</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">return HOME</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Area End -->
    <!-- Service Area Start -->
    <section class="roberto-service-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading -->
                    <div class="section-heading text-center wow fadeInUp" data-wow-delay="100ms">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service Area End -->   
      @else
      <div id="app"></div>
      @endif
                            
      <!-- Call To Action Area Start -->
      <section class="roberto-cta-area">
          <div class="container">
              <div class="cta-content bg-img bg-overlay jarallax" style="background-image: url('{{asset('blog/img/bg-img/1.jpg')}}');">
                  <div class="row align-items-center">
                      <div class="col-12 col-md-7">
                          <div class="cta-text mb-50">
                              <h2>Contact us now!</h2>
                              <h6>Contact +12-34-567-890 to book directly or for advice.</h6>
                          </div>
                      </div>
                      <div class="col-12 col-md-5 text-right">
                          <a href="#" class="btn roberto-btn mb-50">Contact Now</a>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- Call To Action Area End -->

      <!-- Partner Area Start -->
      <div class="partner-area">
          <div class="container">
              <div class="row">
                  <div class="col-12">
                      <div class="partner-logo-content d-flex align-items-center justify-content-between wow fadeInUp" data-wow-delay="300ms">
                          <!-- Single Partner Logo -->
                          <a href="#" class="partner-logo"><img src="{{asset('blog/img/core-img/p1.png')}}" alt=""></a>
                          <!-- Single Partner Logo -->
                          <a href="#" class="partner-logo"><img src="{{asset('blog/img/core-img/p2.png')}}" alt=""></a>
                          <!-- Single Partner Logo -->
                          <a href="#" class="partner-logo"><img src="{{asset('blog/img/core-img/p3.png')}}" alt=""></a>
                          <!-- Single Partner Logo -->
                          <a href="#" class="partner-logo"><img src="{{asset('blog/img/core-img/p4.png')}}" alt=""></a>
                          <!-- Single Partner Logo -->
                          <a href="#" class="partner-logo"><img src="{{asset('blog/img/core-img/p5.png')}}" alt=""></a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Partner Area End -->

      <!-- Footer Area Start -->
      <footer class="footer-area section-padding-80-0">
        <!-- Main Footer Area -->
        <div class="main-footer-area">
            <div class="container">
                <div class="row align-items-baseline justify-content-between">
                    <!-- Single Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget mb-80">
                            <!-- Footer Logo -->
                            <a href="#" class="footer-logo"><img src="blog/img/core-img/logo2.png" alt=""></a>

                            <h4>+12-34-567-890</h4>
                            <span>xxx@gmail.com</span>
                            <span>XX, XXX, XXX, Ho Chi Minh, VN</span>
                        </div>
                    </div>

                    <!-- Single Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget mb-80">
                            <!-- Widget Title -->
                            <h5 class="widget-title">Our Blog</h5>

                            <!-- Single Blog Area -->
                            <div class="latest-blog-area">
                                <a href="#" class="post-title">Freelance Design Tricks How</a>
                                <span class="post-date"><i class="fa fa-clock-o" aria-hidden="true"></i> Jan 02, 2019</span>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget Area -->
                    <div class="col-12 col-sm-4 col-lg-2">
                        <div class="single-footer-widget mb-80">
                            <!-- Widget Title -->
                            <h5 class="widget-title">Pages</h5>

                            <!-- Footer Nav -->
                            <ul class="footer-nav">
                                <li><a href="/home"><i class="fa fa-caret-right" aria-hidden="true"></i> Home</a></li>
                                <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Our Rooms</a></li>
                                <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Blog</a></li>
                                <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</a></li>
                                <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Contact</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Single Footer Widget Area -->
                    <div class="col-12 col-sm-8 col-lg-4">
                        <div class="single-footer-widget mb-80">
                            <!-- Widget Title -->
                            <h5 class="widget-title">Subscribe Newsletter</h5>
                            <span>Subscribe our newsletter gor get notification about new updates.</span>

                            <!-- Newsletter Form -->
                            <form action="#" class="nl-form">
                                <input type="email" class="form-control" placeholder="Enter your email...">
                                <button type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copywrite Area -->
        <div class="container">
            <div class="copywrite-content">
                <div class="row align-items-center">
                    <div class="col-12 col-md-8">
                        <!-- Copywrite Text -->
                        <div class="copywrite-text">
                            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> | All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Login Modal -->
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Login or Register</h4>
          <form action="#" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <table class="table">
                <tr>
                    <td><label for="">Username or email<span class="text-danger">*</span></label></td>
                    <td><input type="text" placeholder="Username or email" name="username"></td>
                </tr>
                <tr>
                    <td><label for="">Password<span class="text-danger">*</span></label></td>
                    <td><input type="password" placeholder="Password" name="password"></td>
                </tr>
                <tr>
                    <td colspan="2"><button class="btn roberto-btn" type="submit">Login</button></td>
                </tr>
                <tr>
                    <td colspan="2">Don't have an account?&nbsp <a href="#"><span class="text-danger">Register now!</span></a></td>
                </tr>
            </table>
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

      <!-- Footer Area End -->

      <!-- **** All JS Files ***** -->
      <!-- jQuery 2.2.4 -->
      <script src="{{asset('blog/js/jquery.min.js')}}"></script>
      <!-- Popper -->
      <script src="{{asset('blog/js/popper.min.js')}}"></script>
      <!-- Bootstrap -->
      <script src="{{asset('blog/js/bootstrap.min.js')}}"></script>
      <!-- All Plugins -->
      <script src="{{asset('blog/js/roberto.bundle.js')}}"></script>
      <!-- Active -->
      <script src="{{asset('blog/js/default-assets/active.js')}}"></script>

      <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
