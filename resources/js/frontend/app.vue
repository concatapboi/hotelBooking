<template>
  <v-app>
    <v-toolbar :color="drawer.color" app fixed flat height="90px">
      <v-layout row wrap fill-height>
        <v-flex shrink md12 class="mt-2">
          <v-layout row wrap>
            <v-flex md6 class="text-md-left white--text">
              <v-icon small color="teal lighten-2" class="ml-3">phone</v-icon>&nbsp;
              <span>1234567890</span>
              <v-icon small color="teal lighten-2" class="ml-3">email</v-icon>&nbsp;
              <span>xxx@gmail.com</span>
              <v-icon small color="teal lighten-2" class="ml-3">av_timer</v-icon>&nbsp;
              <span>{{time}}</span>
            </v-flex>
            <v-flex md6 class="text-md-right white--text">
              <a href="https://www.instagram.com/" target="_blank">
                <i class="fab fa-instagram white--text mr-4"></i>
              </a>
              <a href="https://www.facebook.com/" target="_blank">
                <i class="fab fa-facebook-f white--text mr-4"></i>
              </a>
              <a href="https://www.youtube.com/" target="_blank">
                <i class="fab fa-youtube white--text mr-4"></i>
              </a>
              <a href="https://www.twitter.com/" target="_blank">
                <i class="fab fa-twitter white--text mr-4"></i>
              </a>
              <a href="https://plus.google.com/" target="_blank">
                <i class="fab fa-google-plus-g white--text mr-4"></i>
              </a>
            </v-flex>
          </v-layout>
        </v-flex>
        <v-flex shrink md12 style="height:50px">
          <v-layout row wrap class="white text-md-center" fill-height align-center>
            <v-flex md2>
              <router-link :to="{name:'home'}">
                <v-tooltip top>
                  <template v-slot:activator="{ on }">
                    <img src="/blog/./img/core-img/logo.png" v-on="on">
                  </template>
                  <span>home</span>
                </v-tooltip>
              </router-link>
            </v-flex>
            <v-flex md2>
              <router-link :to="{name:'about'}" class="title text-uppercase">about us</router-link>
            </v-flex>
            <v-flex md2>
              <router-link :to="{name:'contact'}" class="title text-uppercase">contact</router-link>
            </v-flex>
            <v-flex md6>
              <v-btn depressed flat color="teal" v-if="!login.check" @click="dialog = true">
                <span class="title text-uppercase black--text">join us</span>
                <i class="fas fa-arrow-right mx-3 black--text"></i>
              </v-btn>
              <v-menu bottom right nudge-top="-42px" v-if="login.check">
                <template v-slot:activator="{ on }">
                  <v-avatar size="42px" tile color="black" v-on="on">
                    <v-avatar size="40px" tile color="white">
                      <img :src="login.user.avatar.image_link" alt>
                    </v-avatar>
                  </v-avatar>
                </template>
                <v-list light class="grey lighten-4">
                  <v-list-tile>
                    <div>
                      Hi!&nbsp;
                      <span class="font-italic">{{login.user.user.name}}</span>
                    </div>
                  </v-list-tile>
                  <v-divider></v-divider>
                  <v-list-tile tag="a" href="/community" target="_blank">
                    <v-list-tile-action>
                      <i class="fab fa-battle-net teal--text fa-lg"></i>
                    </v-list-tile-action>
                    <v-list-tile-content>Community</v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile tag="a" href="/community/account" target="_blank">
                    <v-list-tile-action>
                      <i class="fas fa-user-circle teal--text fa-lg"></i>
                    </v-list-tile-action>
                    <v-list-tile-content>Account</v-list-tile-content>
                  </v-list-tile>
                  <v-divider></v-divider>
                  <v-list-tile>
                    <v-btn dark depressed color="teal" large @click="logOut">
                      <i class="fas fa-sign-out-alt mx-2"></i>Logout
                    </v-btn>
                  </v-list-tile>
                </v-list>
              </v-menu>
            </v-flex>
          </v-layout>
        </v-flex>
      </v-layout>
    </v-toolbar>
    <div id="top"></div>
    <v-content class="pa-0" style="margin-top:93px;">
      <v-container fluid class="white my-0 py-0">
        <transition name="moveInUp">
        <router-view
          :loginDialog="dialog"
          v-on:loadLoginDialog="eventDialog"
          :login="login"
          :snackbar="snackbar"
          v-on:loadSnackbar="eventSnackbar"
          :place="place"
          :checkIn="checkIn"
          :checkOut="checkOut"
          :checkInFormatted="checkInFormatted"
          :checkOutFormatted="checkOutFormatted"
          v-on:loadSearchData="eventSearch"
        ></router-view>
        </transition>
        <v-btn
          href="#top"
          color="#0e2737"
          dark
          fixed
          bottom
          right
          fab
          depressed
          class="mr-5 mb-3 top"
        >
          <v-icon color="white">arrow_upward</v-icon>
        </v-btn>
      </v-container>
    </v-content>
    <v-footer dark height="auto">
      <v-card flat tile dark :color="drawer.color" width="100%" class="text-xs-center">
        <v-card-text>
          &copy;{{year}}
          <strong>| All rights reserved</strong>
        </v-card-text>
      </v-card>
    </v-footer>
    <v-dialog v-model="dialog" width="700px" persistent>
      <v-card color="grey lighten-4" flat tile width="100%" class="pa-5">
        <v-form ref="form" data-vv-scope="form1">
          <v-layout row wrap align-top justify-center>
            <v-card-title class="title text-uppercase font-weight-bold">Login</v-card-title>
            <v-card-text>
              Don't have an account.
              <span
                @click="registerDialog = true; dialog = false"
                class="pointer red--text"
              >Register!</span>
            </v-card-text>
            <v-flex md12 px-2>
              <v-text-field
                color="teal"
                :error-messages="errors.collect('form1.username')"
                data-vv-name="username"
                v-validate="'required|min:4'"
                type="text"
                outline
                v-model="login.username"
                label="Username"
              ></v-text-field>
              <v-text-field
                color="teal"
                :error-messages="errors.collect('form1.password')"
                data-vv-name="password"
                v-validate="'required|min:4'"
                type="password"
                outline
                v-model="login.password"
                label="Password"
                append-icon="visibility"
                v-on:click:append="login.value=true"
                v-if="!login.value"
              ></v-text-field>
              <v-text-field
                color="teal"
                :error-messages="errors.collect('form1.password')"
                data-vv-name="password"
                v-validate="'required|min:4'"
                type="text"
                outline
                v-model="login.password"
                label="Password"
                append-icon="visibility_off"
                v-on:click:append="login.value=false"
                v-else
              ></v-text-field>
              <v-btn color="teal" v-on:click="submitLogin" dark depressed>Login</v-btn>
              <v-btn color="grey" v-on:click="clear" dark depressed>Clear</v-btn>
              <v-btn color="red" v-on:click="dialog=false" dark depressed>Cancel</v-btn>
            </v-flex>
            <v-flex></v-flex>
          </v-layout>
        </v-form>
      </v-card>
    </v-dialog>
    <v-dialog
      v-model="registerDialog"
      fullscreen
      hide-overlay
      transition="dialog-bottom-transition"
      scrollable
      persistent
    >
      <v-layout fill-height class="white" justify-center>
        <v-form ref="form" data-vv-scope="form2">
          <v-layout row wrap justify-center align-center>
            <v-flex md12 class="ma-5">
              <span class="title red--text text-uppercase">register</span>
            </v-flex>
            <v-flex md5 class="ma-3">
              <v-text-field
                color="teal"
                :error-messages="errors.collect('form2.username')"
                data-vv-name="username"
                v-validate="'required|min:4'"
                type="text"
                outline
                v-model="register.username"
                label="Username"
              ></v-text-field>
              <v-text-field
                outline
                :error-messages="errors.collect('form2.email')"
                data-vv-name="email"
                name="email"
                color="teal"
                v-model="register.email"
                label="Email"
                v-validate="'required|email'"
              ></v-text-field>
              <v-text-field
                :error-messages="errors.collect('form2.password')"
                data-vv-name="password"
                ref="password"
                v-validate="'required|min:4'"
                type="password"
                outline
                color="teal"
                v-model="register.password"
                label="Your password"
                append-icon="visibility"
                v-on:click:append="register.value=true"
                v-if="!register.value"
              ></v-text-field>
              <v-text-field
                :error-messages="errors.collect('form2.password')"
                data-vv-name="password"
                ref="password"
                v-validate="'required|min:4'"
                type="text"
                outline
                color="teal"
                v-model="register.password"
                label="Your password"
                append-icon="visibility_off"
                v-on:click:append="register.value=false"
                v-else
              ></v-text-field>
              <v-text-field
                :error-messages="errors.collect('form2.password_confirmation')"
                data-vv-as="password"
                data-vv-name="password_confirmation"
                v-validate="'required|confirmed:password'"
                type="password"
                outline
                color="teal"
                v-model="register.rePassword"
                label="Password, again!"
                append-icon="visibility"
                v-on:click:append="register.value1=true"
                v-if="!register.value1"
              ></v-text-field>
              <v-text-field
                :error-messages="errors.collect('form2.password_confirmation')"
                data-vv-as="password"
                data-vv-name="password_confirmation"
                v-validate="'required|confirmed:password'"
                type="text"
                outline
                color="teal"
                v-model="register.rePassword"
                label="Password, again!"
                append-icon="visibility_off"
                v-on:click:append="register.value1=false"
                v-else
              ></v-text-field>
            </v-flex>
            <v-flex md5 class="ma-3">
              <v-text-field color="teal" type="text" outline v-model="register.name" label="Name"></v-text-field>
              <v-text-field
                color="teal"
                type="text"
                outline
                v-model="register.phone"
                label="Phone number"
              ></v-text-field>
              <v-textarea
                color="teal"
                outline
                auto-grow
                rows="1"
                v-model="register.address"
                label="Address"
              ></v-textarea>
            </v-flex>
            <v-flex class="text-md-center">
              <v-btn color="teal" v-on:click="submitRegister" dark depressed>Register</v-btn>
              <v-btn color="grey" v-on:click="clear" dark depressed>Clear</v-btn>
              <v-btn color="red" v-on:click="registerDialog = false" dark depressed>Cancel</v-btn>
            </v-flex>
          </v-layout>
        </v-form>
      </v-layout>
    </v-dialog>
    <v-snackbar
      v-model="snackbar.state"
      multi-line="multi-line"
      right
      :timeout="snackbar.timeout"
      top
      color="white"
      class="black--text font-weight-bold"
    >
      {{snackbar.content}}
      <v-icon v-on:click="snackbar.state = !snackbar.state" large color="black">close</v-icon>
    </v-snackbar>
  </v-app>
