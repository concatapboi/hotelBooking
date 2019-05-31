<template>
  <v-app>
    <v-navigation-drawer clipped app fixed class="primary" dark v-model="drawer">
      <v-list>
        <v-list-tile class="style-link" :to="{name:'home'}">
          <v-list-tile-action>
            <v-icon>{{items[0].icon}}</v-icon>
          </v-list-tile-action>

          <v-list-tile-content>
            <v-list-tile-title>{{items[0].title}}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-group v-show="showMenu" no-action>
          <template v-slot:activator>
            <v-list-tile>
              <v-list-tile-action>
                <v-icon>{{items[1].icon}}</v-icon>
              </v-list-tile-action>
              <v-list-tile-title>{{items[1].title}}</v-list-tile-title>
            </v-list-tile>
          </template>
          <v-list-tile class="style-link" :to="{name:'room'}">
            <v-list-tile-title>Gerneral information</v-list-tile-title>
          </v-list-tile>
        </v-list-group>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar app fixed clipped-left>
      <v-toolbar-side-icon @click.stop="drawer = !drawer">
        <v-icon>dehaze</v-icon>
      </v-toolbar-side-icon>
      <v-toolbar-title>Cool admin</v-toolbar-title>
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
        <v-btn dark depressed round small>{{hotelName}}</v-btn>
      </div>
      <v-toolbar-items class="hidden-sm-and-down">
        <v-btn flat>do sth</v-btn>
        <v-avatar class="mt-2">
          <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John">
        </v-avatar>
      </v-toolbar-items>
    </v-toolbar>

    <v-content>
      <v-container fluid>
        <!-- <router-view :is="currentComponent" v-bind="currentProperties"></router-view> -->
        <router-view
          v-bind="currentProperties"
          v-bind:arrayHotel="arrayHotel"
          v-bind:arrayHotelType="arrayHotelType"
          v-bind:arrayProvince="arrayProvince"
          v-on:changeArrayHotel="update($event)"
          v-on:chooseHotel="chooseHotel($event)"
        ></router-view>
      </v-container>
    </v-content>
  </v-app>
</template>
<script>
export default {
  data: function() {
    return {
      items: [
        { icon: "home", title: "Home" },
        { icon: "business", title: "Your Rooms" },
        { icon: "info", title: "About" }
      ],
      drawer: null,
      userID: 1,
      arrayHotel: [],
      arrayHotelType: [],
      arrayProvince: [],
      arrayDistrict: [],
      arrayWard: [],
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
      showMenu: false
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
      } else if (to.name == "room") {
        this.currentProperties = {
          hotelId: this.hotelId
        };
      }
    }
  },
  created() {
    this.initialize();
  },
  methods: {
    initialize() {
      var _this = this;
      axios
        .get("http://localhost:8000/api/manager/hotel", {
          params: {
            api_token: 123
          }
        })
        .then(response => {
          _this.arrayHotel = response.data.data;
        })
        .catch(function(error) {
          console.log(error);
        });
      axios
        .get("http://localhost:8000/api/manager/hotel-type", {
          params: {
            api_token: 123
          }
        })
        .then(response => {
          var arrayHotelType = response.data.data;
          _this.arrayHotelType = arrayHotelType;
        })
        .catch(function(error) {
          console.log(error);
        });
      axios
        .get("http://localhost:8000/api/manager/province", {})
        .then(response => {
          var arrayProvince = response.data.data;
          _this.arrayProvince = arrayProvince;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    update: function(data) {
      // console.log("data :" + data);
      // console.log("this.arrayHotel : " + this.arrayHotel);

      this.arrayHotel = data;
    },
    chooseHotel: function(hotelId) {
      this.hotelId = hotelId;
      console.log();
      for (var i = 0; i < this.arrayHotel.length; i++) {
        if (this.arrayHotel[i].id == hotelId) {
          this.hotelName = this.arrayHotel[i].name;
        }
      }

      if (this.hotelId != -1) {
        this.showMenu = true;
      }
    }
  }
};
</script>