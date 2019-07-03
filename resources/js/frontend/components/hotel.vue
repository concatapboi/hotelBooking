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
    <v-flex shrink md3 class="detail-container">
      <span class="headline font-weight-black">{{data.name}}</span>
      <v-img :aspect-ratio="4/3" src="/blog/img/slider/default.png" class="my-2">
        <v-layout row wrap justify-center align-center fill-height>
          <v-flex md10>
            <v-rating
              v-model="data.stars_num"
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
        <v-flex md4>
          <span class="font-weight-black">Review Points:</span>
        </v-flex>
        <v-flex md7 class="pl-2">
          <span class="font-weight-black">{{data.review_point}}</span>
        </v-flex>
      </v-layout>
      <v-layout row wrap class="hotel-info-item" align-center>
        <v-flex md4>
          <span class="font-weight-black">Phone Number:</span>
        </v-flex>
        <v-flex md7 class="pl-2">
          <span class="font-weight-black">{{data.phone_number}}</span>
        </v-flex>
      </v-layout>
      <v-layout row wrap class="hotel-info-item" align-center>
        <v-flex md4>
          <span class="font-weight-black">Email:</span>
        </v-flex>
        <v-flex md7 class="pl-2">
          <span class="font-weight-black" style="word-wrap: break-word;">{{data.email}}</span>
        </v-flex>
      </v-layout>
      <v-layout row wrap class="hotel-info-item" align-center>
        <v-flex md4>
          <span class="font-weight-black">Fax Number:</span>
        </v-flex>
        <v-flex md7 class="pl-2">
          <span class="font-weight-black">{{data.fax_number}}</span>
        </v-flex>
      </v-layout>
      <v-layout row wrap class="hotel-info-item" align-center>
        <v-flex md4>
          <span class="font-weight-black">Tax Code:</span>
        </v-flex>
        <v-flex md7 class="pl-2">
          <span class="font-weight-black">{{data.tax_code}}</span>
        </v-flex>
      </v-layout>
      <v-layout row wrap class="hotel-info-item" align-center>
        <v-flex md4>
          <span class="font-weight-black">Address:</span>
        </v-flex>
        <v-flex md7 class="pl-2">
          <span class="font-weight-black" style="word-wrap: break-word;">tp Ho Chi Minh</span>
        </v-flex>
      </v-layout>
      <v-btn depressed dark v-on:click="followHotel(data.id)">follow</v-btn>
    </v-flex>
    <v-flex md9 class="detail-container">
      <v-tabs centered grow color="grey lighten-2" light class="ma-1">
        <v-tabs-slider color="black"></v-tabs-slider>
        <v-tab href="#tab-1">rooms</v-tab>
        <v-tab href="#tab-2">description</v-tab>
        <v-tab href="#tab-3">map</v-tab>
        <v-tab-item value="tab-1">
          <v-card light flat tile v-show="data.room">
            <v-layout class="search-item" row wrap v-for="(room,index) in data.room" :key="index">
              <v-flex xs3>
                <v-layout row wrap class="pl-3">
                  <v-flex class="pa-1" md12>
                    <v-img :aspect-ratio="4/3" src="/blog/img/slider/default.png"></v-img>
                  </v-flex>
                  <v-flex class="pa-1" md6>
                    <v-img :aspect-ratio="1" src="/blog/img/slider/default.png"></v-img>
                  </v-flex>
                  <v-flex class="pa-1" md6>
                    <v-img :aspect-ratio="1" src="/blog/img/slider/default.png"></v-img>
                  </v-flex>
                </v-layout>
              </v-flex>
              <v-spacer></v-spacer>
              <v-flex md6 style="border-right:1px solid #000;border-left:1px solid #000;">
                <v-card-title>
                  <div>
                    <div class="headline">{{room.room_name}}</div>
                    <div>
                      Price:&nbsp;
                      <span
                        class="red--text font-weight-bold"
                      >{{room.price.toLocaleString('en-US', {style: 'currency',currency: 'USD',})}}</span>
                    </div>
                    <div>
                      Adult:&nbsp;
                      <span class="font-weight-bold">{{room.max_adult_amount}}</span>|&nbsp;Kids:&nbsp;
                      <span class="font-weight-bold">{{room.max_child_amount}}</span>
                    </div>
                    <div>
                      Room Mode:&nbsp;
                      <span class="font-weight-bold">{{room.room_mode.name}}</span>
                    </div>
                    <div>
                      Room Type:&nbsp;
                      <span class="font-weight-bold">{{room.room_type.name}}</span>
                    </div>
                    <div>
                      Room Size:&nbsp;
                      <span class="font-weight-bold">{{room.room_size}}&nbsp;m2</span>
                    </div>
                    <div>
                      Amount:&nbsp;
                      <input
                        class="amount-room-input"
                        type="number"
                        v-model="room.bookingAmount"
                        readonly
                      >
                      <v-btn
                        small
                        class="amount-btn"
                        depressed
                        fab
                        v-on:click="room.bookingAmount++;if(room.bookingAmount>room.amount){room.bookingAmount = room.amount}"
                      >
                        <i class="fa-lg fas fa-plus"></i>
                      </v-btn>
                      <v-btn
                        small
                        class="amount-btn"
                        depressed
                        fab
                        v-on:click="room.bookingAmount--;if(room.bookingAmount<=0){room.bookingAmount = 1}"
                      >
                        <i class="fa-lg fas fa-minus"></i>
                      </v-btn>
                    </div>
                  </div>
                  <v-card-text>
                    <v-layout row wrap class="pa-0 ma-0">
                      <v-flex md6 class="service-item">
                        <div>
                          <span>Services</span>
                        </div>
                        <v-divider></v-divider>
                        <div v-for="(service,i) in room.service" :key="i">
                          <i :class="'fas fa-'+service.icon"></i>&nbsp;
                          <span>{{service.name}}</span>
                        </div>
                      </v-flex>
                      <v-flex md6 class="feature-item">
                        <div>
                          <span>Feature</span>
                        </div>
                        <v-divider></v-divider>
                        <div v-for="(feature,i) in room.feature" :key="i">
                          <span>{{feature.feature.name}}</span>
                        </div>
                      </v-flex>
                    </v-layout>
                  </v-card-text>
                </v-card-title>
              </v-flex>
              <v-flex md2 class="pt-5 pl-1">
                <v-btn depressed dark large color="teal" @click.stop="openDialog(room)">Book</v-btn>
                <div class="red--text">
                  Availability :&nbsp;
                  <span class="font-weight-bold">{{room.amount}}</span>&nbsp;room(s)
                </div>
              </v-flex>
              <!-- <v-flex md12>
                        <v-card dark>
                          <v-card-text>ABC</v-card-text>
                        </v-card>
              </v-flex>-->
            </v-layout>
          </v-card>
        </v-tab-item>
        <v-tab-item value="tab-2">
          <v-card light flat tile>
            <v-layout row wrap class="hotel-tab">
              <v-flex md12>
                <div class="pl-4">
                  <span class="font-weight-bold font-italic display-1">
                    {{data.name}}&nbsp;
                    <v-tooltip right>
                      <template v-slot:activator="{ on }">
                        <i
                          class="blue--text fas fa-check-circle"
                          v-on="on"
                          v-show="data.verified!=0"
                        ></i>
                      </template>
                      <span>verified</span>
                    </v-tooltip>
                  </span>
                  <div>
                    Your best&nbsp;
                    <a href="#" class="font-italic">{{data.hotel_type.name}}</a>&nbsp;choice!
                  </div>
                </div>
                <v-img :aspect-ratio="16/4" src="/blog/img/slider/default.png"></v-img>
                <v-card-title>
                  <div>
                    <div class="subheading">{{data.description}}</div>
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
      </v-tabs>
    </v-flex>
    <v-dialog
      v-model="bookingDialog.state"
      fullscreen
      hide-overlay
      transition="dialog-bottom-transition"
      scrollable
    >
      <v-card tile light>
        <v-toolbar card flat dark>
          <v-btn icon dark v-on:click="bookingDialog.state =false">
            <v-icon>close</v-icon>
          </v-btn>
          <v-toolbar-title class="text-uppercase">booking</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
          <v-layout row wrap justify-center class="pa-0 ma-0">
            <v-flex md3>
              <v-layout row wrap class="ml-1 pa-2 grey lighten-2">
                <v-flex md12>
                  <v-layout row wrap class="pa-0 ma-0">
                    <v-flex md12>
                      <div class="font-italic text-md-center">Room information</div>
                      <v-divider></v-divider>
                    </v-flex>
                    <v-flex md2>
                      <v-img :aspect-ratio="1" src="/blog/img/slider/default.png"></v-img>
                    </v-flex>
                    <v-flex md10 class="pa-3">
                      <div>{{data.name}} - {{data.hotel_type.name}}</div>
                    </v-flex>
                  </v-layout>
                  <v-divider></v-divider>
                </v-flex>
                <v-flex md6 class="service-item">
                  <div>
                    <span>Services</span>
                  </div>
                  <v-divider></v-divider>
                  <div v-for="(service,i) in bookingDialog.room.service" :key="i">
                    <i :class="'fas fa-'+service.icon"></i>&nbsp;
                    <span>{{service.name}}</span>
                  </div>
                </v-flex>
                <v-flex md6 class="feature-item">
                  <div>
                    <span>Feature</span>
                  </div>
                  <v-divider></v-divider>
                  <div v-for="(feature,i) in bookingDialog.room.feature" :key="i">
                    <span>{{feature.feature.name}}</span>
                  </div>
                </v-flex>
                <v-flex md12>
                  <v-divider></v-divider>
                </v-flex>
                <v-flex md4>
                  <span>Check-in:</span>
                </v-flex>
                <v-flex md8>
                  <span>{{checkInFormattedVal}}</span>
                </v-flex>
                <v-flex md4>
                  <span>Check-out:</span>
                </v-flex>
                <v-flex md8>
                  <span>{{checkOutFormattedVal}}</span>
                </v-flex>
                <v-flex md12>
                  <v-divider></v-divider>
                </v-flex>
                <v-flex md4>
                  <span>Kind Of Room:</span>
                </v-flex>
                <v-flex md8>
                  <span>{{bookingDialog.room.room_type.name}}</span>
                </v-flex>
                <v-flex md4>
                  <span>Bed(s):</span>
                </v-flex>
                <v-flex md8>
                  <div
                    v-for="(bed,i) in bookingDialog.room.room_bed_type"
                    :key="i"
                  >{{bed.amount}}x{{bed.bed_type.name}}</div>
                </v-flex>
                <v-flex md12>
                  <v-divider></v-divider>
                </v-flex>
                <v-flex md4>
                  <span>Amount Of Room:</span>
                </v-flex>
                <v-flex md8>
                  <span>{{bookingDialog.room.bookingAmount}}</span>
                </v-flex>
              </v-layout>
            </v-flex>
            <v-spacer></v-spacer>
            <v-flex md9>
              <v-layout row wrap class="py-0 my-0 px-5 mx-5">
                <v-flex md12>
                  <div>
                    <span class="headline">Booking</span>
                  </div>
                  <v-card v-show="!login.check" flat tile dark color="#2f3542">
                    <v-layout row wrap class="pa-0 ma-0">
                      <v-flex md2>
                        <v-img :aspect-ratio="1" src="/blog/img/slider/default.png"></v-img>
                      </v-flex>
                      <v-flex md10>
                        <v-card-title>
                          <div>
                            <div>Sign in now and enjoy membership privileges!</div>
                            <div>
                              <span>
                                <a href="#" class="blue--text" @click="getLogin(1)">Login</a>
                              </span>&nbsp;||&nbsp;
                              <span>
                                <a href="#" class="blue--text" @click="getLogin(0)"> Register</a>
                              </span>
                            </div>
                          </div>
                        </v-card-title>
                      </v-flex>
                    </v-layout>
                  </v-card>
                </v-flex>
                <v-window v-model="bookingDialog.step">
                  <v-window-item :value="1">
                    <v-flex md12>
                      <div>
                        <v-divider dark></v-divider>
                        <span class="headline">Your Booking' information</span>
                      </div>
                      <v-layout row wrap class="pa-0 pl-3 ma-0 booking-content-info-item">
                        <v-flex md12>
                          <div>
                            Contact name:
                            <span class="red--text">*</span>
                          </div>
                          <v-text-field
                            class="ma-2"
                            color="teal"
                            outline
                            hint="*Enter the name as shown on ID card / passport (no sign)"
                            persistent-hint
                          ></v-text-field>
                        </v-flex>
                        <v-flex md6>
                          <div>
                            Contact phone-number:
                            <span class="red--text">*</span>
                          </div>
                          <v-text-field class="ma-2" color="teal" outline></v-text-field>
                        </v-flex>
                        <v-flex md6>
                          <div>
                            Contact email:
                            <span class="red--text">*</span>
                          </div>
                          <v-text-field
                            class="ma-2"
                            color="teal"
                            outline
                            hint="*Ex: email@example.com"
                            persistent-hint
                          ></v-text-field>
                        </v-flex>
                        <v-flex md6>
                          <div>
                            Contact address:
                            <span class="red--text">*</span>
                          </div>
                          <v-textarea
                            class="ma-2"
                            color="teal"
                            outline
                            auto-grow
                            rows="2"
                            hint="*Ex: Da Kao ward, district 1, Ho Chi Minh city"
                            persistent-hint
                          ></v-textarea>
                        </v-flex>
                        <v-flex md6>
                          <div>Special request:</div>
                          <v-textarea class="ma-2" color="teal" outline auto-grow rows="3"></v-textarea>
                        </v-flex>
                      </v-layout>
                      <div>
                        <v-divider dark></v-divider>
                        <span class="headline">Price details</span>
                      </div>
                      <v-layout row wrap class="grey lighten-2 pa-3 pl-5 ma-0">
                        <v-flex md12>
                          <h2 class="font-weight-bold">{{data.name}}</h2>
                        </v-flex>
                        <v-flex md8>
                          <span>({{bookingDialog.room.bookingAmount}}x)&nbsp;{{bookingDialog.room.room_type.name}}&nbsp;{{bookingDialog.room.room_mode.name}}</span>
                        </v-flex>
                        <v-flex
                          md4
                        >{{bookingDialog.roomTotalPrice.toLocaleString('en-US', {style: 'currency',currency: 'USD',})}}</v-flex>
                        <v-flex md12>
                          <v-divider></v-divider>
                        </v-flex>
                        <v-flex md8>
                          <span>Total price</span>
                        </v-flex>
                        <v-flex
                          md4
                        >{{bookingDialog.totalPrice.toLocaleString('en-US', {style: 'currency',currency: 'USD',})}}</v-flex>
                      </v-layout>
                    </v-flex>
                  </v-window-item>

                  <v-window-item :value="2">
                    <v-flex md12>
                      <div>
                        <v-divider dark></v-divider>
                        <span class="headline">Payment methods!</span>
                      </div>
                      <v-layout row wrap class="pa-0 ma-0"></v-layout>
                    </v-flex>
                  </v-window-item>
                  <v-window-item :value="3">
                    <v-flex md12>
                      <div>
                        <v-divider dark></v-divider>
                        <span class="headline">Your booking application!</span>
                      </div>
                      <v-layout row wrap class="pa-0 ma-0"></v-layout>
                    </v-flex>
                  </v-window-item>
                </v-window>
                <v-flex md12>
                  <v-layout row wrap class="pa-5 ma-0" align-center>
                    <v-flex md6 class="text-md-left">
                      <div>
                        <v-btn
                          dark
                          color="#1dd1a1"
                          large
                          depressed
                          :disabled="bookingDialog.step === 1"
                          @click="bookingDialog.step--"
                        >
                          <i class="fa-lg fas fa-long-arrow-alt-left"></i>&nbsp;back
                        </v-btn>
                      </div>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                      <div>
                        <span
                          class="red--text"
                        >By clicking this button, you acknowledge that you have read and agree to Website's Terms &amp; Conditions and Privacy Policy.</span>
                      </div>
                      <div>
                        <v-btn
                          dark
                          color="#1dd1a1"
                          large
                          depressed
                          v-show="bookingDialog.step !== 3"
                          @click="bookingDialog.step++"
                        >
                          next&nbsp;
                          <i class="fa-lg fas fa-long-arrow-alt-right"></i>
                        </v-btn>
                        <v-btn
                          class="booking-btn"
                          dark
                          large
                          depressed
                          v-show="bookingDialog.step === 3"
                        >
                          <h1>booking</h1>
                        </v-btn>
                      </div>
                    </v-flex>
                  </v-layout>
                </v-flex>
              </v-layout>
            </v-flex>
          </v-layout>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
