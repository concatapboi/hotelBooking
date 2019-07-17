<template>
  <v-app>
    <v-toolbar :color="drawer.color" app fixed flat height="60px">
      <v-layout row wrap fill-height>
        <!-- <v-flex shrink md12 class="mt-2">
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
        </v-flex> -->
        <v-flex shrink md12 style="height:50px" class="mt-1">
          <v-layout row wrap class="white text-md-center" fill-height align-center>
            <v-flex md2>
              <router-link :to="{name:'home'}">
                <v-tooltip top>
                  <template v-slot:activator="{ on }">
                    <img src="/blog/./img/core-img/logo.png" v-on="on" />
                  </template>
                  <span>trang chủ</span>
                </v-tooltip>
              </router-link>
            </v-flex>
            <v-flex md2>
              <router-link :to="{name:'about'}" class="title text-uppercase">về chúng tôi</router-link>
            </v-flex>
            <v-flex md2>
              <router-link :to="{name:'contact'}" class="title text-uppercase">liên hệ</router-link>
            </v-flex>
            <v-flex md6>
              <v-btn depressed flat color="teal" v-if="!login.check" @click="dialog = true">
                <span class="title text-uppercase black--text">Đăng nhập</span>
                <i class="fas fa-arrow-right mx-3 black--text"></i>
              </v-btn>
              <v-menu bottom right nudge-top="-42px" v-if="login.check">
                <template v-slot:activator="{ on }">
                  <v-avatar size="42px" tile color="black" v-on="on">
                    <v-avatar size="40px" tile color="white">
                      <img :src="'/img/user/'+login.user.avatar.image_link" alt />
                    </v-avatar>
                  </v-avatar>
                </template>
                <v-list light class="grey lighten-4">
                  <v-list-tile class="pa-0 ma-0">
                    <div>
                      Chào!&nbsp;
                      <a href="#" class="font-italic">{{login.user.name}}</a>
                    </div>
                  </v-list-tile>
                  <v-divider class="pa-0 ma-0"></v-divider>
                  <v-list-tile tag="a" href="/community" target="_blank">
                    <v-list-tile-action>
                      <i class="fab fa-battle-net teal--text fa-lg"></i>
                    </v-list-tile-action>
                    <v-list-tile-content>Cộng Đồng</v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile tag="a" href="/community/account" target="_blank">
                    <v-list-tile-action>
                      <i class="fas fa-user-circle teal--text fa-lg"></i>
                    </v-list-tile-action>
                    <v-list-tile-content>Tài Khoản</v-list-tile-content>
                  </v-list-tile>
                  <v-list-tile tag="a" href="/community/booking-list" target="_blank">
                    <v-list-tile-action>
                      <i class="fas fa-list-ol teal--text fa-lg"></i>
                    </v-list-tile-action>
                    <v-list-tile-content>Danh Sách Đơn</v-list-tile-content>
                  </v-list-tile>
                  <!-- <v-list-tile tag="a" @click="openQuestionListDialog">
                    <v-list-tile-action>
                      <i class="fas fa-question teal--text fa-lg"></i>
                    </v-list-tile-action>
                    <v-list-tile-content>Question List</v-list-tile-content>
                  </v-list-tile>
                  <v-divider></v-divider>
                  <v-list-tile>
                    <v-btn dark depressed color="teal" large @click="logOut">
                      <i class="fas fa-sign-out-alt mx-2"></i>Đăng Xuất
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
    <v-content class="pa-0" style="margin-top:70px;">
      <v-container fluid class="white my-0 py-0">
        <transition name="moveInUp">
          <router-view
            :paymentMethods="paymentMethods"
            :loginDialog="dialog"
            v-on:loadLoginDialog="eventDialog"
            :login="login"
            :loginCheck="loginCheck"
            :snackbar="snackbar"
            v-on:loadSnackbar="eventSnackbar"
            :place="place"
            :checkIn="checkIn"
            :checkOut="checkOut"
            :checkInFormatted="checkInFormatted"
            :checkOutFormatted="checkOutFormatted"
            v-on:loadSearchData="eventSearch"
            v-on:loadLogin="getLogin"
            v-on:loadBookingDetail="bookingAction"
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
            <v-card-title class="title text-uppercase font-weight-bold">Đăng Nhập</v-card-title>
            <v-card-text>
              Chưa Có Tài Khoản?
              <span
                @click="registerDialog = true; dialog = false"
                class="pointer red--text"
              >Đăng Ký!</span>
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
              <v-btn color="teal" v-on:click="submitLogin" dark depressed>Đăng Nhập</v-btn>
              <v-btn color="grey" v-on:click="clear" dark depressed>Xóa</v-btn>
              <v-btn color="red" v-on:click="dialog=false" dark depressed>Hủy</v-btn>
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
              <span class="title red--text text-uppercase">Đăng Ký</span>
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
                label="Mật khẩu"
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
                label="Mật khẩu"
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
                label="Nhập lại mật khẩu"
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
                label="Nhập lại mật khẩu"
                append-icon="visibility_off"
                v-on:click:append="register.value1=false"
                v-else
              ></v-text-field>
            </v-flex>
            <v-flex md5 class="ma-3">
              <v-text-field color="teal" type="text" outline v-model="register.name" label="Họ tên"></v-text-field>
              <v-text-field
                color="teal"
                type="text"
                outline
                v-model="register.phone"
                label="Số điện thoại"
              ></v-text-field>
              <v-textarea
                color="teal"
                outline
                auto-grow
                rows="1"
                v-model="register.address"
                label="Địa chỉ"
              ></v-textarea>
            </v-flex>
            <v-flex class="text-md-center">
              <v-btn color="teal" v-on:click="submitRegister" dark depressed>Đăng Ký</v-btn>
              <v-btn color="grey" v-on:click="clear" dark depressed>Xóa</v-btn>
              <v-btn color="red" v-on:click="registerDialog = false" dark depressed>Hủy</v-btn>
            </v-flex>
          </v-layout>
        </v-form>
      </v-layout>
    </v-dialog>
    <v-dialog v-model="bookingList.dialog" width="700px" persistent>
      <v-card flat tile light height="470px">
        <v-card-text>
          <v-btn depressed color="red" dark v-on:click="bookingList.dialog = false">
            <span class="text-uppercase">Đóng</span>
          </v-btn>
          <v-card light flat width="100%" height="370px" style="overflow:auto">
            <v-data-table
              :rows-per-page-items='[3,6,9,{"text":"$vuetify.dataIterator.rowsPerPageAll","value":-1}]'
              :headers="tblHeaders.booking"
              :items="login.user.booking"
              class="elevation-0 border"
            >
            <template v-slot:items="b">
                <td>
                  <a href="#">
                    <span style="word-wrap: break-word;">{{ b.item.id }}</span>
                  </a>
                </td>
                <td class="border-left">
                  <a href="#">
                    <span
                      style="word-wrap: break-word;"
                    >{{ (b.item.room_amount*b.item.room_price).toLocaleString('vi', {style: 'currency',currency: 'VND',})}}</span>
                  </a>
                </td>
                <td class="border-left">
                  <a href="#">
                    <span style="word-wrap: break-word;">{{ b.item.status.name}}</span>
                  </a>
                </td>
                <td class="border-left">
                  <div><a href="#">
                    <span style="word-wrap: break-word;">{{formatDate(b.item.check_in)}}</span>
                  </a></div>
                  <div><a href="#">
                    <span style="word-wrap: break-word;">{{formatDate(b.item.check_out)}}</span>
                  </a></div>
                </td>
                <td class="border-left">
                  <v-btn depressed color="teal" dark small @click="bookingAction(b.item,1)">Xem chi tiết</v-btn>
                  <v-btn
                    :disabled="!b.item.cancel_status"
                    depressed
                    color="orange"
                    small
                    @click="confirmAction(b.item)"
                  >Hủy</v-btn>
                </td>
              </template>
              <!-- <template v-slot:items="b">
                <td>
                  <a href="#"><span style="word-wrap: break-word;">{{ b.item.id }}</span></a>
                </td>
                <td class="border-left">
                  <a href="#"><span
                    style="word-wrap: break-word;"
                  >{{ (b.item.room_amount*b.item.room_price).toLocaleString('vi', {style: 'currency',currency: 'VND',})}}</span></a>
                </td>
                <td class="border-left">
                  <a href="#"><span style="word-wrap: break-word;">{{ b.item.status.name}}</span></a>
                </td>
                <td class="border-left">
                  <v-btn depressed color="teal" dark small @click="bookingAction(b.item,1)">detail</v-btn>
                  <v-btn
                    :disabled="!b.item.cancel_status.includes(b.item.status.id)"
                    depressed
                    color="orange"
                    small
                    @click="confirmAction(b.item)"
                  >cancel</v-btn>
                </td>
              </template> -->
            </v-data-table>
          </v-card>
        </v-card-text>
      </v-card>
    </v-dialog>
    <v-dialog v-model="bookingList.detail.dialog" width="750px" persistent="">
      <v-card flat tile light>
        <v-layout class="pa-5 ma-0" row wrap>
          <v-flex md>
            <div>
              <span
                class="font-weight-black title text-uppercase"
              >Mã Đơn:&nbsp;{{bookingList.detail.booking.id}}</span>
            </div>
          </v-flex>
          <v-spacer></v-spacer>
          <v-flex>
            <div class="mr-2">
              <v-btn round color="red" dark depressed @click="bookingList.detail.dialog =false;">
                Đóng
              </v-btn>
            </div>
          </v-flex>
          <v-flex md12>
            <v-divider></v-divider>
            <div>
              <span class="font-weight-black title">Thông Tin Của Bạn</span>
            </div>
            <v-layout row wrap class="pa-0 pl-3 ma-0 booking-content-info-item">
              <v-flex md4>
                <div class="mt-3">
                  <v-img :aspect-ratio="1" :src="'/blog/img/room/'+bookingList.detail.booking.room.image"></v-img>
                </div>
              </v-flex>
              <v-flex md8>
                <v-layout row wrap class="pa-0 pl-4 ma-0">
                  <v-flex md12>
                    <router-link
                        :to="{name:'hotel',params:{id:bookingList.detail.booking.room.hotel.id}}"
                        target="_blank"
                      ><h2>{{bookingList.detail.booking.hotel_name}}</h2></router-link>
                  </v-flex>
                  <v-flex md12>
                    <div><span>{{bookingList.detail.booking.room.hotel.type}}</span></div>
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
                            <span>{{formatDate(bookingList.detail.booking.check_in)}}</span>
                          </div>
                        </div>
                      </v-flex>
                      <v-flex md6 class="pa-2">
                        <div>
                          <div>
                            <span class="font-weight-bold">Check-Out:</span>
                          </div>
                          <div>
                            <span>{{formatDate(bookingList.detail.booking.check_out)}}</span>
                          </div>
                        </div>
                      </v-flex>
                      <v-flex md12 class="pl-2">
                        <span class="font-weight-bold">Thông Tin Liên Hệ</span>
                      </v-flex>
                      <v-flex md12 class="pl-2">
                        <v-layout row wrap class="pa-0 ma-0">
                          <v-flex md5>Họ Tên</v-flex>
                          <v-flex md7>{{bookingList.detail.booking.contact_name}}</v-flex>
                          <v-flex md5>Email</v-flex>
                          <v-flex md7>{{bookingList.detail.booking.contact_email}}</v-flex>
                          <v-flex md5>Số Điện Thoại</v-flex>
                          <v-flex md7>{{bookingList.detail.booking.contact_phone}}</v-flex>
                          <v-flex md5>Địa Chỉ</v-flex>
                          <v-flex md7>{{bookingList.detail.booking.contact_address}}</v-flex>
                        </v-layout>
                      </v-flex>
                      <v-spacer></v-spacer>
                    </v-layout>
                  </v-flex>
                  <v-flex md12>
                    <v-divider></v-divider>
                  </v-flex>
                  <v-flex md12>
                    <span class="font-weight-bold">Thông Tin Phòng:</span>
                  </v-flex>
                  <v-flex md12>
                    <v-layout row wrap class="pa-0 ma-0">
                      <v-flex md3>Tên Phòng:</v-flex>
                      <v-flex md9>{{bookingList.detail.booking.room.room_name}}</v-flex>
                      <v-flex md3>Loại:</v-flex>
                      <v-flex
                        md9
                      >{{bookingList.detail.booking.room.room_mode.name}}&nbsp;{{bookingList.detail.booking.room.room_type.name}}</v-flex>
                      <v-flex md3>Số Lượng:</v-flex>
                      <v-flex md9>{{bookingList.detail.booking.room_amount}}</v-flex>
                      <v-flex md3>Yêu Cầu Đặc biệt:</v-flex>
                      <v-flex md9>{{bookingList.detail.booking.special_request}}</v-flex>
                    </v-layout>
                  </v-flex>
                </v-layout>
              </v-flex>
            </v-layout>
            <div>
              <v-divider dark></v-divider>
              <span class="font-weight-black title">Tình Trạng Đơn</span>
            </div>
            <v-layout row wrap class="pa-0 pl-3 ma-0 booking-content-info-item">
              <div>
                <div>
                  <span
                    class="font-weight-black red--text font-italic subheading"
                  >{{bookingList.detail.booking.status.name}}</span>
                </div>
                <!-- <div>
                  <v-btn
                    :disabled="!bookingList.detail.booking.cancel_status"
                    @click="confirmAction(bookingList.detail.booking)"
                    small
                    depressed
                    color="orange"
                  >cancel</v-btn>
                </div> -->
                <div>
                  <span class="font-italic">{{bookingList.detail.booking.payment_method.content}}</span>
                </div>
              </div>
            </v-layout>
            <div>
              <v-divider dark></v-divider>
              <span class="font-weight-black title">Chi Tiết Giá</span>
            </div>
            <v-layout row wrap class="pa-0 pl-3 ma-0 booking-content-info-item">
              <v-flex md12>
                <v-divider></v-divider>
              </v-flex>
              <v-flex md8>
                <span>{{bookingList.detail.booking.room.room_type.name}}&nbsp;{{bookingList.detail.booking.room.room_mode.name}}</span>
              </v-flex>
              <v-flex
                md4
              >{{bookingList.detail.booking.room_price.toLocaleString('vi', {style: 'currency',currency: 'VND',})}}</v-flex>
              <v-flex md8>
                <span>Số Lượng</span>
              </v-flex>
              <v-flex md4>{{bookingList.detail.booking.room_amount}}</v-flex>
              <v-flex md12 v-if="bookingList.detail.booking.discount_value!=0">
                <v-layout row wrap class="pa-0 ma-0">
                  <v-flex md8>
                    <span>Mã Giảm Giá</span>
                  </v-flex>
                  <v-flex md4>
                    <span>{{bookingList.detail.booking.coupon_code}}</span>
                  </v-flex>
                  <v-flex md12>
                    <div class="font-italic font-weight-black">
                      Bạn nhận được
                      <span
                        class="red--text"
                      >{{bookingList.detail.booking.discount_value}}%</span> giảm giá!
                    </div>
                  </v-flex>
                </v-layout>
              </v-flex>
              <v-flex md8>
                <span>Thanh Toán</span>
              </v-flex>
              <v-flex md4>{{bookingList.detail.booking.payment_method.name}}</v-flex>
              <v-flex md12>
                <v-divider></v-divider>
              </v-flex>
              <v-flex md8>
                <span class="headline orange--text">Tổng Giá</span>
              </v-flex>
              <v-flex
                md4
              ><span class="headline orange--text">{{(bookingList.detail.booking.room_amount*bookingList.detail.booking.room_price*((100-bookingList.detail.booking.discount_value)/100)).toLocaleString('vi', {style: 'currency',currency: 'VND',})}}
                </span>
              </v-flex>
            </v-layout>
          </v-flex>
        </v-layout>
      </v-card>
      <!-- <v-card flat tile light>
        <v-layout class="pa-5 ma-0" row wrap>
          <v-flex md12>
            <div>
              <span
                class="font-weight-black title text-uppercase"
              >booking code:&nbsp;{{bookingList.detail.booking.id}}</span>
            </div>
            <v-divider></v-divider>
            <div>
              <span class="font-weight-black title">Your Information</span>
            </div>
            <v-layout row wrap class="pa-0 pl-3 ma-0 booking-content-info-item">
              <v-flex md3>
                <v-img :aspect-ratio="1" :src="'/blog/img/room/'+bookingList.detail.booking.room.image"></v-img>
              </v-flex>
              <v-flex md9>
                <v-layout row wrap class="pa-0 pl-4 ma-0">
                  <v-flex md12>
                     <router-link
                        :to="{name:'hotel',params:{id:bookingList.detail.booking.room.hotel.id}}"
                        target="_blank"
                      >
                    <h2>{{bookingList.detail.booking.hotel_name}}</h2>
                    </router-link>
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
                            <span>{{formatDate(bookingList.detail.booking.check_in)}}</span>
                          </div>
                        </div>
                      </v-flex>
                      <v-flex md6 class="pa-2">
                        <div>
                          <div>
                            <span class="font-weight-bold">Check-Out:</span>
                          </div>
                          <div>
                            <span>{{formatDate(bookingList.detail.booking.check_out)}}</span>
                          </div>
                        </div>
                      </v-flex>
                      <v-flex md12 class="pl-2">
                        <span class="font-weight-bold">Guess Information</span>
                      </v-flex>
                      <v-flex md12 class="pl-2">
                        <v-layout row wrap class="pa-0 ma-0">
                          <v-flex md3>Name</v-flex>
                          <v-flex md9>{{bookingList.detail.booking.contact_name}}</v-flex>
                          <v-flex md3>Email</v-flex>
                          <v-flex md9>{{bookingList.detail.booking.contact_email}}</v-flex>
                          <v-flex md3>Mobile-number</v-flex>
                          <v-flex md9>{{bookingList.detail.booking.contact_phone}}</v-flex>
                          <v-flex md3>Address</v-flex>
                          <v-flex md9>{{bookingList.detail.booking.contact_address}}</v-flex>
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
                      >{{bookingList.detail.booking.room.room_mode.name}}&nbsp;{{bookingList.detail.booking.room.room_type.name}}</v-flex>
                      <v-flex md3>No. Of Rooms:</v-flex>
                      <v-flex md9>{{bookingList.detail.booking.room_amount}}</v-flex>
                      <v-flex md3>Special Request:</v-flex>
                      <v-flex md9>{{bookingList.detail.booking.special_request}}</v-flex>
                    </v-layout>
                  </v-flex>
                </v-layout>
              </v-flex>
            </v-layout>
            <div>
              <v-divider dark></v-divider>
              <span class="font-weight-black title">Status</span>
            </div>
            <v-layout row wrap class="pa-0 pl-3 ma-0 booking-content-info-item">
              <div>
                <div>
                  <span
                    class="font-weight-black red--text font-italic"
                  >{{bookingList.detail.booking.status.name}}</span>
                </div>
                <div>
                  <v-btn
                    :disabled="!bookingList.detail.booking.cancel_status.includes(bookingList.detail.booking.status.id)"
                    @click="bookingAction(bookingList.detail.booking,0)"
                    small
                    depressed
                    color="orange"
                  >cancel</v-btn>
                </div>
              </div>
            </v-layout>
            <div>
              <v-divider dark></v-divider>
              <span class="font-weight-black title">Cancellation Policy</span>
            </div>
            <v-layout row wrap class="pa-0 pl-3 ma-0 booking-content-info-item">
              <span>Id soluta temporibus sint molestias sapiente dolore beatae ratione velit blanditiis maxime sunt.</span>
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
                <span>{{bookingList.detail.booking.room.room_type.name}}&nbsp;{{bookingList.detail.booking.room.room_mode.name}}</span>
              </v-flex>
              <v-flex
                md4
              >{{bookingList.detail.booking.room.price.toLocaleString('vi', {style: 'currency',currency: 'VND',})}}</v-flex>
              <v-flex md8>
                <span>Amount</span>
              </v-flex>
              <v-flex md4>{{bookingList.detail.booking.room_amount}}</v-flex>
              <v-flex md12>
                <v-divider></v-divider>
              </v-flex>
              <v-flex md8>
                <span>Total price</span>
              </v-flex>
              <v-flex
                md4
              >{{(bookingList.detail.booking.room_amount*bookingList.detail.booking.room_price).toLocaleString('vi', {style: 'currency',currency: 'VND',})}}</v-flex>
            </v-layout>
          </v-flex>
        </v-layout>
      </v-card> -->
    </v-dialog>
    <!-- <v-dialog v-model="questionList.dialog" width="700px" persistent>
      <v-card flat tile light height="470px">
        <v-card-text>
          <v-btn depressed color="red" dark v-on:click="questionList.dialog = false">
            <span class="text-uppercase">Đóng</span>
          </v-btn>
          <v-card light flat width="100%" height="370px" style="overflow:auto">
            <v-data-table
              :rows-per-page-items='[5,10,15,{"text":"$vuetify.dataIterator.rowsPerPageAll","value":-1}]'
              :headers="tblHeaders.question"
              hide-headers
              :items="login.user.question"
              class="elevation-0 border"
            >
              <template v-slot:items="b">
                <td>
                  <a href="#"><span style="word-wrap: break-word;">{{ b.item.id }}</span></a>
                </td>
                <td class="border-left">
                  <a href="#"><span
                    style="word-wrap: break-word;"
                  >{{ (b.item.room_amount*b.item.room_price).toLocaleString('vi', {style: 'currency',currency: 'VND',})}}</span></a>
                </td>
                <td class="border-left">
                  <a href="#"><span style="word-wrap: break-word;">{{ b.item.status.name}}</span></a>
                </td>
                <td class="border-left">
                  <v-btn depressed color="teal" dark small @click="bookingAction(b.item,1)">detail</v-btn>
                  <v-btn
                    :disabled="!b.item.cancel_status.includes(b.item.status.id)"
                    depressed
                    color="orange"
                    small
                    @click="confirmAction(b.item)"
                  >cancel</v-btn>
                </td>
              </template>
            </v-data-table>
          </v-card>
        </v-card-text>
      </v-card>
    </v-dialog> -->
    <!-- <v-dialog
      persistent
      v-model="confirm.dialog"
      max-width="290"
    >
      <v-card>
        <v-card-title class="headline">{{confirm.title}}</v-card-title>

        <v-card-text>
          {{confirm.content}}
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            color="green darken-1"
            flat="flat"
            @click="confirm.dialog = false"
          >
            Cancel
          </v-btn>

          <v-btn
            color="green darken-1"
            flat="flat"
            @click="bookingAction(confirm.booking,0)"
          >
            Sure
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog> -->
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
      confirm: {
        dialog: false,
        booking: {},
        title:"Bạn có chắc chắn?",
        content:"Đồng ý thực hiện hành động này, bạn đã cam kết với chúng tôi rằng bạn đã đọc và hiểu rõ mọi điều khoản liên quan"
      },
      loginCheck:false,
      tblHeaders: {
        booking:[
          { text: "Mã", value: 'id',align: 'center', class:'red--text',sortable: true },
          { text: "Tổng Giá", value: 0,align: 'center', class:'red--text border-left',sortable: false },
          { text: "Tình Trạng Đơn", value: "status.id",align: 'center', class:'red--text border-left',sortable: true },
          { text: "Ngày", value: "check_in",align: 'center', class:'red--text border-left',sortable: true },
          { text: "Chức Năng", value: 0,align: 'center', class:'red--text border-left',sortable: false }
        ],
        question:[
          
        ]
      },
      bookingList: {
        dialog: false,
        detail: {
          dialog: false,
          booking: {
            cancel_status:[],
            status: {},
            payment_method: {},
            room_price: 0,
            room: {
              price: 0,
              room_mode: {},
              room_type: {},
              hotel:{
                id:0
              },
              image: 'default.png'
            }
          }
        }
      },
      questionList:{
        dialog: false,
      },
      time:
        new Date().getHours() +
        ":" +
        new Date().getMinutes() +
        ":" +
        new Date().getSeconds(),
      memberCount: 0,
      paymentMethods: [],
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
          avatar: {},
          booking: []
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
            required: () => "Username không được bỏ trống.",
            min: "Username phải nhiều hơn 3 ký tự"
          },
          password: {
            min: "Mật khẩu phải nhiều hơn 3 ký tự"
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
    this.getData();
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
    getData: function() {
      axios({
        method: "get",
        url: "http://localhost:8000/api/payment-method/"
      }).then(res => {
        if (res.data.status) {
          this.paymentMethods = res.data.data;
          return;
        }
      });
    },
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
            this.loginCheck = true;
          })
          .catch(error => {
            console.log(error.response);
            if (error.response.status == 401) {
              localStorage.removeItem("login_token");
              this.login.token = localStorage.getItem("login_token");
              this.login.check = false;
              this.loginCheck = false;
              this.login.user = {
                avatar: {},
                booking: []
              };
            }
          });
      } else {
        this.login.check = false;
        this.loginCheck = false;
        this.login.user = {
          avatar: {},
          booking: []
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
              this.eventSnackbar("Đã xảy ra lỗi, thử lại!");
              this.login.password = "";
              this.$validator.reset();
              return;
            }
            // this.eventSnackbar("Login successfully!");
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
            this.loginCheck = false;
            this.login.token = "";
            this.login.user = {
              avatar: {},
              booking: []
            };
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
              this.eventSnackbar("Đăng ký thành công!");
              this.login.check = true;
            } else {
              this.eventSnackbar("Đã xảy ra lỗi, thử lại!");
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
    eventDialog: function(val, num) {
      if (num == 0) {
        this.registerDialog = val;
      } else this.dialog = val;
    },
    openBookingListDialog: function() {
      this.getLogin();
      if (this.login.token != null) {
        this.bookingList.dialog = true;
      }
    },
    openQuestionListDialog: function() {
      this.getLogin();
      if (this.login.token != null) {
        this.questionList.dialog = true;
      }
    },
    confirmAction: function(booking){
      this.confirm.dialog = true;
      this.confirm.booking = booking;
      this.confirm.title = 'Bạn có chắc chắn?';
      if(booking.status.id == 4)
        this.confirm.content = "Đồng ý thực hiện hành động này, bạn đã cam kết với chúng tôi rằng bạn đã đọc và hiểu rõ mọi điều khoản liên quan.";
    },
    bookingAction: function(booking, cmd) {
      console.log(booking);
      if (cmd == 1) {
        this.bookingList.detail.booking = booking;
        this.bookingList.detail.dialog = true;
      } else {
        if(this.confirm.dialog === true) this.confirm.dialog = false;
        axios({
            method: "put",
            url: "http://localhost:8000/api/booking/"+booking.id,
            params: {
              action: 'cancel'
            },
            headers: {
            Authorization: "Bearer " + this.login.token
            }
          }).then(res=>{
            console.log(res.data.status);
            if(res.data.status){
              // this.eventSnackbar('Updated Successfully!');
              this.getLogin();
            }else{
              // this.eventSnackbar('Updated Fail!');
            }
          }).catch(error => {
            console.log(error.response);
            if (error.response.status == 401) {
              localStorage.removeItem("login_token");
              this.login.token = localStorage.getItem("login_token");
              this.login.check = false;
              this.login.user = {
                avatar: {},
                booking: []
              };
            }
          });
      }
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