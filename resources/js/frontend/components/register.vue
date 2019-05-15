<template>
  <div class="container">
    <!-- Breadcrumb Area Start -->
    <div
      class="breadcrumb-area bg-img bg-overlay jarallax"
      style="background-image: url('/blog/img/bg-img/16.jpg');"
    >
      <div class="container h-100">
        <div class="row h-100 align-items-center">
          <div class="col-12">
            <div class="breadcrumb-content text-center">
              <h2 class="page-title">Register</h2>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                  <li class="breadcrumb-item">
                    <a href="#">
                      <router-link :to="{name:'home'}">Home</router-link>
                    </a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">Register</li>
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
          <!-- Left-->
          <div class="col-12 col-lg-3"></div>
          <!-- Rregister Area Start -->
          <div class="col-12 col-lg-6">
            <form action="#" method="post" enctype="multipart/form-data">
              <div class="form-group mb-30">
                <div class="row">
                  <div class="col-12">
                    <span class="text-danger">{{error}}</span>
                  </div>
                </div>
                <label for="checkInDate">
                  Username
                  <span class="text-danger">*</span>
                </label>
                <div>
                  <div class="row">
                    <div class="col-12">
                      <input
                        v-on:change="change"
                        type="text"
                        class="form-control"
                        name="username"
                        placeholder="Username"
                        required
                        v-model="username"
                      >
                    </div>
                    <div class="col-12">
                      <span class="text-danger">{{errUsername}}</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group mb-30">
                <label for="guests">
                  Password
                  <span class="text-danger">*</span>
                </label>
                <div class="row">
                  <div class="col-12">
                    <input
                      v-on:change="change"
                      type="password"
                      name="password"
                      class="form-control"
                      placeholder="Password"
                      required
                      v-model="password"
                    >
                  </div>
                  <div class="col-12">
                    <span class="text-danger">{{errPass}}</span>
                  </div>
                </div>
              </div>
              <div class="form-group mb-30">
                <label for="guests">
                  Re-password
                  <span class="text-danger">*</span>
                </label>
                <div class="row">
                  <div class="col-12">
                    <input
                      v-on:change="change"
                      type="password"
                      name="re_password"
                      class="form-control"
                      placeholder="Re-password"
                      required
                      v-model="re_password"
                    >
                  </div>
                  <div class="col-12">
                    <span class="text-danger">{{errRepass}}</span>
                  </div>
                </div>
              </div>
              <div class="form-group mb-30">
                <label for="guests">
                  Email
                  <span class="text-danger">*</span>
                </label>
                <div class="row">
                  <div class="col-12">
                    <input
                      v-on:change="change"
                      type="text"
                      name="email"
                      class="form-control"
                      placeholder="Email"
                      required
                      v-model="email"
                    >
                  </div>
                  <div class="col-12">
                    <span class="text-danger">{{errEmail}}</span>
                  </div>
                </div>
              </div>
              <div class="form-group mb-30">
                <label for="guests">Name</label>
                <div class="row">
                  <div class="col-12">
                    <input
                      type="text"
                      name="name"
                      class="form-control"
                      placeholder="Name"
                      required
                      v-model="name"
                    >
                  </div>
                </div>
              </div>
              <div class="form-group mb-30">
                <label for="guests">Phone number</label>
                <div class="row">
                  <div class="col-12">
                    <input
                      type="text"
                      name="phone"
                      class="form-control"
                      placeholder="Phone number"
                      required
                      v-model="phone"
                    >
                  </div>
                </div>
              </div>
              <div class="form-group mb-30">
                <label for="guests">Address</label>
                <div class="row">
                  <div class="col-12">
                    <textarea
                      name="address"
                      cols="55"
                      rows="3"
                      placeholder="Address"
                      v-model="address"
                    ></textarea>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-12">
                    <span class="text-danger">{{errPolicy}}</span>
                  </div>
                </div>
                <input type="checkbox" name="policy" v-model="checked"> agreed
                <router-link :to="{name:'policy'}" class="text-primary">the policies.</router-link>
                <br>
                <button type="button" class="btn roberto-btn w-25" v-on:click="onSubmit">Register</button>
              </div>
            </form>
          </div>
          <!-- Right-->
          <div class="col-12 col-lg-3"></div>
        </div>
      </div>
    </div>
    <!-- Items Area End -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      checked: true,
      error: "",
      name: "",
      username: "",
      password: "",
      re_password: "",
      email: "",
      address: "",
      phone: "",
      errPolicy: "",
      errUsername: "Err",
      errPass: "",
      errRepass: "",
      errEmail: ""
    };
  },
  methods: {
    change: function() {
      this.error = "", 
      this.errPolicy = "";
      this.errUsername = "";
      this.errPass = "";
      this.errRepass = "";
      this.errEmail = "";
    },
    onSubmit: function() {
      if (this.password != this.re_password) {
        this.errRepass = "Not match!";
        return;
      } else this.errRepass = "";
      if (!this.checked) {
        this.errPolicy =
          "Did you read all the policies certainlly! Please check to argee.";
        return;
      } else this.errPolicy = "";
      axios({
        method: "post",
        url: "http://localhost:8000/api/register",
        params: {
          username: this.username,
          password: this.password,
          email: this.email,
          name: this.name,
          address: this.address,
          phone: this.phone
        }
      }).then(res => {
        console.log(res.data.status);
        if (res.data.status) {
          this.$router.push({ name: "login" });
          return;
        } else {
          this.error = "Something worng. Try again!";
          this.re_password = "";
          if (res.data.errors["username"])
            this.errUsername = res.data.errors["username"][0];
          if (res.data.errors["password"])
            this.errPass = res.data.errors["password"][0];
          if (res.data.errors["email"])
            this.errEmail = res.data.errors["email"][0];
          return;
        }
      });
    }
  }
};
</script>
