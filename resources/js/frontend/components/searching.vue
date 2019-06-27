<template>
  <v-layout row wrap>
    <v-flex shrink md12>
      <v-layout class="top-search" row wrap justify-center align-center>
        <input class="search-input" style="width:250px;" type="text" v-model="placeVal">
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
            >
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
            >
          </template>
          <v-date-picker light no-title scrollable v-model="checkOutVal">
            <v-spacer></v-spacer>
            <v-btn flat @click="mn.menu1 = false">Cancel</v-btn>
            <v-btn flat @click="$refs.checkOut.save(checkOutVal)">OK</v-btn>
          </v-date-picker>
        </v-menu>
        <v-btn color="teal" dark icon depressed style="width:30px; height:30px;" v-on:click=";">
          <v-icon small>search</v-icon>
        </v-btn>
      </v-layout>
    </v-flex>
    <v-flex md4>
      <div class="right-search">
        <v-card dark flat>
          <v-card-text>
            <v-card flat>
              <v-card-title>
                <h5>Star rating</h5>
              </v-card-title>
              <v-card-text>
                <v-layout row v-for="i in number" :key="i" justify-center align-center>
                  <v-flex md1 offset-md1 class="pt-3">
                    <v-checkbox
                      class="custom-checkbox"
                      type="checkbox"
                      v-model="stars[i]"
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
              <v-card-title>
                <h5>Location</h5>
              </v-card-title>
              <v-card-text>
                <v-layout row v-for="i in number" :key="i" justify-center align-center>
                  <v-flex md1 offset-md1 class="pt-3">
                    <v-checkbox
                      class="custom-checkbox"
                      type="checkbox"
                      v-model="stars[i]"
                      height="1"
                    ></v-checkbox>
                  </v-flex>
                  <v-flex md10>
                    <div @click="chooseStar(i)">
                      <span>district x</span>
                    </div>
                  </v-flex>
                </v-layout>
              </v-card-text>
            </v-card>
            <!-- <v-layout wrap>
                <v-flex md12>
                  <h4>Stars</h4>
                </v-flex>
                <v-flex md12>asd</v-flex>
              </v-layout>
            <v-divider></v-divider>-->
          </v-card-text>
        </v-card>
      </div>
    </v-flex>
    <v-flex md8>
      <div class="container-search">
        <v-card light flat tile>
          <v-layout
            class="search-item"
            v-for="(hotel,index) in data"
            :key="index"
            v-on:click="detailOf(hotel)"
          >
            <v-flex xs3>
              <v-img :aspect-ratio="4/3" src="/blog/img/slider/default.png"></v-img>
            </v-flex>
            <v-flex xs9>
              <v-card-title primary-title>
                <div>
                  <div class="headline">{{hotel.item.name}}</div>
                  <div>{{hotel.item.description}}</div>
                </div>
              </v-card-title>
            </v-flex>
          </v-layout>
        </v-card>
      </div>
    </v-flex>
    <v-dialog
      v-model="dialog.state"
      fullscreen
      hide-overlay
      transition="dialog-bottom-transition"
      scrollable
    >
      <v-card tile light>
        <v-toolbar card flat dark color="teal">
          <v-btn icon dark v-on:click="dialog.state = false">
            <v-icon>close</v-icon>
          </v-btn>
          <v-toolbar-title class="text-uppercase">{{dialog.data.item.name}}</v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text class="py-0">
          <v-layout row wrap>
            <v-flex md3 class="px-3">
              <v-img :aspect-ratio="4/3" src="/blog/img/slider/default.png" class="my-2">
                <v-layout row wrap justify-center align-center fill-height>
                  <v-flex md10>
                    <v-rating
                      v-model="dialog.data.item.stars_num"
                      color="#fff200"
                      background-color="grey darken-1"
                      empty-icon="$vuetify.icons.ratingFull"
                      half-incrementss
                      readonly
                      small
                    ></v-rating>
                  </v-flex>
                </v-layout>
              </v-img>
              <v-layout row wrap class="hotel-info-item" align-center>
                <v-flex md1>
                  <i class="fas fa-thumbs-up teal--text fa-lg"></i>
                </v-flex>
                <v-flex md4>
                  <span class="font-weight-black">Review Points:</span>
                </v-flex>
                <v-flex md7 class="pl-2">
                  <span class="font-weight-black">{{dialog.data.item.review_point}}</span>
                </v-flex>
              </v-layout>
              <v-layout row wrap class="hotel-info-item" align-center>
                <v-flex md1>
                  <i class="fas fa-phone teal--text fa-lg"></i>
                </v-flex>
                <v-flex md4>
                  <span class="font-weight-black">Phone Number:</span>
                </v-flex>
                <v-flex md7 class="pl-2">
                  <span class="font-weight-black">{{dialog.data.item.phone_number}}</span>
                </v-flex>
              </v-layout>
              <v-layout row wrap class="hotel-info-item" align-center>
                <v-flex md1>
                  <i class="fas fa-envelope teal--text fa-lg"></i>
                </v-flex>
                <v-flex md4>
                  <span class="font-weight-black">Email:</span>
                </v-flex>
                <v-flex md7 class="pl-2">
                  <span class="font-weight-black">xxx@gmail.com</span>
                </v-flex>
              </v-layout>
              <v-layout row wrap class="hotel-info-item" align-center>
                <v-flex md1>
                  <i class="fas fa-fax teal--text fa-lg"></i>
                </v-flex>
                <v-flex md4>
                  <span class="font-weight-black">Fax Number:</span>
                </v-flex>
                <v-flex md7 class="pl-2">
                  <span class="font-weight-black">{{dialog.data.item.fax_number}}</span>
                </v-flex>
              </v-layout>
              <v-layout row wrap class="hotel-info-item" align-center>
                <v-flex md1>
                  <i class="fas fa-dollar-sign teal--text fa-lg"></i>
                </v-flex>
                <v-flex md4>
                  <span class="font-weight-black">Tax Code:</span>
                </v-flex>
                <v-flex md7 class="pl-2">
                  <span class="font-weight-black">{{dialog.data.item.tax_code}}</span>
                </v-flex>
              </v-layout>
              <v-layout row wrap class="hotel-info-item" align-center>
                <v-flex md1>
                  <i class="fas fa-map-marker-alt teal--text fa-lg"></i>
                </v-flex>
                <v-flex md4>
                  <span class="font-weight-black">Address:</span>
                </v-flex>
                <v-flex md7 class="pl-2">
                  <span class="font-weight-black">tp Ho Chi Minh</span>
                </v-flex>
              </v-layout>
              <v-btn depressed dark>follow</v-btn>
            </v-flex>
            <v-flex md9 class="pa-3">
              <v-tabs centered grow color="grey lighten-2" light class="ma-1">
                <v-tabs-slider color="black"></v-tabs-slider>
                <v-tab href="#tab-1">rooms</v-tab>
                <v-tab href="#tab-2">description</v-tab>
                <v-tab href="#tab-3">map</v-tab>
                <v-tab-item value="tab-2">
                  <v-card light flat tile>
                    <v-layout row wrap class="hotel-tab">
                      <v-flex md12>
                        <v-card-title>
                          <div>
                            <div
                              class="subheading font-weight-bold"
                            >{{dialog.data.item.description}}</div>
                            <div>
                              CEO:
                              <span class="font-italic">Nguyen Tran Hoang Thang</span>
                            </div>
                          </div>
                        </v-card-title>
                        <v-card-actions>
                          <a href="https://www.instagram.com/" target="_blank">
                            <i class="fab fa-instagram fa-4x black--text mr-3"></i>
                          </a>
                          <a href="https://www.facebook.com/" target="_blank">
                            <i class="fab fa-facebook-f fa-4x black--text mr-3"></i>
                          </a>
                          <a href="https://www.youtube.com/" target="_blank">
                            <i class="fab fa-youtube fa-4x black--text mr-3"></i>
                          </a>
                          <a href="https://www.twitter.com/" target="_blank">
                            <i class="fab fa-twitter fa-4x black--text mr-3"></i>
                          </a>
                          <a href="https://plus.google.com/" target="_blank">
                            <i class="fab fa-google-plus-g fa-4x black--text mr-3"></i>
                          </a>
                        </v-card-actions>
                      </v-flex>
                      <v-flex md3 class="pa-1" v-for="(item,i) in 7" :key="i">
                        <v-img :aspect-ratio="1/1" src="/blog/img/slider/default.png"></v-img>
                      </v-flex>
                    </v-layout>
                  </v-card>
                </v-tab-item>
                <v-tab-item value="tab-3">
                  <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.9551334403727!2d106.67572371411624!3d10.7379414628408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f62a90e5dbd%3A0x674d5126513db295!2zxJDhuqFpIEjhu41jIEPDtG5nIE5naOG7hyBTw6BpIEfDsm4!5e0!3m2!1svi!2s!4v1560999432503!5m2!1svi!2s"
                    width="100%"
                    height="500"
                    frameborder="0"
                    style="border:0"
                    allowfullscreen
                  ></iframe>
                </v-tab-item>
                <v-tab-item value="tab-1">
                  <v-card light flat tile style="overflow:auto; height:490px;">
                    <v-expansion-panel class="elevation-0" expand v-model="expand">
                      <v-expansion-panel-content
                        class="search-room-content"
                        hide-actions
                        v-for="(hotel,index) in data"
                        :key="index"
                      >
                        <template v-slot:header>
                          <v-layout v-on:click="detailOf(hotel)">
                            <v-flex xs3>
                              <v-img :aspect-ratio="4/3" src="/blog/img/slider/default.png"></v-img>
                            </v-flex>
                            <v-flex xs9>
                              <v-card-title primary-title>
                                <div>
                                  <div class="headline">{{hotel.item.name}}</div>
                                  <div>{{hotel.item.description}}</div>
                                </div>
                              </v-card-title>
                            </v-flex>
                          </v-layout>
                        </template>
                        <v-layout row wrap>
                          <v-card dark>
                            <v-card-title>ABC</v-card-title>
                          </v-card>
                        </v-layout>
                      </v-expansion-panel-content>
                    </v-expansion-panel>
                  </v-card>
                </v-tab-item>
              </v-tabs>
            </v-flex>
          </v-layout>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
