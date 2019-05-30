<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="UTF-8">
      <meta name="description" content="">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <script>window.Laravel = { csrfToken : '{{ csrf_token() }}' }</script>  	
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Title -->
      <title>Roberto - Hotel &amp; Resort HTML Template</title>

      <!-- Favicon -->
      <link rel="icon" href="{{asset('blog/img/core-img/favicon.png')}}">

      <!-- Stylesheet -->
      
      <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
      <link rel="stylesheet" href="{{asset('blog/style.css')}}">
      <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">  
      <!-- Styles -->
    </head>
    <body>
      
    
      <div id="app"></div>
                            
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
                          <a href="/contact.html" class="btn roberto-btn mb-50">Contact Now</a>
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
                                <li><a href="/"><i class="fa fa-caret-right" aria-hidden="true"></i> Home</a></li>
                                <li><a href="/hotels.html" target="blank"><i class="fa fa-caret-right" aria-hidden="true"></i>Our Hotels</a></li>
                                <li><a href="/policies.html" target="blank"><i class="fa fa-caret-right" aria-hidden="true"></i>Policies</a></li>
                                <li><a href="/about.html" target="blank"><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</a></li>
                                <li><a href="/contact.html" target="blank"><i class="fa fa-caret-right" aria-hidden="true"></i>Contact</a></li>
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

      <!-- Footer Area End -->

      <!-- **** All JS Files ***** -->
      <!-- jQuery 2.2.4 -->
      <script src="{{asset('js/app.js')}}"></script>
      <script src="{{asset('blog/js/jquery.min.js')}}"></script>
      <!-- Popper -->
      <script src="{{asset('blog/js/popper.min.js')}}"></script>
      <!-- Bootstrap -->
      <script src="{{asset('blog/js/bootstrap.min.js')}}"></script>
      <!-- All Plugins -->
      <script src="{{asset('blog/js/roberto.bundle.js')}}"></script>
      <!-- Active -->
      <script src="{{asset('blog/js/default-assets/active.js')}}"></script>

      
    </body>
</html>
