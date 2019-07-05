<template>
  <v-app v-show="loaded">
    <v-navigation-drawer clipped app fixed class="text--black" light v-model="drawer">
      <v-list>
        <v-list-tile class="style-link" :to="{name:'home'}">
          <v-list-tile-action>
            <v-icon>{{items[0].icon}}</v-icon>
          </v-list-tile-action>

          <v-list-tile-content>
            <v-list-tile-title>{{items[0].title}}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <!-- <v-list-group v-show="showMenu" no-action> -->
        <v-list-group no-action>
          <template v-slot:activator>
            <v-list-tile>
              <v-list-tile-action>
                <v-icon>{{items[1].icon}}</v-icon>
              </v-list-tile-action>
              <v-list-tile-title>{{items[1].title}}</v-list-tile-title>
            </v-list-tile>
          </template>
          <v-list-tile class="style-link" :to="{name:'room',query :{hotelId : hotelId}}">
            <v-list-tile-title>Rooms</v-list-tile-title>
          </v-list-tile>
          <v-list-tile class="style-link" :to="{name:'room-facility',query :{hotelId : hotelId}}">
            <v-list-tile-title>Room facility</v-list-tile-title>
          </v-list-tile>
        </v-list-group>
        <v-list-tile class="style-link" :to="{name:'service',query :{hotelId : hotelId}}">
          <v-list-tile-action>
            <v-icon>{{items[2].icon}}</v-icon>
          </v-list-tile-action>

          <v-list-tile-content>
            <v-list-tile-title>{{items[2].title}}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile class="style-link" :to="{name:'order',query :{hotelId : hotelId}}">
          <v-list-tile-action>
            <v-icon>{{items[3].icon}}</v-icon>
          </v-list-tile-action>

          <v-list-tile-content>
            <v-list-tile-title>{{items[3].title}}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar color="#0e2737" app fixed clipped-left flat class="white--text">
      <v-toolbar-side-icon @click.stop="drawer = !drawer" class="teal accent-4">
        <v-icon>dehaze</v-icon>
      </v-toolbar-side-icon>
      <v-toolbar-title class="white--text">Cool admin</v-toolbar-title>
      <v-spacer></v-spacer>
      <!-- <div>Currently working with
      <v-btn dark depressed round small>
        <span v-if="hotelName === ''">Choose Hotel below</span>
        <span v-else>{{hotelName}}</span>
      </v-btn>
      </div>-->
      <div v-if="hotelName === ''"></div>
      <div v-else>
        Currently working with
        <v-btn @click="logout" dark depressed round small>{{hotelName}}</v-btn>
      </div>
      <v-toolbar-items class="hidden-sm-and-down">
        <!-- <v-btn flat>do sth</v-btn> -->
        <v-avatar class="mt-2" @click="logout">
          <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John">
        </v-avatar>
      </v-toolbar-items>
    </v-toolbar>

    <v-content class="grey lighten-4">
      <v-container fluid>
        <!-- <router-view :is="currentComponent" v-bind="currentProperties"></router-view> -->
        <router-view
          v-bind="currentProperties"
          v-bind:arrayHotel="arrayHotel"
          v-bind:hotelPanel="hotelPanel"
          v-bind:arrayHotelType="arrayHotelType"
          v-bind:arrayProvince="arrayProvince"
          v-bind:arrayService="arrayService"
          v-bind:api_token="api_token"
          v-on:changeArrayHotel="update($event)"
          v-on:chooseHotel="chooseHotel($event)"
          v-on:panelIndex="panelIndex($event)"
        ></router-view>
      </v-container>
    </v-content>
  </v-app>