export default {
  props: {
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
      expand: [true],
      mn: {
        menu1: false,
        menu2: false
      },
      data: [],
      dialog: {
        state: false,
        data: {
          item: [],
          type: [],
          followers: 0
        }
      },
      placeVal: "",
      checkInVal: "",
      checkInFormattedVal: "",
      checkOutVal: "",
      checkOutFormattedVal: "",
      number: 5,
      stars: {
        1: false,
        2: false,
        3: false,
        4: false,
        5: false
      }
    };
  },
  created() {
    this.setSearchValue();
    this.getData();
    this.getDisctrict();
  },
  watch: {
    checkInVal: "loadSearchData",
    checkIn: "setSearchValue",
    checkOutVal: "loadSearchData",
    checkOut: "setSearchValue"
  },
  methods: {
    chooseStar: function(i) {
      this.stars[i] = !this.stars[i];
      console.log(this.stars);
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
      this.placeVal = this.place;
      this.checkInVal = this.checkIn;
      this.checkOutVal = this.checkOut;
      this.checkInFormattedVal = this.checkInFormatted;
      this.checkOutFormattedVal = this.checkOutFormatted;
    },
    getData: function() {
      axios({
        method: "get",
        url: "http://localhost:8000/api/hotel",
        params: {}
      }).then(res => {
        if (res.data.status) {
          this.data = res.data.data;
          return;
        }
      });
    },
    getDisctrict: function() {
      axios
        .get("http://localhost:8000/api/district",{
          params : {
            province : this.placeVal,
          }
        })
        .then(response => {
          // if (response.data.status == true) {
          console.log(response);
          // }
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    detailOf: function(val) {
      this.dialog.state = true;
      this.dialog.data = val;
      console.log(this.dialog.data.item.name);
    }
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