export default {
  $_veeValidate: {
    validator: "new"
  },
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
      bookingDialog: {
        roomTotalPrice: 0,
        totalPrice: 0,
        step: 1,
        state: false,
        room: {
          id: "",
          bookingAmount: 1,
          service: {},
          fearure: {},
          room_bed_type: {},
          room_type: {
            name: ""
          },
          room_mode: {
            name: ""
          }
        },
        dictionary: {
          attributes: {
            email: "Email Address"
          },
          custom: {
            name: {
              required: () => "Contact name can not be empty"
            },
            email: {
              required: () => "Contact email can not be empty"
            },
            phone: {
              required: () => "Contact phone-number can not be empty"
            },
            address: {
              required: () => "Contact address can not be empty"
            }
          }
        }
      },
      id: this.$route.params.id,
      data: {
        room: [],
        hotel_type: {
          name: ""
        }
      },
      // bookingAmount: {},
      mn: {
        menu1: false,
        menu2: false
      },
      placeVal: "",
      checkInVal: "",
      checkInFormattedVal: "",
      checkOutVal: "",
      checkOutFormattedVal: ""
      // place: this.$route.query.place.replace(/\-/g,' '),
      // checkIn: this.$route.query.check_in,
      // checkInFormatted: this.formatDate(this.$route.query.check_in),
      // checkOut: this.$route.query.check_out,
      // checkOutFormatted: this.formatDate(this.$route.query.check_out),
    };
  },
  mounted() {
    this.$validator.localize("en", this.bookingDialog.dictionary);
  },
  created() {
    console.log(Object.keys(this.$route.query).length);
    if (Object.keys(this.$route.query).length != 0) {
      this.placeVal = this.$route.query.place.replace(/\-/g, " ");
      this.checkInVal = this.$route.query.check_in;
      this.checkInFormattedVal = this.formatDate(this.$route.query.check_in);
      this.checkOutVal = this.$route.query.check_out;
      this.checkOutFormattedVal = this.formatDate(this.$route.query.check_out);
    } else {
      alert("null");
      this.setSearchValue();
    }
    this.getHotelDetail();
  },
  watch: {
    $route: "getHotelDetail",
    checkInVal: "loadSearchData",
    checkOutVal: "loadSearchData"
  },
  methods: {
    getHotelDetail: function() {
      axios({
        method: "get",
        url: "http://localhost:8000/api/hotel/" + this.id,
        params: {
          id: this.id
        }
      }).then(res => {
        if (res.data.status) {
          this.data = res.data.data;
          // for (var i = 0; i < res.data.data.room.length; i++) {
          //   this.bookingAmount[i] = 2;
          // }
          return;
        }
      });
    },
    loadSearchData: function() {
      this.$emit("loadSearchData", {
        place: this.placeVal,
        checkIn: this.checkInVal,
        checkOut: this.checkOutVal
      });
    },
    setSearchValue: function() {
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
    openDialog: function(room) {
      this.bookingDialog.room = room;
      this.bookingDialog.state = true;
      this.bookingDialog.roomTotalPrice = room.bookingAmount * room.price;
      this.bookingDialog.totalPrice = room.bookingAmount * room.price;
    },
    getLogin: function(val){
      this.$emit("loadLoginDialog", true,val);
    },
    getBooking: function(room, index) {
      if (!this.login.check) {
        this.getLogin(1);
        return;
      }
      alert("login r");
    },
    followHotel: function(id) {
      if (!this.login.check) {
        this.getLogin(1);
        return;
      } else {
        alert("login r");
      }
    }
  }
};
</script>

<style scoped>
.detail-container {
  margin-top: 39px !important;
}
.v-tooltip__content {
  opacity: 1 !important;
  padding: 4px !important;
  border-bottom-left-radius: 20%;
  box-shadow: none !important;
}
.v-menu__content {
  box-shadow: none !important;
}
</style>