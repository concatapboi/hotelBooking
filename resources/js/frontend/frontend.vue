<template>
  <v-app>
    <header class="header-area">
      <!-- Search Form -->
      <div class="search-form d-flex align-items-center">
        <div class="container">
          <form action="index.html" method="get">
            <input
              type="search"
              name="search-form-input"
              id="searchFormInput"
              placeholder="Type your keyword.Ex: name of place/hotels/motels/homestay..."
            >
            <button type="submit">
              <i class="icon_search"></i>
            </button>
          </form>
        </div>
      </div>

      <!-- Top Header Area Start -->
      <div class="top-header-area">
        <div class="container">
          <div class="row">
            <div class="col-6">
              <div class="top-header-content">
                <a href="#">
                  <i class="icon_phone"></i>
                  <span>+12-34-567-890</span>
                </a>
                <a href="#">
                  <i class="icon_mail"></i>
                  <span>xxx@gmail.com</span>
                </a>
              </div>
            </div>

            <div class="col-6">
              <div class="top-header-content">
                <!-- Top Social Area -->
                <div class="top-social-area ml-auto">
                  <a href="https://www.facebook.com/" target="_blank">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a href="https://twitter.com/" target="_blank">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                  </a>
                  <a href="https://plus.google.com/" target="_blank">
                    <i class="fa fa-google-plus" aria-hidden="true"></i>
                  </a>
                  <a href="https://www.youtube.com/" target="_blank">
                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                  </a>
                  <a href="https://www.tumblr.com/" target="_blank">
                    <i class="fa fa-tumblr" aria-hidden="true"></i>
                  </a>
                  <a href="https://www.instagram.com/" target="_blank">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                  </a>
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
              <router-link :to="{name:'home'}">
                <img src="/blog/./img/core-img/logo.png" alt>
              </router-link>

              <!-- Navbar Toggler -->
              <div class="classy-navbar-toggler">
                <span class="navbarToggler">
                  <span></span>
                  <span></span>
                  <span></span>
                </span>
              </div>

              <!-- Menu -->
              <div class="classy-menu">
                <!-- Menu Close Button -->
                <div class="classycloseIcon">
                  <div class="cross-wrap">
                    <span class="top"></span>
                    <span class="bottom"></span>
                  </div>
                </div>
                <!-- Nav Start -->
                <div class="classynav">
                  <ul id="nav">
                    <li class="active">
                      <router-link :to="{name:'home'}">Home</router-link>
                    </li>
                    <li>
                      <router-link :to="{name:'about'}">About</router-link>
                    </li>
                    <li>
                      <router-link :to="{name:'contact'}">Contact</router-link>
                    </li>
                    <li v-if="!status">
                      <router-link :to="{name:'register'}">Register</router-link>
                    </li>
                    <li v-else>
                      <a href="#" v-on:click="logout">Logout</a>
                    </li>
                  </ul>
                  <!-- Login Now -->
                  <div class="book-now-btn ml-3 ml-lg-5" v-if="!status">
                    <router-link :to="{name:'login'}">
                      Login
                      <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                    </router-link>
                  </div>
                  <div class="book-now-btn ml-3 ml-lg-5" v-else>
                    <router-link :to="{name:'account'}">
                      Account
                      <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                    </router-link>
                  </div>
                </div>
                <!-- Nav End -->
              </div>
            </nav>
          </div>
        </div>
      </div>
    </header>
    <router-view></router-view>
  </v-app>
</template>
<script>
export default {
  data() {
    return {
      status: null,
      user: null,
    };
  },
  created() {
    this.getLogin();
  },
  methods: {
    getLogin: function() {
      axios({
        method: "get",
        url: "http://localhost:8000/api/getUserLogin"
      }).then(res => {
        console.log(res.data.status);
        if (res.data.status) {
          this.status = res.data.status;
          this.user = res.data.user;
        }
      });
    },
    logout: function(){
        axios({
        method: "get",
        url: "http://localhost:8000/api/getLogout"
      }).then(res => {
        console.log(res.data.status);
        this.status = false;
      });
    },
  }
};
</script>
