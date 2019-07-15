<template>
  <v-layout row wrap>
    <v-flex shrink md12>
      <v-layout class="top-search" row wrap justify-center align-center>
        <input class="search-input" style="width:250px;" type="text" v-model="placeVal" />
        <v-menu
          ref="checkIn"
          v-model="mn.menu2"
          :return-value.sync="checkInVal"
          :close-on-content-click="false"
          lazy
          transition="scale-transition"
          offset-y
          full-width
          max-width="290px"
          min-width="290px"
          :nudge-top="-10"
        >
          <template v-slot:activator="{ on }">
            <input
              class="search-input"
              type="text"
              v-model="checkInFormattedVal"
              readonly
              v-on="on"
            />
          </template>
          <v-date-picker light no-title scrollable v-model="checkInVal">
            <v-spacer></v-spacer>
            <v-btn flat v-on:click="mn.menu2 = false">Cancel</v-btn>
            <v-btn flat v-on:click="$refs.checkIn.save(checkInVal)">OK</v-btn>
          </v-date-picker>
        </v-menu>
        <v-menu
          ref="checkOut"
          v-model="mn.menu1"
          :return-value.sync="checkOutVal"
          :close-on-content-click="false"
          lazy
          transition="scale-transition"
          offset-y
          full-width
          max-width="290px"
          min-width="290px"
          :nudge-top="-10"
        >
          <template v-slot:activator="{ on }">
            <input
              class="search-input"
              type="text"
              v-model="checkOutFormattedVal"
              readonly
              v-on="on"
            />
          </template>
          <v-date-picker light no-title scrollable v-model="checkOutVal">
            <v-spacer></v-spacer>
            <v-btn flat @click="mn.menu1 = false">Cancel</v-btn>
            <v-btn flat @click="$refs.checkOut.save(checkOutVal)">OK</v-btn>
          </v-date-picker>
        </v-menu>
        <v-btn
          color="teal"
          dark
          icon
          depressed
          style="width:30px; height:30px;"
          v-on:click="reSearch()"
        >
          <v-icon small>search</v-icon>
        </v-btn>
      </v-layout>
    </v-flex>
    <v-flex md4>
      <div class="right-search">
        <v-card dark flat width="100%">
          <v-card-text>
            <v-card flat>
              <v-card-title class="pa-0 ma-0">
                <h5>Star rating</h5>
                {{starsSeleted}}
              </v-card-title>
              <v-card-text class="pa-0 ma-0">
                <v-layout row v-for="i in number" :key="i" justify-center align-center>
                  <v-flex md1 offset-md1 class="pt-3">
                    <v-checkbox
                      class="custom-checkbox"
                      type="checkbox"
                      v-model="starsSeleted"
                      :value="number+1-i"
                      height="1"
                    ></v-checkbox>
                  </v-flex>
                  <v-flex md10>
                    <div @click="chooseStar(i)">
                      <span>
                        <v-icon
                          class="pb-1 ml-2"
                          color="yellow"
                          v-for="(index) in number+1-i"
                          :key="index"
                        >star</v-icon>
                      </span>
                    </div>
                  </v-flex>
                </v-layout>
              </v-card-text>
            </v-card>
            <v-divider></v-divider>

            <v-card flat>
              <v-card-title class="pa-0 ma-0">
                <h5>Service</h5>
                {{serviceSeleted}}
              </v-card-title>
              <v-card-text class="pa-0 ma-0">
                <v-layout
                  row
                  v-for="(service,i) in arrayService"
                  :key="i"
                  justify-center
                  align-center
                >
                  <v-flex md1 offset-md1 class="pt-3">
                    <v-checkbox
                      class="custom-checkbox"
                      type="checkbox"
                      v-model="serviceSeleted"
                      :value="service.id"
                      height="1"
                    ></v-checkbox>
                  </v-flex>
                  <v-flex md10>
                    <div @click="chooseService(service.id)">
                      <span>
                        <i class="m-2 fas" :class="icon = 'fa-'+service.icon"></i>
                        {{service.name}}
                      </span>
                    </div>
                  </v-flex>
                </v-layout>
              </v-card-text>
            </v-card>
            <v-divider></v-divider>
            <v-card flat>
              <v-card-title class="pa-0 ma-0">
                <h5>Price</h5>
                <span>({{price[0].toLocaleString('en-US', {style: 'currency',currency: 'USD',})}}&nbsp;-&nbsp;{{price[1].toLocaleString('en-US', {style: 'currency',currency: 'USD',})}})</span>
              </v-card-title>
              <v-card-text class="pa-0 ma-0 mt-3">
                <v-layout row justify-center align-center>
                  <v-flex md10>
                    <v-range-slider
                      thumb-label="always"
                      always-dirty
                      v-model="price"
                      :max="priceMax"
                      :min="priceMin"
                      :step="10"
                      @end="getData"
                    ></v-range-slider>
                  </v-flex>
                  <!-- <v-flex md3 offset-md1>Min : {{priceMin}} -- Max : {{priceMax}}</v-flex> -->
                </v-layout>
              </v-card-text>
            </v-card>
            <v-divider></v-divider>
            <v-card v-if="noData == false" flat>
              <v-card-title>
                <h5>Location</h5>
                {{districtSeleted}}
              </v-card-title>
              <v-card-text class="pa-0 ma-0">
                <v-layout
                  row
                  v-for="(district,i) in arrayDistrict"
                  :key="i"
                  justify-center
                  align-center
                >
                  <v-flex md1 offset-md1 class="pt-3">
                    <v-checkbox
                      class="custom-checkbox"
                      type="checkbox"
                      v-model="districtSeleted"
                      :value="district.id"
                      height="1"
                    ></v-checkbox>
                  </v-flex>
                  <v-flex md10>
                    <div @click="chooseDistrict(district.id)">
                      <span>{{district.name}}</span>
                    </div>
                  </v-flex>
                </v-layout>
              </v-card-text>
            </v-card>
            <v-divider v-if="noData == false"></v-divider>
            <v-card flat>
              <v-card-title class="pa-0 ma-0">
                <h5>Hotel Type</h5>
                {{hotelTypeSeleted}}
              </v-card-title>
              <v-card-text class="pa-0 ma-0">
                <v-layout
                  row
                  v-for="(hotelType,i) in arrayHotelType"
                  :key="i"
                  justify-center
                  align-center
                >
                  <v-flex md1 offset-md1 class="pt-3">
                    <v-checkbox
                      class="custom-checkbox"
                      type="checkbox"
                      v-model="hotelTypeSeleted"
                      :value="hotelType.id"
                      height="1"
                    ></v-checkbox>
                  </v-flex>
                  <v-flex md10>
                    <div @click="chooseDistrict(district.id)">
                      <span>{{hotelType.name}}</span>
                    </div>
                  </v-flex>
                </v-layout>
              </v-card-text>
            </v-card>
            <v-divider></v-divider>
            <v-card flat>
              <v-card-title class="pa-0 ma-0">
                <h5>Room Type</h5>
                {{RoomTypeSeleted}}
              </v-card-title>
              <v-card-text class="pa-0 ma-0">
                <v-layout
                  row
                  v-for="(roomType,i) in arrayRoomType"
                  :key="i"
                  justify-center
                  align-center
                >
                  <v-flex md1 offset-md1 class="pt-3">
                    <v-checkbox
                      class="custom-checkbox"
                      type="checkbox"
                      v-model="RoomTypeSeleted"
                      :value="roomType.id"
                      height="1"
                    ></v-checkbox>
                  </v-flex>
                  <v-flex md10>
                    <div @click="(roomType.id)">
                      <span>{{roomType.name}}</span>
                    </div>
                  </v-flex>
                </v-layout>
              </v-card-text>
            </v-card>
          </v-card-text>
        </v-card>
      </div>
    </v-flex>
    <v-flex md8>
      <div class="container-search">
        <div v-if="loading" class="text-center">
          <v-progress-circular :size="70" :width="7" color="blue" indeterminate></v-progress-circular>
        </div>
        <div v-else>

          <v-card v-if="noData == true" light flat tile>No Data found :'(</v-card>
          <v-card v-else light flat tile>
            <v-layout class="search-item" v-for="(hotel,index) in data" :key="index">
              <v-flex xs3>
                <router-link
                  tag="a"
                  :to="{path: 'hotel/'+hotel.id, query: { place: place.replace(/\s/g,'-'), check_in : checkIn, check_out:checkOut }}"
                  target="_blank"
                >
                  <v-img :aspect-ratio="4/3" :src="'/blog/img/hotel/'+hotel.image"></v-img>
                </router-link>
              </v-flex>
              <v-flex xs9>
                <router-link
                  tag="a"
                  :to="{path: 'hotel/'+hotel.id, query: { place: place.replace(/\s/g,'-'), check_in : checkIn, check_out:checkOut }}"
                  target="_blank"
                >
                  <v-card-title>
                    <v-card flat tile width="100%">
                      <v-list two-line class="grey lighten-2">
                        <v-list-tile class="pa-0 ma-0">
                          <v-list-tile-content>
                            <div>
                              <span class="headline">{{hotel.name}}</span>
                              <v-tooltip right>
                                <template v-slot:activator="{ on }">
                                  <i
                                    class="blue--text fas fa-check-circle"
                                    v-on="on"
                                    v-show="hotel.verified!=0"
                                  ></i>
                                </template>
                                <span>verified</span>
                              </v-tooltip>
                            </div>
                            <v-list-tile-title>{{hotel.description}}</v-list-tile-title>
                          </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile>
                          <div>
                            <div>
                              Price:
                              <span>{{hotel.minPrice.toLocaleString('en-US', {style: 'currency',currency: 'USD',})}}&nbsp;-&nbsp;{{hotel.maxPrice.toLocaleString('en-US', {style: 'currency',currency: 'USD',})}}</span>
                            </div>
                          </div>
                        </v-list-tile>
                      </v-list>
                    </v-card>
                  </v-card-title>
                </router-link>
              </v-flex>
            </v-layout>
          </v-card>
        </div>
      </div>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  props: {
    login: {
      type: Object
    },
    place: {
      type: String
    },
    checkIn: {
      type: String
    },
    checkOut: {
      type: String
    },
    checkInFormatted: {
      type: String
    },
    checkOutFormatted: {
      type: String
    }
  },
  data() {
    return {
      expand: [true, true],
      mn: {
        menu1: false,
        menu2: false
      },
      data: [],
      placeVal: "",
      checkInVal: "",
      checkInFormattedVal: "",
      checkOutVal: "",
      checkOutFormattedVal: "",
      arrayDistrict: [],
      arrayService: [],
      arrayHotelType: [],
      arrayRoomType: [],
      districtSeleted: [],
      serviceSeleted: [],
      hotelTypeSeleted: [],
      RoomTypeSeleted: [],
      starsSeleted: [],
      price: [400, 100000],
      priceMin: 10,
      priceMax: 100000,
      number: 5,
      stars: {
        1: false,
        2: false,
        3: false,
        4: false,
        5: false
      },
      arrayHotel: [],
      loading: false,
      noData: false,
      firstTime: true
    };
  },
  created() {
    this.placeVal = this.$route.query.place.replace(/\-/g, " ");
    this.checkInVal = this.$route.query.check_in;
    this.checkInFormattedVal = this.formatDate(this.$route.query.check_in);
    this.checkOutVal = this.$route.query.check_out;
    this.checkOutFormattedVal = this.formatDate(this.$route.query.check_out);
    this.getData();
  },
  watch: {
    $route: "getData",
    placeVal: "loadSearchData",
    checkInVal: "loadSearchData",
    checkIn: "setSearchValue",
    checkOutVal: "loadSearchData",
    checkOut: "setSearchValue",
    starsSeleted: "getData",
    districtSeleted: "getData",
    serviceSeleted: "getData",
    hotelTypeSeleted: "getData",
    // price: "getData",
    RoomTypeSeleted: "getData",
    firstTime: function(newValue, oldValue) {
      if (oldValue != newValue) {
        this.initialize();
      }
    }
  },
  methods: {
    chooseStar: function(i) {
      this.stars[i] = !this.stars[i];
    },
    chooseDistrict: function(i) {
      this.arrayDistrict[i] = !this.arrayDistrict[i];
    },
    chooseService: function(i) {
      this.arrayService[i] = !this.arrayService[i];
    },
    loadSearchData: function() {
      this.$emit("loadSearchData", {
        place: this.placeVal,
        checkIn: this.checkInVal,
        checkInFormatted: this.checkInFormattedVal,
        checkOut: this.checkOutVal,
        checkOutFormatted: this.checkOutFormattedVal
      });
    },
    setSearchValue: function() {
      // this.placeVal = this.$route.query.place.replace(/\-/g, " ");
      // this.checkInVal = this.$route.query.check_in;
      // this.checkInFormattedVal = this.formatDate(this.$route.query.check_in);
      // this.checkOutVal = this.$route.query.check_out;
      // this.checkOutFormattedVal = this.formatDate(this.$route.query.check_out);
      this.placeVal = this.place;
      this.checkInVal = this.checkIn;
      this.checkOutVal = this.checkOut;
      this.checkInFormattedVal = this.checkInFormatted;
      this.checkOutFormattedVal = this.checkOutFormatted;
    },
    formatDate: function(date) {
      if (!date) return null;
      const [year, month, day] = date.split("-");
      return `${day}/${month}/${year}`;
    },
    reSearch: function() {
      this.$router.push({
        path: "searching",
        query: {
          place: this.place.replace(/\s/g, "-"),
          check_in: this.checkIn,
          check_out: this.checkOut
        }
      });
    },
    getData: function() {
      this.loading = true;
      axios({
        method: "get",
        url: "http://localhost:8000/api/manager/searching",
        params: {
          place: this.placeVal,
          checkIn: this.checkIn,
          checkOut: this.checkOut,
          stars: this.starsSeleted,
          service: this.serviceSeleted,
          district: this.districtSeleted,
          hotelType: this.hotelTypeSeleted,
          price: this.price,
          roomType: this.RoomTypeSeleted
        }
      })
        .then(response => {
          this.firstTime = false;
          if (response.data.status == false) {
            this.loading = false;
            this.noData = true;
          } else {
            this.loading = false;
            this.noData = false;
            console.log(response);
            this.data = response.data.data;
            this.getDisctrict();
          }
        })
        .catch(error => {
          this.loading = false;
          console.log(error.response);
        });
    },
    initialize: function() {
      this.getService();
      this.getPrice();
      this.getHotelType();
      this.getRoomType();
    },
    getDisctrict: function() {
      axios
        .get("http://localhost:8000/api/district", {
          params: {
            province: this.placeVal
          }
        })
        .then(response => {
          console.log(response);
          if (response.data.status == false) {
            this.showDistrict = false;
          } else {
            this.arrayDistrict = response.data.data;
            this.showDistrict = true;
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getService: function() {
      axios
        .get("http://localhost:8000/api/service", {
          params: {
            province: this.placeVal
          }
        })
        .then(response => {
          console.log(response);
          this.arrayService = response.data.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getPrice: function() {},
    getHotelType: function() {
      axios
        .get("http://localhost:8000/api/hotel-type", {
          params: {
            province: this.placeVal
          }
        })
        .then(response => {
          console.log(response);
          this.arrayHotelType = response.data.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getRoomType: function() {
      axios
        .get("http://localhost:8000/api/room-type", {})
        .then(response => {
          console.log(response);
          this.arrayRoomType = response.data.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    }
    // search: function() {
    //   axios
    //     .get("http://localhost:8000/api/hotel-type", {
    //       params: {
    //         province: this.placeVal
    //       }
    //     })
    //     .then(response => {
    //       this.loading = false;
    //       console.log(response);
    //     })
    //     .catch(function(error) {
    //       this.loading = false;
    //       console.log(error);
    //     });
    // }
  }
};
</script>

<style scoped>
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
.v-expansion-panel__header {
  padding: 0 !important;
  padding-top: 0 !important;
  padding-bottom: 0 !important;
  padding-right: 0 !important;
  padding-left: 0 !important;
}
.custom-checkbox {
  margin-top: 0px;
  padding-top: 0px;
}
</style>