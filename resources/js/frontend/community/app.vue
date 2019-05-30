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
                  <img :src="user.avatar.image_link" :alt="user.user.name">
                </v-avatar>
              </template>
              <span>{{user.user.name}}</span>
            </v-tooltip>
            <div class="subheading font-weight-black mt-2">{{user.user.name}}</div>
            <div class="body-1">{{user.user.email}}</div>
          </v-flex>
        </v-layout>
      </v-img>
      <v-list dense class="grey lighten-4">
        <template>
          <v-list-tile v-on:click="communityPage">
            <v-list-tile-action>
              <v-icon :color="drawer.iconColor">{{drawer.communityIcon}}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title :class="textClass.black">Community</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>
        <v-divider></v-divider>
        <template>
          <v-list-tile v-on:click="accountPage">
            <v-list-tile-action>
              <v-icon :color="drawer.iconColor">{{drawer.accountIcon}}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title :class="textClass.black">Account</v-list-tile-title>
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
              <v-list-tile-title :class="textClass.black">Logout</v-list-tile-title>
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
              <a href="http://localhost:8000/" target="_blank" :class="textClass.grey">Website</a>
              <br>
              <a
                href="http://localhost:8000/policies.html"
                target="_blank"
                :class="textClass.grey"
              >Policies</a>
              <br>
              <a
                href="http://localhost:8000/about.html"
                target="_blank"
                :class="textClass.grey"
              >About us</a>
            </v-flex>
            <v-flex shrink md3>
              <a
                href="http://localhost:8000/hotel.html"
                target="_blank"
                :class="textClass.grey"
              >Our Hotels</a>
              <br>
              <a
                href="http://localhost:8000/contact.html"
                target="_blank"
                :class="textClass.grey"
              >Contact</a>
            </v-flex>
            <v-spacer></v-spacer>
          </v-layout>
        </template>
      </v-list>
    </v-navigation-drawer>
    <v-navigation-drawer v-model="notifications.state" fixed clipped class="grey lighten-4" right>
      <v-list dense class="grey lighten-4">
        <template>
          <v-list-tile>
            <v-list-tile-action>
              <v-icon :color="notifications.iconColor">{{notifications.commentIcon}}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title :class="textClass.black">
                <span>New comment!</span>
              </v-list-tile-title>
              <v-list-tile-sub-title
                :class="textClass.grey"
              >John do smth. He wants you to know that....</v-list-tile-sub-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>
        <v-divider></v-divider>
        <template>
          <v-list-tile>
            <v-list-tile-action>
              <v-icon :color="notifications.iconColor">{{notifications.followingIcon}}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title :class="textClass.black">New following!</v-list-tile-title>
              <v-list-tile-sub-title :class="textClass.grey">John is now following you...</v-list-tile-sub-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>
        <v-divider></v-divider>
        <template>
          <v-list-tile>
            <v-list-tile-action>
              <v-icon :color="notifications.iconColor">{{notifications.systemMessageIcon}}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title :class="textClass.black">New message!</v-list-tile-title>
              <v-list-tile-sub-title :class="textClass.grey">System wants you to...</v-list-tile-sub-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>
        <v-divider></v-divider>
        <template>
          <v-list-tile>
            <v-list-tile-action>
              <v-icon :color="notifications.iconColor">{{notifications.newsIcon}}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title :class="textClass.black">News!: {{hello}}</v-list-tile-title>
              <v-list-tile-sub-title :class="textClass.grey">Hotel is uploading a new...</v-list-tile-sub-title>
            </v-list-tile-content>
          </v-list-tile>
        </template>
        <v-divider></v-divider>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar :color="drawer.color" app fixed clipped-right clipped-left flat>
      <v-toolbar-side-icon v-on:click="drawer.state = !drawer.state" class="teal accent-4"></v-toolbar-side-icon>
      <a class="title ml-3 mr-5 white--text text-uppercase" href="/">website</a>
      <v-text-field
        solo
        label="who's you want to find?"
        :color="drawer.iconColor"
        prepend-inner-icon="search"
        class="mt-2"
      ></v-text-field>
      <v-spacer></v-spacer>
      <v-badge overlap color="red" class="mr-5">
        <template v-slot:badge>
          <span>3+</span>
        </template>
        <v-avatar :color="drawer.iconColor" size="40px">
          <v-icon dark v-on:click="notifications.state = !notifications.state">notifications</v-icon>
        </v-avatar>
      </v-badge>
    </v-toolbar>
    <v-content>
      <v-container fluid fill-height class="grey lighten-4">
        <router-view
          :hello="hello"
          v-on:helloEdited="event"
          v-on:loadUser="getUser"
          :snackbar="snackbar"
          v-on:loadSnackbar="eventSnackbar"
        ></router-view>
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
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      snackbar: {
        state: false,
        content: "",
        timeout: 1000
      },
      hello: "hello",
      year: new Date().getFullYear(),
      textClass: {
        black: "black--text",
        grey: "grey--text",
        teal: "teal--text"
      },
      user: {
        id: 4,
        avatar: [],
        user: [],
        customer: [],
        userFollowing: 0,
        hotelFollowing: 0,
        followers: 0
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
        state: false,
        iconColor: "#1cc3b2",
        commentIcon: "message",
        followingIcon: "person_add",
        systemMessageIcon: "announcement",
        newsIcon: "fas fa-poll-h"
      }
    };
  },
  created() {
    this.getUser();
  },
  watch: {
    // call again the method if the route changes
    $route: "getUser"
  },
  methods: {
    accountPage: function() {
      this.$router.push({ name: "account" });
    },
    communityPage: function() {
      this.$router.push({ name: "home" });
    },
    logOut: function() {
      this.hello = " new 1";
      return;
    },
    getUser: function() {
      axios({
        method: "get",
        url: "http://localhost:8000/api/user/" + this.user.id,
        params: {
          id: this.user.id
        }
      }).then(res => {
        console.log(res.data.avatar);
        if (!res.data.status) {
          this.$router.push({ name: "login" });
          return;
        }
        this.user.user = res.data.user;
        this.user.avatar = res.data.avatar;
        this.user.customer = res.data.customer;
        this.user.userFollowing = res.data.userFollowing;
        this.user.hotelFollowing = res.data.hotelFollowing;
        this.user.followers = res.data.followers;
        return;
      });
    },
    event: function(val) {
      this.hello = val;
    },
    eventSnackbar: function(val) {
      this.snackbar.state = !this.snackbar.state;
      this.snackbar.content = val + "";
    }
  }
};
</script>

<style scoped>
.v-navigation-drawer__border {
  display: none;
}
a {
  cursor: pointer;
  text-decoration-line: none !important;
}
a:hover {
  color: #00bfa5 !important;
}
</style>