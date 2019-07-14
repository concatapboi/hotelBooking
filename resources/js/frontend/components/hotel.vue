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
          v-on:click="getSearch"
        >
          <v-icon small>search</v-icon>
        </v-btn>
      </v-layout>
    </v-flex>
    <v-flex shrink md3 class="detail-container">
      <span class="headline font-weight-black">{{data.name}}</span>
      <v-img :aspect-ratio="4/3" :src="'/blog/img/hotel/'+data.image" class="my-2">
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
          <span class="font-weight-black" style="word-wrap: break-word;">{{data.address}}</span>
        </v-flex>
      </v-layout>
      <v-btn
        round
        v-if="data.followed == false"
        depressed
        dark
        v-on:click="followHotel(data,1)"
      >follow</v-btn>
      <v-btn round v-else depressed dark v-on:click="followHotel(data,0)">unfollow</v-btn>
    </v-flex>
    <v-flex md9 class="detail-container">
      <v-tabs centered grow color="grey lighten-2" light class="ma-1">
        <v-tabs-slider color="black"></v-tabs-slider>
        <v-tab href="#tab-1">rooms</v-tab>
        <v-tab href="#tab-2">description</v-tab>
        <v-tab href="#tab-3">guest review</v-tab>
        <v-tab href="#tab-4">guest question</v-tab>
        <v-tab-item value="tab-1">
          <v-card light flat tile v-if="data.room.length !=0">
            <v-layout class="search-item" row wrap v-for="(room,index) in data.room" :key="index">
              <v-flex xs3>
                <v-layout row wrap class="pl-3">
                  <v-flex class="pa-1" md12>
                    <v-img :aspect-ratio="4/3" :src="'/blog/img/room/'+room.image"></v-img>
                  </v-flex>
                  <v-flex class="pa-1" md6>
                    <v-img :aspect-ratio="1" :src="'/blog/img/room/'+room.images[2].image_link">
                    </v-img>
                  </v-flex>
                  <v-flex class="pa-1" md6>
                    <v-img :aspect-ratio="1" :src="'/blog/img/room/'+room.images[3].image_link">
                      <v-layout fill-height justify-center align-center>
                        <a href="#" @click="openImagesDialog(1,room)" class="red--text">More picture...</a>
                      </v-layout>
                    </v-img>
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
                      <span
                        class="font-weight-bold"
                      >{{room.max_child_amount}}&nbsp;(under&nbsp;{{data.child_age}}&nbsp;years old)</span>
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
                      <span class="font-weight-bold">{{room.room_size}}&nbsp;m²</span>
                    </div>
                    <div v-show="room.amount>0">
                      Amount:&nbsp;
                      <input
                        class="amount-room-input"
                        type="number"
                        v-model="room.bookingAmount"
                        readonly
                      />
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
                <v-btn
                  round
                  :disabled="room.amount ===0"
                  depressed
                  large
                  color="#EE5A24"
                  @click.stop="openDialog(room)"
                  class="white--text"
                >Select</v-btn>
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
          <v-card light flat tile width="100%" v-else>
            <div class="text-md-center">
              <v-icon large color="orange">fas fa-circle-notch fa-spin</v-icon>
            </div>
          </v-card>
        </v-tab-item>
        <v-tab-item value="tab-2">
          <v-card light flat tile>
            <v-layout row wrap class="hotel-tab">
              <v-flex md12>
                <v-card-title>
                  <v-layout row wrap class="pa-0 ma-2">
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
                    </v-flex>
                    <v-flex md12>
                      <v-divider></v-divider>
                    </v-flex>
                    <v-flex md12>
                      <v-layout row wrap class="pa-0 ma-0" v-if="data.images.length !=0">
                        <v-flex
                          md3
                          class="pa-1"
                          v-for="(item,i) in data.images"
                          :key="i"
                          v-show="i<=3 && i<data.images.length"
                        >
                          <v-img :aspect-ratio="1/1" :src="'/blog/img/hotel/'+item.image_link">
                            <v-layout fill-height justify-center align-center v-show="i===3">
                              <a
                                href="#"
                                @click="openImagesDialog(0,null)"
                                class="red--text"
                              >More picture...</a>
                            </v-layout>
                          </v-img>
                        </v-flex>
                      </v-layout>
                    </v-flex>
                    <v-flex md12>
                      <v-divider></v-divider>
                    </v-flex>
                    <v-flex md12>
                      <div>
                        <span class="font-weight-bold subheading">Description:</span>
                      </div>
                      <div class="pa-2 pl-3 border my-1">
                        <span style="word-wrap: break-word">{{data.description}}</span>
                      </div>
                    </v-flex>
                    <v-flex md12>
                      <v-divider></v-divider>
                    </v-flex>
                    <v-flex md12>
                      <div>
                        <span class="font-weight-bold subheading">Location Info:&nbsp;{{data.address}}</span>
                      </div>
                    </v-flex>
                    <v-flex md12>
                      <v-divider></v-divider>
                    </v-flex>
                    <v-flex md12>
                      <div>
                        <span class="font-weight-bold subheading">Services:</span>
                      </div>
                      <v-layout row wrap class="pa-0 ma-0 my-1">
                        <v-flex md2 v-for="(ser,i) in data.service" :key="i" class="pa-2 border">
                          <div class="text-md-center">
                            <div>
                              <i :class="'fa-2x fas fa-'+ser.icon"></i>
                            </div>
                            <div>
                              <span class="font-italic">{{ser.name}}</span>
                            </div>
                          </div>
                        </v-flex>
                      </v-layout>
                    </v-flex>
                    <v-flex md12>
                      <v-divider></v-divider>
                    </v-flex>
                    <v-flex md12>
                      <div>
                        <div>
                          <span class="font-weight-bold subheading">Policy:</span>
                          <span class="ml-2 font-weight-bold font-italic">{{data.policy.content}}</span>
                        </div>
                        <div class="ml-2 pl-2 border-left">
                          <div v-if="data.policy.check_in !=null">
                            <span class="font-weight-bold subheading">Check-in:&nbsp;{{data.policy.check_in}}</span>
                          </div>
                          <div v-if="data.policy.check_ !=null">
                            <span class="font-weight-bold subheading">Check-out:&nbsp;{{data.policy.check_out}}</span>
                          </div>
                          <div v-for="(p,i) in paymentMethods" :key="i">
                            <span class="font-weight-bold subheading">{{p.method.name}}&nbsp;method:</span>
                            <span class="font-weight-bold font-italic">{{p.content}}</span>
                          </div>
                        </div>
                      </div>
                    </v-flex>
                  </v-layout>
                </v-card-title>
              </v-flex>
            </v-layout>
          </v-card>
        </v-tab-item>
        <v-tab-item value="tab-3">
          <v-card light flat tile>
            <v-layout row wrap class="hotel-tab">
              <v-flex md12>
                <v-card-title>
                  <!-- <v-layout row wrap class="pa-3 ma-0">
                    <v-flex md12>
                      <div>
                        <span class="font-weight-bold subheading">Guest Comment</span>
                      </div>
                    </v-flex>
                    <v-flex md12 class="pl-2 ma-1">
                      <v-data-table hide-headers :items="review" class="elevation-0 border comment">
                        <template v-slot:items="r">
                          <td class="pa-0 ma-0">
                            <v-card flat tile width="100%">
                              <v-card-text>
                                <div>
                                  <div><span>{{r.item.title}}</span></div>
                                  <div><span>{{r.item.content}}</span></div>
                                </div>
                              </v-card-text>
                            </v-card>
                          </td>
                        </template>
                      </v-data-table>
                    </v-flex>
                    <v-flex md12>
                      <div>
                        <span class="font-weight-bold subheading">Guest Question</span>
                      </div>
                    </v-flex>
                    <v-flex md12 class="pl-2 ma-1">
                      <v-data-table hide-headers :items="review" class="elevation-0 border">
                        <template v-slot:items="r">
                          <td class="pa-0 ma-0">
                            <v-card flat tile width="100%">
                              <v-card-text>
                                <div>
                                  <div><span>{{r.item.title}}</span></div>
                                  <div><span>{{r.item.content}}</span></div>
                                </div>
                              </v-card-text>
                            </v-card>
                          </td>
                        </template>
                      </v-data-table>
                    </v-flex>
                  </v-layout>-->
                  <v-layout row wrap class="pa-3 ma-0">
                    <v-flex md12>
                      <span class="font-weight-bold subheading">Guest review</span>
                    </v-flex>
                    <v-flex md12 class="pl-2 ma-1">
                      <v-layout row wrap class="pa-0 ma-0" v-if="data.review.length !=0">
                        <v-flex md12 class="pa-2 ma-2 border" v-for="(r,i) in data.review" :key="i">
                          <v-card light flat tile class="pl-4">
                            <v-card-title class="pa-0 ma-0">
                              <v-spacer></v-spacer>
                              <i
                                v-show="r.likes >=10"
                                class="green--text fa-lg fas fa-cannabis pl-3 pr-1"
                              ></i>
                              <i
                                v-show="r.likes >=100"
                                class="grey--text fa-lg fas fa-bowling-ball pl-3 pr-1"
                              ></i>
                              <i
                                v-show="r.likes >=500"
                                class="orange--text fa-lg fas fa-award pl-3 pr-1"
                              ></i>
                            </v-card-title>
                            <v-card-text class="pa-0 ma-0">
                              <v-layout row wrap align-center class="pa-0 ma-0">
                                <v-flex md3 class="border-right pa-1 mr-2">
                                  <v-avatar size="110px" color="black">
                                    <v-avatar size="100px" color="blue">
                                      <div class="white--text text-md-center title">{{r.point}}/10</div>
                                    </v-avatar>
                                  </v-avatar>
                                </v-flex>
                                <v-flex md8>
                                  <div>
                                    <div>
                                      <v-avatar size="42px" color="black">
                                        <router-link
                                          :to="{name:'user',params:{id:r.customer.id}}"
                                          target="_blank"
                                        >
                                          <v-avatar size="40px" color="white">
                                            <img :src="r.customer.avatar.image_link" alt />
                                          </v-avatar>
                                        </router-link>
                                      </v-avatar>
                                      <span class="subheading">
                                        <router-link
                                          :to="{name:'user',params:{id:r.customer.id}}"
                                          target="_blank"
                                        >{{r.customer.name}}</router-link>
                                      </span>
                                      <span class="grey--text">&nbsp;-&nbsp;21/12/2017</span>
                                    </div>
                                    <div>
                                      <div>
                                        <span class="pl-2 headline">{{r.title}}</span>
                                      </div>
                                      <div>
                                        <span class="ml-3 pl-4 title border-left">"{{r.content}}"</span>
                                      </div>
                                    </div>
                                  </div>
                                </v-flex>
                              </v-layout>
                            </v-card-text>
                            <v-divider></v-divider>
                            <v-card-actions>
                              <i
                                @click="takeUseful(r.id)"
                                class="purple--text fa-3x far fa-thumbs-up pl-3 pr-1"
                                v-if="r.useful == true"
                              ></i>
                              <i
                                @click="takeUseful(r.id)"
                                class="blue--text fa-lg far fa-thumbs-up pl-3 pr-1"
                                v-else
                              ></i>
                              <span class="grey--text">This post is useful to you?</span>
                            </v-card-actions>
                          </v-card>
                        </v-flex>
                      </v-layout>
                      <v-layout row wrap class="pa-0 ma-0" v-else>
                        <v-flex md12 class="pa-2 ma-2 border">
                          <div class="text-md-center">
                            <span class="title text-uppercase">no reviews yet</span>
                          </div>
                        </v-flex>
                      </v-layout>
                    </v-flex>
                  </v-layout>
                </v-card-title>
              </v-flex>
            </v-layout>
          </v-card>
        </v-tab-item>
        <v-tab-item value="tab-4">
          <v-card light flat tile>
            <v-layout row wrap class="hotel-tab">
              <v-flex md12>
                <v-card-title>
                  <v-layout row wrap class="pa-3 ma-0">
                    <v-flex md12>
                      <v-layout row wrap class="pa-0 ma-0" justify-center align-center>
                        <v-flex md6 class="font-weight-bold subheading text-md-left">
                          <span>Guest question</span>
                        </v-flex>
                        <v-flex md6 class="text-md-right pr-3">
                          <v-btn
                            round
                            color="#B53471"
                            class="white--text"
                            depressed
                            @click="openQuestionDialog()"
                          >ask&nbsp;{{data.hotel_type.name}}</v-btn>
                        </v-flex>
                      </v-layout>
                    </v-flex>
                    <v-flex md12 class="pl-2 ma-1">
                      <v-layout row wrap class="pa-0 ma-0" v-if="data.question.length !=0">
                        <v-flex
                          md12
                          class="pa-2 ma-2 border"
                          v-for="(q,i) in data.question"
                          :key="i"
                        >
                          <v-card light flat tile class="pl-4">
                            <v-card-title class="pa-0 ma-0">
                              <div>
                                <div>
                                  <div>
                                    <v-avatar size="42px" color="black">
                                      <router-link
                                        :to="{name:'user',params:{id:q.customer.id}}"
                                        target="_blank"
                                      >
                                        <v-avatar size="40px" color="white">
                                          <img :src="q.customer.avatar.image_link" alt />
                                        </v-avatar>
                                      </router-link>
                                    </v-avatar>
                                    <span class="subheading">
                                      <router-link
                                        :to="{name:'user',params:{id:q.customer.id}}"
                                        target="_blank"
                                      >{{q.customer.name}}</router-link>
                                    </span>
                                    <span class="grey--text">&nbsp;-&nbsp;21/12/2017</span>
                                  </div>
                                  <div>
                                    <div>
                                      <span class="font-weight-black">{{q.title}}</span>
                                    </div>
                                    <div>
                                      <span class="pl-2 font-italic">"{{q.content}}"</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="pl-3 border-left border-warning" v-if="q.reply !=null">
                                  <div>
                                    <span class="font-weight-bold">{{data.name}}</span>
                                    <span class="grey--text">&nbsp;-&nbsp;21/12/2019</span>
                                  </div>
                                  <div class="pl-3">"{{q.reply.content}}"</div>
                                </div>
                              </div>
                            </v-card-title>
                          </v-card>
                        </v-flex>
                      </v-layout>
                      <v-layout row wrap class="pa-0 ma-0" v-else>
                        <v-flex md12 class="pa-2 ma-2 border">
                          <div class="text-md-center">
                            <span class="title text-uppercase">no questions yet</span>
                          </div>
                        </v-flex>
                      </v-layout>
                    </v-flex>
                  </v-layout>
                </v-card-title>
              </v-flex>
            </v-layout>
          </v-card>
        </v-tab-item>
      </v-tabs>
    </v-flex>
    <v-dialog
      v-model="bookingDialog.state"
      fullscreen
      hide-overlay
      transition="dialog-bottom-transition"
      scrollable
      persistent
    >
      <v-card tile light>
        <v-toolbar card flat dark>
          <v-btn icon dark v-on:click="bookingDialog.state =false">
            <v-icon>close</v-icon>
          </v-btn>
          <v-toolbar-title class="text-uppercase">
            <span class="orange--text">h</span>otel booking
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-stepper v-model="bookingDialog.step" class="pa-2">
            <v-stepper-header>
              <v-stepper-step color="#EE5A24" :complete="bookingDialog.step > 1" step="1">Step 1</v-stepper-step>
              <v-stepper-step color="#EE5A24" :complete="bookingDialog.step > 2" step="2">Step 2</v-stepper-step>
              <v-stepper-step color="#EE5A24" step="3">Step 3</v-stepper-step>
            </v-stepper-header>
          </v-stepper>
        </v-toolbar>
        <v-card-text>
          <v-layout row wrap justify-center class="pa-0 ma-0">
            <v-flex md3>
              <v-layout row wrap class="ml-1 pa-2 orange lighten-3">
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
                <v-flex md12 v-show="!login.check">
                  <div>
                    <h2 class="headline">
                      <span class="orange--text">J</span>oin Us
                    </h2>
                  </div>
                  <v-card flat tile dark color="#B53471">
                    <v-layout row wrap class="pa-0 ma-0">
                      <v-flex md2>
                        <v-img :aspect-ratio="1" src="/blog/img/slider/default.png"></v-img>
                      </v-flex>
                      <v-flex md10>
                        <v-card-title>
                          <div>
                            <div>Login and enjoy member-only benefits!</div>
                            <div>
                              <span>
                                <a href="#" class="orange--text" @click="getLogin(1)">Login</a>
                              </span>&nbsp;||&nbsp;
                              <span>
                                <a href="#" class="orange--text" @click="getLogin(0)">Register</a>
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
                        <h2 class="headline">
                          <span class="orange--text font-weight-black">Y</span>our Information
                        </h2>
                      </div>
                      <v-form ref="form" data-vv-scope="form1">
                        <v-layout row wrap class="pa-0 pl-3 ma-0 booking-content-info-item">
                          <v-flex md12>
                            <div>
                              Contact's name:
                              <span class="orange--text">*</span>
                            </div>
                            <v-text-field
                              :error-messages="errors.collect('form1.name')"
                              v-validate="'required'"
                              data-vv-name="name"
                              v-model="bookingDialog.booking.name"
                              class="ma-2"
                              color="teal"
                              outline
                              hint="*Enter the name as shown on ID card / passport (no sign)"
                              persistent-hint
                            ></v-text-field>
                          </v-flex>
                          <v-flex md6>
                            <div>
                              Contact's mobile-number:
                              <span class="orange--text">*</span>
                            </div>
                            <v-text-field
                              :error-messages="errors.collect('form1.phone')"
                              v-validate="'required'"
                              data-vv-name="phone"
                              v-model="bookingDialog.booking.phone"
                              class="ma-2"
                              color="teal"
                              outline
                            ></v-text-field>
                          </v-flex>
                          <v-flex md6>
                            <div>
                              Contact's email:
                              <span class="orange--text">*</span>
                            </div>
                            <v-text-field
                              :error-messages="errors.collect('form1.email')"
                              v-validate="'required|email'"
                              data-vv-name="email"
                              v-model="bookingDialog.booking.email"
                              class="ma-2"
                              color="teal"
                              outline
                              hint="*Ex: email@example.com"
                              persistent-hint
                            ></v-text-field>
                          </v-flex>
                          <v-flex md6>
                            <div>
                              Contact's address:
                              <span class="orange--text">*</span>
                            </div>
                            <v-textarea
                              :error-messages="errors.collect('form1.address')"
                              v-validate="'required'"
                              data-vv-name="address"
                              v-model="bookingDialog.booking.address"
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
                            <v-textarea
                              v-model="bookingDialog.booking.request"
                              class="ma-2"
                              color="teal"
                              outline
                              auto-grow
                              rows="3"
                            ></v-textarea>
                          </v-flex>
                        </v-layout>
                      </v-form>
                      <div>
                        <v-divider dark></v-divider>
                        <h2 class="headline">
                          <span class="orange--text font-weight-black">P</span>rice Details
                        </h2>
                      </div>
                      <v-layout row wrap class="grey lighten-2 pa-3 pl-5 ma-0">
                        <v-flex md12>
                          <h2 class="font-weight-bold">{{bookingDialog.room.room_name}}</h2>
                        </v-flex>
                        <v-flex md8>
                          <span>{{bookingDialog.room.room_type.name}}&nbsp;{{bookingDialog.room.room_mode.name}}</span>
                        </v-flex>
                        <v-flex
                          md4
                        >{{bookingDialog.room.price.toLocaleString('en-US', {style: 'currency',currency: 'USD',})}}</v-flex>
                        <v-flex md8>
                          <span>Amount</span>
                        </v-flex>
                        <v-flex md4>{{bookingDialog.room.bookingAmount}}</v-flex>
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
                        <h2 class="headline">
                          <span class="orange--text font-weight-black">P</span>ayment methods!
                        </h2>
                      </div>
                      <div>
                        <v-radio-group v-model="bookingDialog.payment" :mandatory="false">
                          <div v-for="(p,i) in paymentMethods" :key="i">
                            <v-radio :label="p.method.name" color="orange" :value="p.method.id"></v-radio>
                            <v-card
                              light
                              flat
                              tile
                              color="grey lighten-2"
                              v-show="bookingDialog.payment == p.method.id"
                            >
                              <v-card-title>{{p.method.name}}&nbsp;policy.</v-card-title>
                              <v-card-text>{{p.content}}</v-card-text>
                            </v-card>
                          </div>
                        </v-radio-group>
                      </div>
                    </v-flex>
                  </v-window-item>
                  <v-window-item :value="3">
                    <v-flex md12>
                      <div>
                        <h2 class="headline">
                          <span class="orange--text font-weight-black">P</span>lease Review Your Booking
                        </h2>
                      </div>
                      <div>
                        <v-divider dark></v-divider>
                        <span class="font-weight-black title">Your Information</span>
                      </div>
                      <v-layout row wrap class="pa-0 pl-3 ma-0 booking-content-info-item">
                        <v-flex md3>
                          <v-img :aspect-ratio="1" src="/blog/img/slider/default.png"></v-img>
                        </v-flex>
                        <v-flex md9>
                          <v-layout row wrap class="pa-0 pl-4 ma-0">
                            <v-flex md12>
                              <h2>{{data.name}}&nbsp;-&nbsp;{{data.hotel_type.name}}</h2>
                            </v-flex>
                            <v-flex md12>
                              <v-divider class="pa-0 ma-0"></v-divider>
                            </v-flex>
                            <v-flex md12>
                              <v-layout row wrap class="pa-0 ma-0">
                                <v-flex md6 class="pa-2">
                                  <div>
                                    <div>
                                      <span class="font-weight-bold">Check-In:</span>
                                    </div>
                                    <div>
                                      <span>{{checkInFormattedVal}}</span>
                                    </div>
                                  </div>
                                </v-flex>
                                <v-flex md6 class="pa-2">
                                  <div>
                                    <div>
                                      <span class="font-weight-bold">Check-Out:</span>
                                    </div>
                                    <div>
                                      <span>{{checkOutFormattedVal}}</span>
                                    </div>
                                  </div>
                                </v-flex>
                                <v-flex md12 class="pl-2">
                                  <span class="font-weight-bold">Guess Information</span>
                                </v-flex>
                                <v-flex md12 class="pl-2">
                                  <v-layout row wrap class="pa-0 ma-0">
                                    <v-flex md3>Name</v-flex>
                                    <v-flex md9>{{bookingDialog.booking.name}}</v-flex>
                                    <v-flex md3>Email</v-flex>
                                    <v-flex md9>{{bookingDialog.booking.email}}</v-flex>
                                    <v-flex md3>Mobile -number</v-flex>
                                    <v-flex md9>{{bookingDialog.booking.phone}}</v-flex>
                                    <v-flex md3>Address</v-flex>
                                    <v-flex md9>{{bookingDialog.booking.address}}</v-flex>
                                  </v-layout>
                                </v-flex>
                                <v-spacer></v-spacer>
                              </v-layout>
                            </v-flex>
                            <v-flex md12>
                              <v-divider></v-divider>
                            </v-flex>
                            <v-flex md12>
                              <span class="font-weight-bold">Room Details:</span>
                            </v-flex>
                            <v-flex md12>
                              <v-layout row wrap class="pa-0 ma-0">
                                <v-flex md3>Room Type:</v-flex>
                                <v-flex
                                  md9
                                >{{bookingDialog.room.room_mode.name}}&nbsp;{{bookingDialog.room.room_type.name}}</v-flex>
                                <v-flex md3>No. Of Rooms:</v-flex>
                                <v-flex md9>{{bookingDialog.room.bookingAmount}}</v-flex>
                                <v-flex md3>Special Request:</v-flex>
                                <v-flex md9>{{bookingDialog.booking.request}}</v-flex>
                              </v-layout>
                            </v-flex>
                          </v-layout>
                        </v-flex>
                      </v-layout>
                      <div>
                        <v-divider dark></v-divider>
                        <span class="font-weight-black title">Cancellation Policy</span>
                      </div>
                      <v-layout row wrap class="pa-0 pl-3 ma-0 booking-content-info-item">
                        <span>{{bookingDialog.policy}}</span>
                      </v-layout>
                      <div>
                        <v-divider dark></v-divider>
                        <span class="font-weight-black title">Price Details</span>
                      </div>
                      <v-layout row wrap class="pa-0 pl-3 ma-0 booking-content-info-item">
                        <v-flex md12>
                          <v-divider></v-divider>
                        </v-flex>
                        <v-flex md8>
                          <span>{{bookingDialog.room.room_type.name}}&nbsp;{{bookingDialog.room.room_mode.name}}</span>
                        </v-flex>
                        <v-flex
                          md4
                        >{{bookingDialog.room.price.toLocaleString('en-US', {style: 'currency',currency: 'USD',})}}</v-flex>
                        <v-flex md8>
                          <span>Amount</span>
                        </v-flex>
                        <v-flex md4>{{bookingDialog.room.bookingAmount}}</v-flex>
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
                </v-window>
                <v-flex md12>
                  <v-layout row wrap class="pa-5 ma-0" align-center>
                    <v-flex md12 class="ma-0 pa-0">
                      <span class="red--text">
                        By clicking this button, you acknowledge that you have read and agree to Website's Terms &amp; Conditions and Privacy Policy.
                        <v-checkbox
                          v-show="bookingDialog.step === 3"
                          v-model="bookingDialog.accept"
                          label="I do agree to term."
                          color="teal"
                        ></v-checkbox>
                      </span>
                    </v-flex>
                    <v-flex md6 class="text-md-left">
                      <div>
                        <v-btn
                          class="white--text"
                          color="#EE5A24"
                          large
                          depressed
                          :disabled="bookingDialog.step === 1"
                          @click="backBookingStep(bookingDialog.step)"
                        >
                          <i class="fa-lg fas fa-long-arrow-alt-left"></i>&nbsp;back
                        </v-btn>
                      </div>
                    </v-flex>
                    <v-flex md6 class="text-md-right">
                      <div>
                        <v-btn
                          class="white--text"
                          color="#EE5A24"
                          large
                          depressed
                          v-show="bookingDialog.step !== 3"
                          @click="nextBookingStep(bookingDialog.step)"
                        >
                          next&nbsp;
                          <i class="fa-lg fas fa-long-arrow-alt-right"></i>
                        </v-btn>
                        <v-btn
                          @click="getBooking"
                          :disabled="bookingDialog.accept === false"
                          class="booking-btn"
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
    <v-dialog scrollable v-model="images.dialog" width="650px">
      <v-card flat tile light>
        <v-card-text class="pa-3 ma-0">
          <v-layout row wrap class="ma-0 pa-0">
            <v-flex md10>
              <v-img :aspect-ratio="1" :src="'/blog/img/'+images.key+'/'+images.img.image_link"></v-img>
            </v-flex>
            <v-flex md2>
              <v-layout row wrap class="pa-0 ma-1">
                <v-flex md12 v-for="(img,i) in images.arr" :key="i" class="pa-1 border">
                  <v-avatar :tile="img.id !== images.img.id" size="100%">
                    <v-img
                      :aspect-ratio="1"
                      :src="'/blog/img/'+images.key+'/'+img.image_link"
                      @click="images.img = img"
                    ></v-img>
                  </v-avatar>
                </v-flex>
              </v-layout>
            </v-flex>
          </v-layout>
        </v-card-text>
      </v-card>
    </v-dialog>
    <v-dialog scrollable v-model="action.dialog" width="500px" persistent>
      <v-card flat tile light height="470px">
        <v-card-actions>
          <span class="ml-5 font-weight-bold title">Question form</span>
          <v-spacer></v-spacer>
          <div class="mr-3">
            <v-btn color="teal" depressed class="white--text" @click="sendQuestion">send</v-btn>
            <v-btn color="red" depressed class="white--text" @click="action.dialog = false">close</v-btn>
          </div>
        </v-card-actions>
        <v-divider class="pa-0 ma-0"></v-divider>
        <v-card-title class="pa-0 ma-0">
          <v-card flat width="100%" style="overflow:auto;" height="380px" class="pa-0 ma-0">
            <v-card-title>
              <v-form ref="form" data-vv-scope="form2">
                <v-layout row wrap class="pa-0 ma-0">
                  <!-- <v-flex md12 v-show="action.id ===0">
                    <v-layout row wrap class="pa-0 ma-0">
                      <v-flex md12>
                        <v-rating
                          v-model="action.data.star"
                          class="pa-0 ma-0"
                          color="#B53471"
                          background-color="#636e72"
                          empty-icon="$vuetify.icons.ratingFull"
                          half-incrementss
                          small
                        ></v-rating>
                      </v-flex>
                      <v-flex md6>
                        <v-checkbox
                          v-model="action.data.can_comment"
                          label="Public for comment"
                          color="#B53471"
                        ></v-checkbox>
                      </v-flex>
                      <v-flex md6>
                        <v-checkbox
                          v-model="action.data.notification"
                          label="Get comment' notifications"
                          color="#B53471"
                        ></v-checkbox>
                      </v-flex>
                    </v-layout>
                  </v-flex>-->
                  <v-flex md12>
                    <v-text-field
                      :error-messages="errors.collect('form2.title')"
                      data-vv-name="title"
                      v-validate="'required'"
                      v-model="action.data.title"
                      color="#B53471"
                      type="text"
                      outline
                      clearable
                      clear-icon="cancel"
                      label="Title"
                    ></v-text-field>
                  </v-flex>
                  <v-flex md12>
                    <v-textarea
                      :error-messages="errors.collect('form2.content')"
                      data-vv-name="content"
                      v-validate="'required'"
                      v-model="action.data.content"
                      color="#B53471"
                      outline
                      clearable
                      clear-icon="cancel"
                      auto-grow
                      rows="4"
                      label="Content"
                    ></v-textarea>
                  </v-flex>
                </v-layout>
              </v-form>
            </v-card-title>
            <v-card-text>
              <span
                class="caption font-italic grey--text"
              >It may take a few day that the Hotel answer your question...</span>
            </v-card-text>
          </v-card>
        </v-card-title>
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
    loginCheck: {
      type: Boolean
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
      paymentMethods:[],
      action: {
        dialog: false,
        data: {
          title: "example",
          content: "examples- examples- examples"
        }
      },
      images: {
        key: 'hotel',
        dialog: false,
        arr: [{ id: 0, image_link: "default.png" }],
        img: {
          id: 0,
          image_link: "default.png"
        }
      },
      userLogin: {},
      bookingDialog: {
        policy:"",
        payment: 1,
        accept: false,
        totalPrice: 0,
        step: 1,
        state: false,
        booking: {
          name: "",
          email: "",
          phone: "",
          address: "",
          request: ""
        },
        room: {
          id: "",
          bookingAmount: 1,
          price: 1,
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
            },
            title: {
              required: () => "Title can not be empty"
            },
            content: {
              required: () => "Content can not be empty"
            }
          }
        }
      },
      id: this.$route.params.id,
      data: {
        followed: false,
        name: "",
        room: [],
        images: [],
        image: "default.png",
        review: [],
        question: [],
        policy:{
          content:""
        },
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
    // console.log(Object.keys(this.$route.query).length);
    if (Object.keys(this.$route.query).length != 0) {
      this.placeVal = this.$route.query.place.replace(/\-/g, " ");
      this.checkInVal = this.$route.query.check_in;
      this.checkInFormattedVal = this.formatDate(this.$route.query.check_in);
      this.checkOutVal = this.$route.query.check_out;
      this.checkOutFormattedVal = this.formatDate(this.$route.query.check_out);
    } else {
      this.setSearchValue();
    }
    // this.load();
  },
  watch: {
    // $route: "load",
    // login: {
    //         handler: function(newValue) {
    //           this.load();
    //         },
    //         deep: true
    // },
    'bookingDialog.payment': function() {
      this.paymentMethods.forEach(element => {
        if(element.method.id == this.bookingDialog.payment){
          this.bookingDialog.policy = element.content;
        }
      });
    },
    loginCheck: "load",
    placeVal: "loadSearchData",
    checkInVal: "loadSearchData",
    checkOutVal: "loadSearchData"
  },
  methods: {
    load: function() {
      // console.log(localStorage.getItem("login_token"));
      if (localStorage.getItem("login_token") != null) {
        axios({
          method: "get",
          url: "http://localhost:8000/api/getUserLogin",
          headers: {
            Authorization: "Bearer " + this.login.token
          }
        })
          .then(res => {
            console.log(res.data.user);
            this.userLogin = res.data.user;
            console.log(this.userLogin.id);
            this.getHotelDetail();
          })
          .catch(error => {
            console.log(error.response);
            if (error.response.status == 401) {
              localStorage.removeItem("login_token");
              this.userLogin = {};
              this.$emit("loadLogin");
            }
          });
      } else {
        this.$emit("loadLogin");
        this.userLogin = {};
        this.getHotelDetail();
      }
    },
    getHotelDetail: function() {
      console.log(this.paymentMethods);
      axios({
        method: "get",
        url: "http://localhost:8000/api/hotel/" + this.id,
        params: {
          id: this.id,
          userID: this.userLogin.id,
          check_in: this.checkInVal,
          check_out: this.checkOutVal
        }
      })
        .then(res => {
          console.log(res.data.data);
          if (res.data.status) {
            this.data = res.data.data;
            this.paymentMethods = res.data.data.paymentMethods;
            res.data.data.paymentMethods.forEach(p=>{
              if(p.method.id==1){
                this.bookingDialog.policy = p.content;
              }
            });            
            return;
          }
        })
        .catch(error => {
          console.log(error.response);
          if (error.response.status == 401) {
            localStorage.removeItem("login_token");
            this.getLogin(1);
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
      this.bookingDialog.accept = false;
      this.bookingDialog.totalPrice = room.bookingAmount * room.price;
      this.bookingDialog.step = 1;
      this.paymentMethods.forEach(element => {
        if (element.name == "Offline") this.bookingDialog.payment = element.id;
        // console.log(element.name);
      });
      if (this.login.check) {
        this.bookingDialog.booking.name = this.login.user.name;
        this.bookingDialog.booking.email = this.login.user.email;
        this.bookingDialog.booking.phone = this.login.user.phone_number;
        this.bookingDialog.booking.address = this.login.user.customer.address;
      } else {
        this.$validator.reset();
        this.bookingDialog.booking.name = "";
        this.bookingDialog.booking.email = "";
        this.bookingDialog.booking.phone = "";
        this.bookingDialog.booking.address = "";
        this.bookingDialog.booking.request = "";
      }
    },
    backBookingStep: function(val) {
      this.bookingDialog.step--;
    },
    nextBookingStep: function(val) {
      switch (val) {
        case 1:
          this.$validator.validateAll("form1").then(valid => {
            if (valid) {
              this.bookingDialog.step++;
            }
          });
          break;
        default:
          this.bookingDialog.step++;
          break;
      }
    },
    getLogin: function(val) {
      this.$emit("loadLoginDialog", true, val);
    },
    getBooking: function() {
      axios({
        method: "post",
        url: "http://localhost:8000/api/booking",
        data: {
          booking: {
            payment: this.bookingDialog.payment,
            name: this.bookingDialog.booking.name,
            email: this.bookingDialog.booking.email,
            phone: this.bookingDialog.booking.phone,
            address: this.bookingDialog.booking.address,
            request: this.bookingDialog.booking.request,
            checkIn: this.checkIn,
            checkOut: this.checkOut,
            roomId: this.bookingDialog.room.id,
            roomAmount: this.bookingDialog.room.bookingAmount
          }
        },
        headers: {
          Authorization: "Bearer " + this.login.token
        }
      })
        .then(res => {
          console.log(res.data);
          console.log(res.data.mess);
          if (res.data.status == true) {
            console.log(res.data.booking);
            this.bookingDialog.state = false;
            this.load();
            this.$emit("loadLogin");
            this.$emit("loadBookingDetail", res.data.booking, 1);
          } else {
            console.log(res.data.mess);
          }
          this.$emit("loadSnackbar", res.data.mess);
        })
        .catch(error => {
          console.log(error.response);
          if (error.response.status == 401) {
            localStorage.removeItem("login_token");
            this.getLogin(1);
          }
        });
    },
    openQuestionDialog() {
      this.load();
      if (localStorage.getItem("login_token") == null) {
        this.$emit("loadLoginDialog", true, 1);
        return;
      }
      this.action.data.title = "";
      this.action.data.content = "";
      this.$validator.reset();
      this.action.dialog = true;
    },
    sendQuestion: function() {
      this.$validator.validateAll("form2").then(valid => {
        if (valid) {
          var flag = true;
          var $ques = {
            title: this.action.data.title,
            content: this.action.data.content,
            customer: this.login.user
          };
          console.log($ques);
          this.data.question.push($ques);
          axios({
            method: "get",
            url: "http://localhost:8000/api/question/create",
            params: {
              title: this.action.data.title,
              content: this.action.data.content,
              hotel_id: this.data.id
            },
            headers: {
              Authorization: "Bearer " + localStorage.getItem("login_token")
            }
          })
            .then(res => {
              if (res.data.status == true) {
                this.$emit("loadSnackbar", "Successfully!");
                this.$validator.reset();
              } else {
                flag = false;
                this.$emit("loadSnackbar", "Something wrong!");
              }
            })
            .catch(error => {
              flag = false;
              console.log(error.response);
              if (error.response.status == 401) {
                localStorage.removeItem("login_token");
                this.$emit("loadLoginDialog", true, 1);
                this.action.dialog = false;
                return;
              }
              this.$emit("loadSnackbar", "Something wrong!");
              return;
            });
          this.action.dialog = false;
          if (!flag) {
            alert("false");
            this.data.question.splice(this.data.question.length - 1, 1);
          }
        }
      });
    },
    followHotel: function(value, cmd) {
      var flag = true;
      if (cmd == 1) {
        this.data.followed = true;
        axios({
          method: "get",
          url: "http://localhost:8000/api/following",
          params: {
            type: 1,
            id: this.userLogin.id,
            followed: value.id
          },
          headers: {
            Authorization: "Bearer " + localStorage.getItem("login_token")
          }
        })
          .then(res => {
            console.log(res.data.data);
            if (res.data.data == null) {
              this.$emit("loadSnackbar", "Something wrong!");
              flag = false;
              return;
            }
            this.$emit("loadSnackbar", "Following " + value.name);
          })
          .catch(error => {
            flag = false;
            console.log(error.response);
            if (error.response.status == 401) {
              localStorage.removeItem("login_token");
              this.$emit("loadLoginDialog", true, 1);
              return;
            }
          });
        if (!flag) this.data.followed = false;
      } else {
        this.data.followed = false;
        axios({
          method: "get",
          url: "http://localhost:8000/api/un-following",
          params: {
            type: 1,
            id: this.userLogin.id,
            followed: value.id
          },
          headers: {
            Authorization: "Bearer " + localStorage.getItem("login_token")
          }
        })
          .then(res => {
            console.log(res.data.data);
            if (res.data.data == null) {
              this.$emit("loadSnackbar", "Something wrong!");
              return;
            }
            this.$emit("loadSnackbar", "Unfollowing " + value.name);
            flag = true;
          })
          .catch(error => {
            console.log(error.response);
            if (error.response.status == 401) {
              localStorage.removeItem("login_token");
              this.$emit("loadLoginDialog", true, 1);
              return;
            }
          });
        if (!flag) this.data.followed = true;
      }
    },
    openImagesDialog: function(val, room) {
      if(val==0){
        this.images.key = 'hotel';
      this.images.arr = this.data.images;
      this.images.img = this.data.images[0];
      }else{
        this.images.key = 'room';
        this.images.arr = room.images;
        this.images.img = room.images[0];
      }
      this.images.dialog = true;
    },
    takeUseful: function(reviewID) {
      console.log(reviewID);
      axios({
        method: "get",
        url: "http://localhost:8000/api/update-useful",
        params: {
          review_id: reviewID
        },
        headers: {
          Authorization: "Bearer " + localStorage.getItem("login_token")
        }
      })
        .then(res => {
          if (res.data.status == false) {
            this.$emit("loadSnackbar", "Something wrong!");
          }
          this.load();
        })
        .catch(error => {
          console.log(error.response);
          if (error.response.status == 401) {
            localStorage.removeItem("login_token");
            this.$emit("loadLoginDialog", true, 1);
            return;
          }
        });
    },
    getSearch: function() {
      this.$router.push({
        name: "searching",
        query: {
          place: this.place.replace(/\s/g, "-"),
          check_in: this.checkIn,
          check_out: this.checkOut
        }
      });
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
.v-stepper__header {
  height: 30px;
}
.v-stepper__step {
  width: 150px;
  padding: 0;
}
.v-stepper,
.v-stepper__header {
  box-shadow: none;
}
.theme--dark.v-stepper {
  background: none;
}
.v-stepper {
  border: 1px solid #fff;
  margin-right: 100px;
}
div.comment tbody {
  height: 400px !important;
  overflow: auto !important;
}
</style>