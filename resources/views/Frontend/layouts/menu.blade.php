<div class="classy-menu">
                            <!-- Menu Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>
                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul id="nav">
                                    <li class="active"><a href="{{action('PageController@index')}}">Home</a></li>
                                    <li><a href="#">Our Hotels &amp; Motels</a>
                                        <ul class="dropdown">
                                            <li><a href="{{action('PageController@allHotels')}}">All</a></li>
                                            <li><a href="#">Hotels</a>
                                                <ul class="dropdown">
                                                    <li><a href="#">- Dropdown Item</a></li>

                                                </ul>
                                            </li>
                                            <li><a href="#">Motels</a>
                                                <ul class="dropdown">
                                                    <li><a href="#">- Dropdown Item</a></li>

                                                </ul>
                                            </li>
                                            <li><a href="#">Homestay</a>
                                                <ul class="dropdown">
                                                    <li><a href="#">- Dropdown Item</a></li>

                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Blog</a>
                                        <ul class="dropdown">
                                            <li><a href="{{action('PageController@blog')}}">All</a></li>
                                            <li><a href="{{action('PageController@blog')}}">New</a></li>
                                            <li><a href="{{action('PageController@blog')}}">Trend</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{action('PageController@about')}}">About Us</a></li>
                                    <li><a href="{{action('PageController@contact')}}">Contact</a></li>
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
