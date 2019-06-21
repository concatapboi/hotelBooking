<template>
  <div>
    <v-alert dismissible type="error" :value="show">{{messages}}</v-alert>
    <div class="login-form">
      <form action method="post">
        <div class="form-group">
          <label>Email Address</label>
          <input
            v-model="email"
            class="au-input au-input--full"
            type="text"
            name="email"
            placeholder="Email or Username"
          >
        </div>
        <div class="form-group">
          <label>Password</label>
          <input
            v-model="password"
            class="au-input au-input--full"
            type="password"
            name="password"
            placeholder="Password"
          >
        </div>
        <div class="login-checkbox">
          <label>
            <input type="checkbox" name="remember">Remember Me
          </label>
          <label>
            <a href="#">Forgotten Password?</a>
          </label>
        </div>
        <v-btn color="success" ripple block @click="login">Sign in</v-btn>
      </form>
      <router-view></router-view>
    </div>
  </div>
</template>
<script>
export default {
  data: function() {
    return {
      messages: "",
      show: false,
      email: "",
      password: "",
      api_token: ""
    };
  },
  methods: {
    login: function() {
      axios({
        method: "post",
        url: "http://localhost:8000/api/manager/login",
        data: {
          email: this.email,
          password: this.password
        }
      })
        .then(response => {
          console.log(response.data);
          if (response.data.status == true) {
            this.show = false;
            localStorage.api_token = response.data.token;
            this.api_token = localStorage.getItem("api_token");
            if(response.data.role == "manager"){
              document.location.href = "home";

            }else if(response.data.role == "admin"){
              document.location.href = "home";

            }
            console.log(this.api_token);
          } else {
            this.show = true;
            this.messages = response.data.messages;
            console.log(this.messages);
          }
        })
        .catch(error => {
          console.log(error.response);
        });
    }
  }
};
</script>