</template>
<script>
export default {
  $_veeValidate: {
    validator: "new"
  },
  props: [],
  data() {
    return {
      time:
        new Date().getHours() +
        ":" +
        new Date().getMinutes() +
        ":" +
        new Date().getSeconds(),
      memberCount: 0,
      register: {
        username: "",
        email: "",
        password: "",
        rePassword: "",
        value: false,
        value1: false,
        name: "",
        phone: "",
        address: ""
      },
      login: {
        check: false,
        token: "",
        username: "",
        password: "",
        value: false,
        user: {
          user: {
            name: ""
          },
          avatar: {
            image_link: ""
          }
        }
      },
      dialog: false,
      registerDialog: false,
      snackbar: {
        state: false,
        content: "",
        timeout: 2400
      },
      year: new Date().getFullYear(),
      drawer: {
        state: false,
        color: "#0e2737",
        iconColor: "#1cc3b2",
        communityIcon: "refresh",
        accountIcon: "folder_shared",
        logoutIcon: "logout"
      },
      notifications: {
        state: false,
        iconColor: "#1cc3b2",
        commentIcon: "message",
        followingIcon: "person_add",
        systemMessageIcon: "announcement",
        newsIcon: "fas fa-poll-h"
      },
      dictionary: {
        custom: {
          username: {
            required: () => "Email can not be empty",
            min: "Password can not be under 4 characters"
          },
          password: {
            min: "Password can not be under 4 characters"
          }
        }
      },
      place: "Hồ Chí Minh",
      now: new Date(),
      checkIn: new Date().toISOString().substr(0, 10),
      checkInFormatted: this.formatDate(new Date().toISOString().substr(0, 10)),
      checkOut: this.getNextDate(new Date().toISOString().substr(0, 10), 1),
      checkOutFormatted: this.formatDate(
        this.getNextDate(new Date().toISOString().substr(0, 10), 1)
      )
    };
  },
  created() {
    // localStorage.removeItem('login_token');
    this.getLogin();
    window.setInterval(() => {
      this.time =
        new Date().getHours() +
        ":" +
        new Date().getMinutes() +
        ":" +
        new Date().getSeconds();
    }, 1000);
  },
  watch: {
    // call again the method if dialog changes
    $route: "getLogin",
    dialog: function() {
      this.$refs.form.reset();
      this.$validator.reset();
      this.login.value = false;
    },
    checkIn: function(val) {
      if (val < new Date().toISOString().substr(0, 10)) {
        this.checkIn = new Date().toISOString().substr(0, 10);
        this.checkInFormatted = this.formatDate(this.checkIn);
      } else this.checkInFormatted = this.formatDate(this.checkIn);
      if (this.checkIn >= this.checkOut) {
        this.checkOut = this.getNextDate(val, 1);
        this.checkOutFormatted = this.formatDate(this.checkOut);
      }
    },
    checkOut: function(val) {
      if (val <= this.checkIn) {
        this.checkOut = this.getNextDate(this.checkIn, 1);
        this.checkOutFormatted = this.formatDate(this.checkOut);
      } else this.checkOutFormatted = this.formatDate(this.checkOut);
    }
  },
  mounted() {
    this.$validator.localize("en", this.dictionary);
  },
  methods: {
    getLogin: function() {
      this.login.token = localStorage.getItem("login_token");
      if (this.login.token != null) {
        axios({
          method: "get",
          url: "http://localhost:8000/api/getUserLogin",
          headers: {
            Authorization: "Bearer " + this.login.token
          }
        })
          .then(res => {
            console.log(res.data.user);
            this.login.user = res.data.user;
            this.login.check = true;
          })
          .catch(error => {
            if (error.response.status == 401) {
              localStorage.removeItem("login_token");
              this.login.token = localStorage.getItem("login_token");
              this.login.check = false;
              this.login.user = {
                user: [],
                avatar: []
              };
            }
          });
      } else {
        this.login.check = false;
        this.login.user = {
          user: [],
          avatar: []
        };
      }
    },
    eventSnackbar: function(val) {
      this.snackbar.state = !this.snackbar.state;
      this.snackbar.content = val + "";
    },
    clear: function() {
      this.$refs.form.reset();
      this.$validator.reset();
    },
    submitLogin: function() {
      this.$validator.validateAll("form1").then(valid => {
        if (valid) {
          axios({
            method: "post",
            url: "http://localhost:8000/api/login",
            data: {
              username: this.login.username,
              password: this.login.password
            }
          }).then(res => {
            if (!res.data.status) {
              this.eventSnackbar("Something wrong!");
              this.login.password = "";
              this.$validator.reset();
              return;
            }
            this.eventSnackbar("Login successfully!");
            this.dialog = false;
            this.login.check = true;
            this.login.username = "";
            this.login.password = "";
            localStorage.login_token = res.data.token;
            this.getLogin();
            return;
          });
        }
      });
    },
    logOut: function() {
      this.getLogin();
      if (this.login.check) {
        axios({
          method: "post",
          url: "http://localhost:8000/api/logout",
          headers: {
            Authorization: "Bearer " + this.login.token
          }
        }).then(res => {
          if (res.data.status) {
            this.login.check = false;
            this.login.token = "";
            this.login.user = [];
            localStorage.removeItem("login_token");
          }
        });
      }
    },
    submitRegister: function() {
      this.$validator.validateAll("form2").then(valid => {
        if (valid) {
          axios({
            method: "post",
            url: "http://localhost:8000/api/register",
            params: {
              username: this.register.username,
              email: this.register.email,
              password: this.register.password,
              name: this.register.name,
              phone: this.register.phone,
              address: this.register.address
            }
          }).then(res => {
            console.log(res.data.status);
            if (res.data.status) {
              this.registerDialog = false;
              this.eventSnackbar("Register sucessfully!");
              this.login.check = true;
            } else {
              this.eventSnackbar("Something wrong!");
            }
          });
        }
      });
    },
    formatDate: function(date) {
      if (!date) return null;
      const [year, month, day] = date.split("-");
      return `${day}/${month}/${year}`;
    },
    getNextDate: function(date, number) {
      const [year, month, day] = date.split("-");
      var newDate;
      if (day == 31) {
        var dayTemp = 1;
        var monthTemp = month;
        var yearTemp = year;
        if (monthTemp == 12) {
          monthTemp = 1;
          yearTemp = year + 1;
        } else monthTemp = month + 1;
        dayTemp = dayTemp + "";
        monthTemp = monthTemp + "";
        yearTemp = yearTemp + "";
        newDate = new Date(
          `${yearTemp}-${monthTemp.padStart(2, "0")}-${dayTemp.padStart(
            2,
            "0"
          )}`
        )
          .toISOString()
          .substr(0, 10);
      } else {
        var tempDate;
        tempDate = new Date(year + "-" + month + "-" + day).getDate() + number;
        tempDate = tempDate + "";
        newDate = new Date(
          `${year}-${month.padStart(2, "0")}-${tempDate.padStart(2, "0")}`
        )
          .toISOString()
          .substr(0, 10);
      }
      return newDate;
    },
    eventSearch: function(data) {
      this.place = data.place.trim();
      this.checkIn = data.checkIn;
      this.checkOut = data.checkOut;
    },
    eventDialog: function(val,num) {
      if(num==0){
        this.registerDialog = val;
      }else
      this.dialog = val;
    }
  }
};
</script>

<style scoped>
.v-navigation-drawer__border {
  display: none;
}
.v-tooltip__content {
  opacity: 1 !important;
  padding: 4px !important;
  border-bottom-left-radius: 20%;
  box-shadow: none !important;
}
.radius {
  border-bottom-left-radius: 20%;
}
.v-menu__content {
  box-shadow: none !important;
}
.pointer {
  cursor: pointer;
}
.footer-a {
  color: #fff !important;
  text-decoration: none;
}
.footer-a:hover {
  color: #00bfa5 !important;
  text-decoration-line: underline;
}
</style>