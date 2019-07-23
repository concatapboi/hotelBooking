<template>
  <v-app id="keep">
    <v-navigation-drawer v-model="drawer.state" fixed clipped temporary class="grey lighten-4" app>
      <v-img :aspect-ratio="16/9" src="http://localhost:8000/img/cover/5.jpg">
        <v-layout column fill-height class="lightbox white--text">
          <v-spacer></v-spacer>
          <v-flex shrink class="pl-2">
            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-avatar size="70px" tile flat color="white" v-on="on">
                  <router-link style="width:70px" :to="{name:'account'}">
                    <img :src="'/img/user/'+user.avatar.image_link" :alt="user.name" />
                  </router-link>
                </v-avatar>
              </template>
              <span>{{user.name}}</span>
            </v-tooltip>
            <div class="subheading font-weight-black mt-2">{{user.name}}</div>
            <div class="body-1">{{user.email}}</div>
          </v-flex>
        </v-layout>
      </v-img>
      <v-list dense class="grey lighten-4">
        <template>
          <v-list-tile :to="{name:'home'}">
            <v-list-tile-action>
              <v-icon :color="drawer.iconColor">{{drawer.communityIcon}}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title :class="textClass.black">Cộng Đồng</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>
        <v-divider></v-divider>
        <template>
          <v-list-tile :to="{name:'account'}">
            <v-list-tile-action>
              <v-icon :color="drawer.iconColor">{{drawer.accountIcon}}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title :class="textClass.black">Tài Khoản</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>
        <v-divider></v-divider>
        <template>
          <v-list-tile v-on:click="logOut">
            <v-list-tile-action>
              <v-icon :color="drawer.iconColor">{{drawer.logoutIcon}}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title :class="textClass.black">Đăng Xuất</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>
        <v-divider></v-divider>
        <v-spacer></v-spacer>
        <template>
          <v-layout class="ml-3 row wrap" justify-center align-top>
            <v-flex shrink md12>
              <p :class="textClass.teal">Copyright &copy;{{year}} | All rights reserved</p>
            </v-flex>
            <v-flex shrink md3>
              <a href="http://localhost:8000/" target="_blank" :class="textClass.grey">Trang Chủ</a>
              <br />
              <a
                href="http://localhost:8000/policies.html"
                target="_blank"
                :class="textClass.grey"
              >Chính Sách</a>
              <br />
              <a
                href="http://localhost:8000/about.html"
                target="_blank"
                :class="textClass.grey"
              >Về Chúng Tôi</a>
            </v-flex>
            <v-flex shrink md3>
              <a
                href="http://localhost:8000/contact.html"
                target="_blank"
                :class="textClass.grey"
              >Liên Hệ</a>
            </v-flex>
            <v-spacer></v-spacer>
          </v-layout>
        </template>
      </v-list>
    </v-navigation-drawer>
    <v-navigation-drawer v-model="notifications.state" fixed clipped class="grey lighten-4" right>
      <v-layout row wrap fill-height class="pa-0 ma-0 noti-margin-top">
        <v-flex md12 v-if="notifications.list.length>0">
          <v-layout row wrap class="pa-0 ma-0 mx-1" v-for="(notification,i) in notifications.list" :key="i">
            <v-flex md4 class="ml-2">
              <v-avatar>
                <img :src="'/img/user/'+notification.user.avatar" />
              </v-avatar>
            </v-flex>
            <v-flex md7 class="ml-1">
              <div>{{notification.user.name}}</div>
              <div>{{notifications.kind[notification.kind]}}</div>
            </v-flex>
            <v-flex md12 class="ml-2" v-if="notification.kind !=1">
              <div>"{{notification.message}}"</div>
            </v-flex>
            <v-flex md12 v-if="i<notifications.list.length-1"><v-divider></v-divider></v-flex>
          </v-layout>
        </v-flex>
        <v-flex md12 v-else>
          <div class="text-md-center">
            <span class="font-italic black--text caption">Không có thông báo...</span>
          </div>
        </v-flex>
      </v-layout>
    </v-navigation-drawer>
    <v-toolbar :color="drawer.color" app fixed clipped-right clipped-left flat>
      <v-toolbar-side-icon v-on:click="drawer.state = !drawer.state" class="teal accent-4"></v-toolbar-side-icon>
      <a class="title ml-3 mr-5 white--text text-uppercase" href="/community">Trang Chủ</a>
      <!-- <v-text-field
        solo
        label="who's you want to find?"
        :color="drawer.iconColor"
        prepend-inner-icon="search"
        class="mt-2"
      ></v-text-field>-->
      <v-spacer></v-spacer>
      <v-badge overlap color="red" class="mr-5" v-if="notifications.list.length>0">
        <template v-slot:badge>
          <span v-if="notifications.list.length <=3">{{notifications.list.length}}</span>
          <span v-else>{{notifications.list.length}}+</span>
        </template>
        <v-avatar :color="drawer.iconColor" size="40px">
          <v-icon dark v-on:click="notifications.state = !notifications.state">notifications</v-icon>
        </v-avatar>
      </v-badge>
      <v-avatar :color="drawer.iconColor" size="40px" class="mr-5" v-else>
        <v-icon dark v-on:click="notifications.state = !notifications.state">notifications</v-icon>
      </v-avatar>
    </v-toolbar>
    <div id="top"></div>
    <v-content>
      <v-container fluid fill-height class="grey lighten-2">
        <router-view
          :user="user"
          :customer="user"
          v-on:loadLogin="getLogin"
          :snackbar="snackbar"
          v-on:loadSnackbar="eventSnackbar"
          :login="login"
          :check="login.check"
        ></router-view>
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
    <v-dialog
      fullscreen
      hide-overlay
      transition="dialog-bottom-transition"
      v-model="login.dialog"
      persistent
    >
      <v-card title light width="100%" height="100%">
        <v-layout fill-height row wrap justify-center align-center class="pa-0 ma-0">
          <div class="text-md-center" v-if="flag === false">
            <div>
              <v-icon large color="#9980FA">fas fa-circle-notch fa-spin</v-icon>
            </div>
            <div>
              <span class="font-weight-black red--text">đ</span>
              <span class="font-weight-black orange--text">a</span>
              <span class="font-weight-black amber--text">n</span>
              <span class="font-weight-black green--text">g</span>
              <span class="font-weight-black blue--text">&nbsp;t</span>
              <span class="font-weight-black indigo--text">ả</span>
              <span class="font-weight-black purple--text">i</span>
              <span class="font-weight-black teal--text">.</span>
              <span class="font-weight-black teal--text">.</span>
              <span class="font-weight-black teal--text">.</span>
            </div>
          </div>
          <v-flex md9 v-else>
            <v-layout
              row
              wrap
              justify-center
              align-center
              class="pa-5 ma-0 border border-warning rounded"
            >
              <v-flex md5 mr-2>
                <v-img :aspect-ratio="4/3" src="/blog/img/slider/slider.png" class="radius">
                  <v-layout fill-height justify-center align-center>
                    <div>
                      <div>
                        <a href="/" target="_blank" class="body-1">Trang Chủ</a>
                      </div>
                      <div class="ml-1 pl-3 border-left border-dark">
                        <div>
                          <a href="/about.html" target="_blank" class="caption">Về Chúng Tôi</a>
                        </div>
                        <div>
                          <a href="/contact.html" target="_blank" class="caption">Liên Hệ</a>
                        </div>
                      </div>
                    </div>
                  </v-layout>
                </v-img>
              </v-flex>
              <v-flex md6 ml-2>
                <v-form ref="form" data-vv-scope="form1">
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
                    label="Mật khẩu"
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
                    label="Mật khẩu"
                    append-icon="visibility_off"
                    v-on:click:append="login.value=false"
                    v-else
                  ></v-text-field>
                  <v-btn round color="teal" v-on:click="submitLogin" dark depressed>Đăng Nhập</v-btn>
                  <v-btn round color="grey" v-on:click="clear" dark depressed>Xóa</v-btn>
                </v-form>
              </v-flex>
            </v-layout>
          </v-flex>
        </v-layout>
      </v-card>
    </v-dialog>
  </v-app>