</template>
<script>
// import { setTimeout } from 'timers';
export default {
  data: function() {
    return {
      loaded: false,
      items: [
        { icon: "home", title: "Home" },
        { icon: "business", title: "Your Rooms" },
        { icon: "grade", title: "Service" },
        { icon: "grade", title: "Order" },
      ],
      drawer: null,
      userID: 1,
      arrayHotel: [],
      hotelPanel: [],
      arrayHotelType: [],
      arrayProvince: [],
      arrayDistrict: [],
      arrayWard: [],
      arrayService: [],
      formTitle: "",
      districtDisabled: true,
      wardDisabled: true,
      snackbar: false,
      snackbarText: "",
      snackbarTimeout: 5000,
      dialog: false,
      hotelId: 0,
      hotelName: "",
      hotel_stars_num: 2,
      currentProperties: "",
      showMenu: false,
      api_token: ""
    };
  },
  watch: {
    $route: function(to, from) {
      if (to.name == "home") {
        this.currentProperties = {
          arrayHotel: this.arrayHotel,
          arrayHotelType: this.arrayHotelType,
          arrayProvince: this.arrayProvince
        };
      } else if (to.name == "room" || to.name == "service") {
        this.currentProperties = {
          hotelId: this.hotelId
        };
      }
    },
    api_token: function() {
      console.log(this.api_token);
    }
  },
  created() {
    this.api_token = localStorage.getItem("api_token");
    if (this.api_token == null) {
      document.location.href = "login";
    } else {
      this.loaded = true;
    }
    this.initialize();
  },
  methods: {
    initialize() {
      var _this = this;
      axios
        .get("http://localhost:8000/api/manager/hotel", {
          headers: {
            Authorization: "Bearer " + this.api_token
          }
        })
        .then(response => {
          console.log(response);

          this.arrayHotel = response.data.data;
          this.hotelPanel = response.data.panel;
        })
        .catch(function(error) {
          if (error.response.status == 401) {
            _this.logout();
          }
        });
      axios
        .get("http://localhost:8000/api/manager/hotel-type", {
          headers: {
            Authorization: "Bearer " + this.api_token
          }
        })
        .then(response => {
          var arrayHotelType = response.data.data;
          this.arrayHotelType = arrayHotelType;
        })
        .catch(function(error) {
          if (error.response.status == 401) {
            _this.logout();
          }
        });
      axios
        .get("http://localhost:8000/api/manager/province", {
          headers: {
            Authorization: "Bearer " + this.api_token
          }
        })
        .then(response => {
          var arrayProvince = response.data.data;
          this.arrayProvince = arrayProvince;
        })
        .catch(function(error) {
          if (error.response.status == 401) {
            _this.logout();
          }
        });
      axios
        .get("http://localhost:8000/api/manager/service", {
          headers: {
            Authorization: "Bearer " + this.api_token
          }
        })
        .then(response => {
          this.arrayService = response.data.data;
        })
        .catch(function(error) {
          if (error.response.status == 401) {
            _this.logout();
          }
        });
    },
    update: function(data) {
      // console.log("data :" + data);
      // console.log("this.arrayHotel : " + this.arrayHotel);

      this.arrayHotel = data;
    },
    chooseHotel: function(hotelId) {
      this.hotelId = hotelId;
      // console.log(this.hotelId);
      for (var i = 0; i < this.arrayHotel.length; i++) {
        if (this.arrayHotel[i].id == hotelId) {
          this.hotelName = this.arrayHotel[i].name;
        }
      }

      if (this.hotelId != -1) {
        this.showMenu = true;
      }
    },
    panelIndex: function(index) {
      for (var i = 0; i < this.hotelPanel.length; i++) {
        this.hotelPanel[i] = false;
      }
      this.hotelPanel[index] = true;  
    },
    logout: function() {
      axios({
        method: "post",
        url: "http://localhost:8000/api/manager/logout",
        headers: {
          Authorization: "Bearer " + this.api_token
        }
      })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          if (error.response.status == 401) {
            _this.logout();
          }
        });
      localStorage.removeItem("api_token");
      this.api_token = null;
      location.href = "login";
    }
  }
};
</script>