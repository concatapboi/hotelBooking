<template>
  <v-app v-show="loaded">
    <v-navigation-drawer clipped app fixed class="text--black" light v-model="drawer">
      <v-list>
        <v-list-tile class="style-link" :to="{name:'home' , query :{hotelId : hotelId}}">
          <v-list-tile-action>
            <i class="ma-1 fa-lg fas fa-home"></i>
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
                <i class="ma-1 fa-lg fas fa-hotel"></i>
              </v-list-tile-action>
              <v-list-tile-title>{{items[1].title}}</v-list-tile-title>
            </v-list-tile>
          </template>
          <v-list-tile class="style-link" :to="{name:'room',query :{hotelId : hotelId}}">
            <i class="ma-1 fa-lg fas fa-bed"></i>
            <v-list-tile-title>Quản lý Phòng</v-list-tile-title>
          </v-list-tile>
          <v-list-tile class="style-link" :to="{name:'room-facility',query :{hotelId : hotelId}}">
            <i class="ma-1 fa-lg fas fa-tools"></i>
            <v-list-tile-title>Cơ sở vật chất</v-list-tile-title>
          </v-list-tile>
        </v-list-group>
        <v-list-tile class="style-link" :to="{name:'service',query :{hotelId : hotelId}}">
          <v-list-tile-action>
            <i class="ma-1 fas fa-lg fa-concierge-bell"></i>
          </v-list-tile-action>

          <v-list-tile-content>
            <v-list-tile-title>{{items[2].title}}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile class="style-link" :to="{name:'order',query :{hotelId : hotelId}}">
          <v-list-tile-action>
            <i class="fas fa-calendar-day"></i>
          </v-list-tile-action>

          <v-list-tile-content>
            <v-list-tile-title>{{items[3].title}}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile class="style-link" :to="{name:'coupon-code',query :{hotelId : hotelId}}">
          <v-list-tile-action>
            <v-icon :color="items[4].color">{{items[4].icon}}</v-icon>
          </v-list-tile-action>

          <v-list-tile-content>
            <v-list-tile-title>{{items[4].title}}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
        <v-list-tile class="style-link" :to="{name:'question',query :{hotelId : hotelId}}">
          <v-list-tile-action>
            <v-icon :color="items[5].color">{{items[5].icon}}</v-icon>
          </v-list-tile-action>

          <v-list-tile-content>
            <v-list-tile-title>{{items[5].title}}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
    <v-toolbar color="#0e2737" app fixed clipped-left clipped-right flat class="white--text">
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
        Đang thao tác với khách sạn
        <v-btn @click="logout" dark depressed round small>{{hotelName}}</v-btn>
      </div>
      <v-toolbar-items class="hidden-sm-and-down">
        <!-- <v-btn flat>do sth</v-btn> -->
        <!-- <v-avatar class="mt-2" @click="logout">
          <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John">
        </v-avatar>-->
        <!-- <v-speed-dial :transition="`slide-x-reverse-transition`" :direction="`left`">
          <template v-slot:activator>
            <v-badge overlap color="red" class="mr-5">
              <template v-slot:badge>
                <span>{{notifications.list.length}}</span>
              </template>
              <v-avatar :color="'blue'" size="40px">
                <v-icon dark v-on:click="notifications.state = !notifications.state">notifications</v-icon>
              </v-avatar>
            </v-badge>
          </template>
          <v-btn fab dark small color="green">
            <v-icon>edit</v-icon>
          </v-btn>
          <v-btn fab dark small color="indigo">
            <v-icon>add</v-icon>
          </v-btn>
          <v-btn fab dark small color="red">
            <v-icon>delete</v-icon>
          </v-btn>
        </v-speed-dial>-->
        <span class="mt-2 mr-3">
          <v-badge v-if="notifications.list.length >0" overlap color="red">
            <template v-slot:badge>
              <span>{{notifications.list.length}}</span>
            </template>
            <v-avatar :color="'blue'">
              <v-icon dark v-on:click="notifications.state = !notifications.state">notifications</v-icon>
            </v-avatar>
          </v-badge>
          <v-avatar v-else :color="'blue'">
            <v-icon dark v-on:click="notifications.state = !notifications.state">notifications</v-icon>
          </v-avatar>
        </span>

        <v-menu offset-y>
          <template v-slot:activator="{ on }">
            <!-- <v-btn color="primary" dark v-on="on">Dropdown</v-btn> -->
            <v-avatar v-on="on" class="mt-2">
              <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John" />
            </v-avatar>
          </template>
          <v-list>
            <v-list-tile>
              <v-list-tile-title>Account</v-list-tile-title>
            </v-list-tile>
            <v-list-tile>
              <v-list-tile-title></v-list-tile-title>
            </v-list-tile>
            <v-list-tile>
              <v-list-tile-title @click="logout">logout</v-list-tile-title>
            </v-list-tile>
          </v-list>
        </v-menu>
      </v-toolbar-items>
    </v-toolbar>
    <v-navigation-drawer
      v-model="notifications.state"
      clipped
      temporary
      absolute
      class="grey lighten-4"
      right
    >
      <v-layout row wrap class="pa-0 ma-0">
        <!-- {{notifications.list}} -->
        <v-flex md12>
          <v-list two-line>
            <div v-for="(notification,i) in notifications.list" :key="i">
              <div v-if="notification.data.ask">
                <v-layout row wrap class="mx-1 ma-0 caption grey lighten-2">
                  <v-flex md12 class="ma-3">
                    <div class="font-weight-bold purple--text">{{notification.data.message}}</div>
                    <div class="pl-3 ml-1 border-left border-light">
                      <div>{{notification.data.ask.title}}</div>
                      <div class="font-italic">"{{notification.data.ask.content}}"</div>
                    </div>
                  </v-flex>
                </v-layout>
              </div>
              <div v-else>
                <v-list-tile v-if="notification.read_at == null" class="white">
                  <a
                    @click="showOrderDetail(notification.id,$event,i,notification.data.booking.id)"
                    @contextmenu="showOrderDetail(notification.id,$event,i,notification.data.booking.id)"
                    :href="'order?hotelId='+hotelId"
                  >
                    <v-list-tile-content>
                      <v-list-tile-title>
                        <h5>Đơn đặt phòng mới</h5>
                      </v-list-tile-title>
                      <v-list-tile-sub-title>Đơn {{notification.data.booking.id}} đang chờ bạn xác nhận</v-list-tile-sub-title>
                    </v-list-tile-content>
                  </a>
                </v-list-tile>
                <v-list-tile v-else class="light-grey">
                  <a
                    @click="showOrderDetail(notification.id,$event,i,notification.data.booking.id)"
                    @contextmenu="showOrderDetail(notification.id,$event,i,notification.data.booking.id)"
                    :href="'order?hotelId='+hotelId"
                  >
                    <v-list-tile-content>
                      <v-list-tile-title>
                        <h5>Đơn đặt phòng mới</h5>
                      </v-list-tile-title>
                      <v-list-tile-sub-title>Đơn {{notification.data.booking.id}} đang chờ bạn xác nhận</v-list-tile-sub-title>
                    </v-list-tile-content>
                  </a>
                </v-list-tile>
                <v-divider></v-divider>
              </div>
            </div>

            <!-- </v-list-group> -->
            <!-- <span v-if="notification.read_at === null">
              <a
                @click="showOrderDetail(notification.id,$event)"
                @contextmenu="showOrderDetail(notification.id,$event)"
                :href="'order?hotelId='+hotelId"
                class="red"
              >
                <v-list-tile-title class="red">
                  <h5>Đơn đặt phòng mới</h5>
                </v-list-tile-title>
                <v-list-tile-title class="red">Đơn {{notification.data.booking.id}} đang chờ bạn xác nhận</v-list-tile-title>
                <v-divider></v-divider>
              </a>
            </span>
            <span v-else>
              "doc roi"
              <a
                @click="showOrderDetail(notification.id,$event)"
                @contextmenu="showOrderDetail(notification.id,$event)"
                :href="'order?hotelId='+hotelId"
                class="blue"
              >
                <v-list-tile-title>
                  <h5>Đơn đặt phòng mới</h5>
                </v-list-tile-title>
                <v-list-tile-title>Đơn {{notification.data.booking.id}} đang chờ bạn xác nhận</v-list-tile-title>
                <v-divider></v-divider>
              </a>
            </span>-->
          </v-list>
        </v-flex>
        <!-- <v-flex md12 v-else>
          <div class="text-md-center">
            <span class="font-italic black--text caption">Không có thông báo...</span>
          </div>
        </v-flex>-->

        <v-flex></v-flex>
      </v-layout>
    </v-navigation-drawer>
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
          v-bind:errorMessage="errorMessage"
          v-on:changeArrayHotel="update($event)"
          v-on:chooseHotel="chooseHotel($event)"
          v-on:onErrorMessage="onErrorMessage($event)"
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
        { icon: "home", color: "black", title: "Trang chủ" },
        { icon: "business", color: "black", title: "Quản lý phòng" },
        { icon: "grade", color: "black", title: "Quản lý dịch vụ" },
        { icon: "grade", color: "black", title: "Quản lý đơn" },
        { icon: "monetization_on", color: "brown", title: "Khuyến Mãi" },
        { icon: "message", color: "purple", title: "Khách hàng hỏi" }
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
      hotelId: this.$route.query.hotelId,
      hotelName: "",
      hotel_stars_num: 2,
      currentProperties: "",
      showMenu: false,
      api_token: "",
      notifications: {
        // kind: [
        //   "Đã bình luận", //index 0
        //   "Đang theo dõi bạn" //index 1
        // ],
        data: {
          booking: null
        },
        state: false,
        list: []
      },
      errorMessage: null
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
    },
    hotelId: function() {
      axios
        .get("http://localhost:8000/api/manager/notification", {
          headers: {
            Authorization: "Bearer " + this.api_token
          },
          params: {
            hotelId: this.hotelId
          }
        })
        .then(response => {
          console.log(response.data);
          console.log(this.notifications.list);
          this.notifications.list = response.data;
          console.log(this.notifications.list);
        })
        .catch(function(error) {
          console.log(error.response);
          if (error.response.status == 401) {
            _this.logout();
          }
        });
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
    // route : function(){
  },
  mounted() {
    // window.Echo.channel("manager").listen(".accept-booking", e => {
    //   console.log(e);
    // });
    window.Echo.channel("manager").listen(".new-booking", e => {
      this.notifications.list.push(e);
    });
    window.Echo.channel("manager").listen(".accept-booking", e => {
      // alert(e.message);
      // this.notifications.list.push(e);
      console.log(e);
    });
  },
  watch: {
    arrayHotel: function() {
      var validHotel = [];
      console.log(this.arrayHotel);
      this.arrayHotel.forEach(element => {
        validHotel.push(element.id.toString());
      });
      if (validHotel.includes(this.hotelId) == false) {
        document.location.href = "login";
      }
    }
  },
  methods: {
    showOrderDetail: function(notificationId, $event, index, bookingId) {
      axios({
        method: "post",
        url: "http://localhost:8000/api/manager/mark-as-read",
        headers: {
          Authorization: "Bearer " + this.api_token
        },
        data: {
          notificationId: notificationId
        }
      })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error.response);
        });
      $event.preventDefault();
      this.notifications.list[index].read_at = new Date();
      this.$router.push({
        name: "order",
        query: { hotelId: this.hotelId, orderId: bookingId }
      });
    },
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
          console.log(error.response);
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
      if (this.hotelId != 0) {
        axios
          .get("http://localhost:8000/api/manager/notification", {
            headers: {
              Authorization: "Bearer " + this.api_token
            },
            params: {
              hotelId: this.hotelId
            }
          })
          .then(response => {
            console.log(response.data);
            this.notifications.list = response.data;
          })
          .catch(function(error) {
            console.log(error.response);
            if (error.response.status == 401) {
              _this.logout();
            }
          });
      }
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
    },
    onErrorMessage: function(message) {
      this.errorMessage = message;
    }
  }
};
</script>
<style scoped>
.noti-margin-top {
  margin-top: 70px !important;
}
</style>