</template>

<script>
export default {
  $_veeValidate: {
    validator: "new"
  },
  data() {
    return {
      flag: false,
      dictionary: {
        custom: {
          username: {
            required: () => "Username không được bỏ trống",
            min: "Username phải nhiều hơn 3 ký tự"
          },
          password: {
            min: "Password phải nhiều hơn 3 ký tự"
          }
        }
      },
      login: {
        dialog: true,
        check: false,
        token: "",
        username: "",
        password: "",
        value: false
      },
      button: false,
      snackbar: {
        state: false,
        content: "",
        timeout: 36000
      },
      hello: "hello",
      year: new Date().getFullYear(),
      textClass: {
        black: "black--text",
        grey: "grey--text",
        teal: "teal--text"
      },
      user: {
        id: 0,
        customer: {},
        avatar: {},
        followers: [],
        customerFollowings: [],
        hotelFollowings: [],
        booking: [],
        question: []
      },
      drawer: {
        state: false,
        color: "#0e2737",
        iconColor: "#1cc3b2",
        communityIcon: "refresh",
        accountIcon: "folder_shared",
        logoutIcon: "logout"
      },
      notifications: {
        kind:[
          'Đã bình luận',//index 0
          'Đang theo dõi bạn',//index 1
        ],
        state: false,
        iconColor: "#1cc3b2",
        commentIcon: "message",
        followingIcon: "person_add",
        systemMessageIcon: "announcement",
        newsIcon: "fas fa-poll-h",
        list: []
      }
    };
  },
  created() {
    console.log("created");
    this.getLogin();
  },
  mounted() {
    this.$validator.localize("en", this.dictionary);
    window.Echo.channel("message").listen(".send-mess", e => {
      alert(e.message);
      this.notifications.list.push(e);
      console.log(e);
    });
  },
  watch: {
    // call again the method if the route changes
    $route: "getLogin"
  },
  methods: {
    accountPage: function() {
      this.$router.push({ name: "account" });
    },
    communityPage: function() {
      this.$router.push({ name: "home" });
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
            this.login.dialog = true;
            this.flag = true;
            this.login.token = "";
            localStorage.removeItem("login_token");
          }
        });
      }
    },
    event: function(val) {
      this.hello = val;
    },
    eventSnackbar: function(val) {
      this.snackbar.state = !this.snackbar.state;
      this.snackbar.content = val + "";
    },
    getLogin: function() {
      this.login.token = localStorage.getItem("login_token");
      console.log(this.login.token);
      if (this.login.token != null) {
        axios({
          method: "get",
          url: "http://localhost:8000/api/getUser",
          headers: {
            Authorization: "Bearer " + this.login.token
          }
        })
          .then(res => {
            this.user = res.data.user;
            this.login.check = true;
            this.login.dialog = false;
            if (this.$route.name == "login")
              this.$router.push({ name: "home" });
            console.log(this.user);
          })
          .catch(error => {
            console.log(error.response);
            if (error.response.status == 401) {
              localStorage.removeItem("login_token");
              this.login.token = localStorage.getItem("login_token");
              this.login.check = false;
              this.login.dialog = true;
              this.flag = true;
              this.$router.push({ name: "login" });
            }
          });
      } else {
        this.flag = true;
        this.$router.push({ name: "login" });
        this.login.check = false;
        this.login.dialog = true;
      }
    },
    clear: function() {
      this.$refs.form.reset();
      this.$validator.reset();
    },
    submitLogin: function() {
      console.log(this.login);
      this.$validator.validateAll("form1").then(valid => {
        if (valid) {
          axios({
            method: "post",
            url: "http://localhost:8000/api/login",
            data: {
              username: this.login.username,
              password: this.login.password
            }
          })
            .then(res => {
              if (!res.data.status) {
                this.eventSnackbar("Rất tiếc, thực hiện không thành công!");
                this.login.check = false;
                this.login.password = "";
                this.$validator.reset();
                return;
              }
              localStorage.login_token = res.data.token;
              // this.eventSnackbar("Login successfully!");
              this.login.dialog = false;
              this.flag = true;
              this.login.check = true;
              this.clear();
              localStorage.login_token = res.data.token;
              this.getLogin();
              this.$router.push({ name: "account" });
              return;
            })
            .catch(error => {
              console.log(error.response);
              if (error.response.status == 401) {
                localStorage.removeItem("login_token");
                this.login.token = localStorage.getItem("login_token");
                this.login.password = "";
                this.$validator.reset();
                return;
              }
            });
        }
      });
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
.noti-margin-top {
  margin-top: 70px !important;
}
</style>