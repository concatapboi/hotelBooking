<template>
  <div>
    <v-layout justify-space-around>
      <v-card flat width="23%" class="red" height="150px">
        <v-card-title>
          <v-icon class="m-2">event_note</v-icon>
          <h2>Orders</h2>
        </v-card-title>
        <v-card-text>12</v-card-text>
      </v-card>
      <v-card flat width="23%" class="orange" height="150px">
        <v-card-title>
          <v-icon class="m-2">airline_seat_individual_suite</v-icon>
          <h2>Rooms</h2>
        </v-card-title>
        <v-card-text>12</v-card-text>
      </v-card>
      <v-card flat width="23%" class="yellow" height="150px">
        <v-card-title>
          <v-icon class="m-2">loyalty</v-icon>
          <h2>Promotion</h2>
        </v-card-title>
        <v-card-text>12</v-card-text>
      </v-card>
      <v-card flat width="23%" class="green" height="150px">
        <v-card-title>
          <v-icon class="m-2">stars</v-icon>
          <h2>ETC</h2>
        </v-card-title>
        <v-card-text>12</v-card-text>
      </v-card>
    </v-layout>
    <v-layout class="m-5">
      <v-spacer></v-spacer>
      <v-dialog fullscreen scrollable v-model="dialog">
        <template v-slot:activator="{ on }">
          <v-btn
            class="primary"
            flat
            round
            depressed
            v-on="on"
            @click="addNewTitle;newHotelData.images = [];"
          >Tạo khách sạn</v-btn>
        </template>
        <v-layout row>
          <v-flex>
            <v-card width="100%" class="pa-0">
              <v-toolbar card flat color="primary">
                <v-toolbar-title class="text-uppercase">
                  <span class="text-md-center white--text">{{formTitle}}</span>
                </v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn icon dark v-on:click="dialog =false">
                  <v-icon>close</v-icon>
                </v-btn>
              </v-toolbar>
              <!-- <v-card-title class="text-xs-center px-5">
                <h1>{{formTitle}}</h1>
              </v-card-title>-->
              <v-card-text height="100px">
                <v-form ref="formNewHotel" class="px-5">
                  <h3 class="my-5">Thông tin chung</h3>
                  <v-layout row>
                    <v-text-field
                      v-validate="'required'"
                      :error-messages="errors.collect('hotelName')"
                      data-vv-name="hotelName"
                      class="pr-3"
                      label="Tên khách sạn"
                      v-model="newHotelData.name"
                      required
                      outline
                    ></v-text-field>
                    <v-select
                      v-validate="'required'"
                      :error-messages="errors.collect('hotelType')"
                      data-vv-name="hotelType"
                      class="pl-3"
                      item-text="name"
                      item-value="id"
                      :items="arrayHotelType"
                      label="Loại khách sạn"
                      v-model="defaultHotelType"
                      required
                      outline
                    ></v-select>
                  </v-layout>
                  <v-layout row align-center>
                    <b>Tiêu chuẩn khách sạn :</b>
                    <v-rating
                      v-model="newHotelData.rating"
                      hover
                      background-color="orange lighten-3"
                      color="orange"
                    ></v-rating>
                  </v-layout>
                  <v-layout row>
                    <v-textarea
                      v-validate="'required'"
                      :error-messages="errors.collect('description')"
                      data-vv-name="description"
                      label="Mô tả khách sạn"
                      v-model="newHotelData.description"
                      required
                      outline
                    ></v-textarea>
                  </v-layout>
                  <v-layout row>
                    <v-select
                      v-validate="'required'"
                      :error-messages="errors.collect('province')"
                      data-vv-name="province"
                      item-text="name"
                      :items="arrayProvince"
                      label="Tỉnh/Thành phố"
                      item-value="id"
                      v-model="defaultProvince"
                      @change="provinceSelected"
                      required
                      outline
                    ></v-select>
                    <v-select
                      v-validate="'required'"
                      :error-messages="errors.collect('district')"
                      data-vv-name="district"
                      class="px-5"
                      :items="arrayDistrict"
                      item-text="name"
                      item-value="id"
                      label="Quận/Huyện"
                      :disabled="districtDisabled"
                      v-model="defaultDistrict"
                      @change="districtSelected"
                      required
                      outline
                    ></v-select>
                    <v-select
                      v-validate="'required'"
                      :error-messages="errors.collect('ward')"
                      data-vv-name="ward"
                      :items="arrayWard"
                      item-text="name"
                      item-value="id"
                      label="Xã/Phường"
                      v-model="defaultWard"
                      :disabled="wardDisabled"
                      required
                      outline
                    ></v-select>
                  </v-layout>
                  <v-layout row>
                    <v-text-field
                      label="Địa chỉ"
                      v-validate="'required'"
                      class="pr-3"
                      :error-messages="errors.collect('address')"
                      data-vv-name="address"
                      v-model="newHotelData.address"
                      required
                      outline
                    ></v-text-field>
                    <v-text-field
                      label="Số thẻ tín dụng"
                      v-validate="'required'"
                      class="pl-3"
                      :error-messages="errors.collect('credit_card')"
                      data-vv-name="credit_card"
                      v-model="newHotelData.credit_card"
                      mask="credit-card"
                      required
                      outline
                    ></v-text-field>
                  </v-layout>
                  <v-layout row>
                    <v-text-field
                      label="Số điện thoại"
                      v-validate="'required'"
                      class="pr-3"
                      :error-messages="errors.collect('phone')"
                      data-vv-name="phone"
                      v-model="newHotelData.phone"
                      required
                      outline
                      mask="##########"
                    ></v-text-field>
                    <v-text-field
                      label="Số Fax"
                      v-validate="'required'"
                      class="pl-3"
                      :error-messages="errors.collect('fax_number')"
                      data-vv-name="fax_number"
                      v-model="newHotelData.fax_number"
                      outline
                    ></v-text-field>
                  </v-layout>
                  <v-layout row>
                    <v-text-field
                      label="Mã số thuế"
                      class="pr-3"
                      v-validate="'required'"
                      :error-messages="errors.collect('tax_code')"
                      data-vv-name="tax_code"
                      v-model="newHotelData.tax_code"
                      required
                      outline
                    ></v-text-field>
                    <v-text-field
                      label="Email"
                      class="pl-3"
                      v-validate="'required|email'"
                      :error-messages="errors.collect('email')"
                      data-vv-name="email"
                      v-model="newHotelData.email"
                      required
                      outline
                    ></v-text-field>
                  </v-layout>
                  <v-divider></v-divider>
                  <h3 class="my-5">Hình ảnh</h3>
                  <v-layout row wrap align-space-between justify-start>
                    <!-- <v-flex style="height : 200px;" v-if="images" md3> -->
                    <v-flex v-for="(image,i) in newHotelData.images" :key="i" md3>
                      <div class="img-box" v-if="image.is_primary == 1" id="primaryBox">
                        <div class="ribbon text-center">
                          <h5>PRIMARY</h5>
                        </div>
                        <div class="deleteImage">
                          <i
                            @click="deleteImage(i)"
                            class="fas fa-minus-square red--text white fa-lg"
                          ></i>
                        </div>
                        <img
                          @click="choosePrimary(i)"
                          class="primaryImage"
                          width="200px"
                          :src="image.image_link"
                          height="200px"
                        />
                      </div>
                      <div class="img-box" v-else>
                        <div class="deleteImage">
                          <i
                            @click="deleteImage(i)"
                            class="fas fa-minus-square red--text white fa-lg"
                          ></i>
                        </div>
                        <img
                          @click="choosePrimary(i)"
                          class="img"
                          width="200px"
                          :src="image.image_link"
                          height="200px"
                        />
                      </div>
                    </v-flex>
                    <v-flex md3 class="justify-center">
                      <div class="add-image">
                        <label for="file" class="fileLabel" v-ripple="{ class: `primary--text` }">
                          <v-icon color="primary">add</v-icon>
                        </label>
                        <input type="file" id="file" multiple ref="images" @change="addImage" />
                      </div>
                    </v-flex>
                  </v-layout>
                  <v-divider></v-divider>
                  <h3 class="my-5">Chính sách</h3>
                  <v-layout row>
                    <v-flex offset-md1 md3>
                      <v-menu
                        ref="checkin"
                        v-model="menuCheckin"
                        :close-on-content-click="false"
                        :nudge-right="40"
                        :return-value.sync="newHotelData.policy.checkin"
                        lazy
                        transition="scale-transition"
                        offset-y
                        full-width
                        max-width="290px"
                        min-width="290px"
                      >
                        <template v-slot:activator="{ on }">
                          <v-text-field
                            v-model="newHotelData.policy.checkin"
                            label="Check-in"
                            prepend-icon="access_time"
                            readonly
                            v-on="on"
                          ></v-text-field>
                        </template>
                        <v-time-picker
                          v-if="menuCheckin"
                          v-model="newHotelData.policy.checkin"
                          full-width
                          value="24hr hh:mm"
                          format="24hr"
                          @click:minute="$refs.checkin.save(newHotelData.policy.checkin)"
                        ></v-time-picker>
                      </v-menu>
                    </v-flex>
                    <v-flex md3>
                      <v-menu
                        ref="checkout"
                        v-model="menuCheckout"
                        :close-on-content-click="false"
                        :nudge-right="40"
                        :return-value.sync="newHotelData.policy.checkout"
                        lazy
                        transition="scale-transition"
                        offset-y
                        full-width
                        max-width="290px"
                        min-width="290px"
                      >
                        <template v-slot:activator="{ on }">
                          <v-text-field
                            v-model="newHotelData.policy.checkout"
                            label="Check-out"
                            prepend-icon="access_time"
                            readonly
                            v-on="on"
                          ></v-text-field>
                        </template>
                        <v-time-picker
                          v-if="menuCheckout"
                          v-model="newHotelData.policy.checkout"
                          full-width
                          value="24hr hh:mm"
                          format="24hr"
                          @click:minute="$refs.checkout.save(newHotelData.policy.checkout)"
                        ></v-time-picker>
                      </v-menu>
                    </v-flex>
                  </v-layout>

                  <v-layout row>
                    <v-flex offset-md1 md3>
                      <v-checkbox
                        label="Có thể hủy phòng ?"
                        v-model="newHotelData.policy.cancelable"
                        color="primary"
                      ></v-checkbox>
                    </v-flex>
                  </v-layout>
                  <v-layout>
                    <v-flex md3 offset-md1>
                      <v-text-field
                        suffix="ngày"
                        v-if="newHotelData.policy.cancelable == true"
                        label="có thể hủy trước"
                        v-model="newHotelData.policy.cancel_day"
                        mask="###"
                      ></v-text-field>
                    </v-flex>
                    <v-flex md3 offset-md1>
                      <v-text-field
                        suffix="%"
                        v-if="newHotelData.policy.cancelable == true"
                        label="% hoàn trả"
                        v-model="newHotelData.policy.refundRate"
                        mask="##"
                      ></v-text-field>
                    </v-flex>
                    <v-flex md3 offset-md1>
                      <v-select
                        outline
                        v-validate="'required'"
                        :error-messages="errors.collect('child_age')"
                        data-vv-name="child_age"
                        label="Độ tuổi xem là trẻ em"
                        :items="arrayAge"
                        item-text="text"
                        item-value="value"
                        v-model="newHotelData.child_age"
                      ></v-select>
                    </v-flex>
                  </v-layout>
                  <v-layout row>
                    <v-flex offset-md1 md11>
                      <v-textarea
                        label="Chính sách chi tiết"
                        v-model="newHotelData.policy.detailPolicy"
                        auto-grow
                        box
                      ></v-textarea>
                    </v-flex>
                  </v-layout>
                </v-form>
              </v-card-text>
              <v-card-actions class="mt-5">
                <v-spacer></v-spacer>
                <v-btn
                  v-if="formTitle != 'Sửa thông tin khách sạn'"
                  color="blue darken-1"
                  flat
                  @click="validate"
                  type="submit"
                >Create</v-btn>
                <v-btn v-else color="blue darken-1" flat @click="updateHotel" type="submit">Update</v-btn>
                <v-btn color="blue darken-1" flat @click="reset">Reset</v-btn>
                <v-btn color="blue darken-1" flat @click="cancel">Cancel</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-dialog>
      <v-snackbar
        v-model="snackbar"
        color="primary white--text"
        top
        right
        :timeout="snackbarTimeout"
        multi-line
      >
        <h4>{{snackbarText}}</h4>
      </v-snackbar>
    </v-layout>
    <v-dialog max-width="40%" v-model="confirmDialog">
      <v-card>
        <v-card-title>
          <h5>Xác nhận</h5>
        </v-card-title>
        <v-card-text v-if="bookingListCantDelete == null">{{confirmDialogText}}</v-card-text>
        <v-card-text v-else>
          Bạn không thể xóa khách sạn này vì :
          <ul>
            <li v-for="(booking,i) in bookingListCantDelete.sau" :key="i">
              {{booking.reason}} -- Đơn # {{booking.id}}
              <v-btn small depressed round @click="detailOrder(booking.id)">Chi tiết</v-btn>
            </li>
          </ul>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="grey" flat round depressed @click="cancel">Hủy</v-btn>
          <v-btn color="red" flat round depressed @click.stop="deleteHotelConfirm()">Xác nhận</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-layout class="m-5">
      <v-card width="100%" dark flat color="blue-grey darken-4" class="p-2">
        <v-expansion-panel class="elevation-0" v-model="panel" expand>
          <!-- focusable expand -->
          <h1>Khách sạn</h1>
          <v-expansion-panel-content
            hide-actions
            class="primary"
            v-for="(hotel,i) in arrayHotel"
            :key="i"
            @input="onInput($event, i)"
          >
            <template v-slot:header>
              <div>
                <v-layout>
                  <v-flex md8>
                    <h3 class="black--text">{{hotel.name}}</h3>
                  </v-flex>
                  <v-flex md4 class="text-right">
                    <!-- <v-btn icon @click.stop="editHotel(arrayHotel[i].id)">
                      <v-icon color="orange">create</v-icon>
                    </v-btn>
                    <v-btn icon @click="deleteHotel(arrayHotel[i].id)">
                      <v-icon color="red">delete</v-icon>
                    </v-btn>-->

                    <v-btn
                      class="warning"
                      flat
                      round
                      depressed
                      @click="editHotel(arrayHotel[i].id)"
                    >Sửa</v-btn>
                    <v-btn
                      class="red white--text"
                      flat
                      round
                      depressed
                      @click="deleteHotel(arrayHotel[i].id)"
                    >Xóa</v-btn>
                  </v-flex>
                </v-layout>
              </div>
            </template>
            <v-card>
              <v-card-text class="grey lighten-3 black--text">
                <v-container>
                  <span v-for="(image,index) in hotel.images" :key="index">
                    <v-parallax
                      v-if="image.is_primary == 1"
                      dark
                      height="100px"
                      :src="image.image_link"
                    >
                      <v-layout align-start justify-end column>
                        <v-flex align-self-end class="m-4">
                          <v-avatar class="yellow" size="54">
                            <v-avatar class="primary" size="50">
                              <h3 class="mt-2">{{hotel.review_point}}</h3>
                            </v-avatar>
                          </v-avatar>
                        </v-flex>
                        <h1 class="ml-2">{{hotel.name}}</h1>
                        <v-rating
                          background-color="orange lighten-3"
                          color="orange"
                          readonly
                          v-model="hotel.stars_num"
                        ></v-rating>
                        <div class="mb-3">
                          <v-icon color="pink">room</v-icon>Tp HCM
                        </div>
                      </v-layout>
                    </v-parallax>
                  </span>
                  <v-divider></v-divider>
                  <v-layout row>
                    <v-flex xs3 offset-xs1>
                      <h5>Loại khách sạn</h5>
                    </v-flex>
                    <v-flex xs8>{{hotel.hotel_type}}</v-flex>
                  </v-layout>
                  <v-layout row>
                    <v-flex xs3 offset-xs1>
                      <h5>Mô tả</h5>
                    </v-flex>
                    <v-flex xs8>{{hotel.description}}</v-flex>
                  </v-layout>
                  <v-layout row>
                    <v-flex xs3 offset-xs1>
                      <h5>Mã số thuế</h5>
                    </v-flex>
                    <v-flex xs8>{{hotel.tax_code}}</v-flex>
                  </v-layout>
                  <v-layout row>
                    <v-flex xs3 offset-xs1>
                      <h5>Điểm đánh giá</h5>
                    </v-flex>
                    <v-flex xs8>{{hotel.review_point}}</v-flex>
                  </v-layout>
                  <v-layout row>
                    <v-flex xs3 offset-xs1>
                      <h5>Số Fax</h5>
                    </v-flex>
                    <v-flex xs8>{{hotel.fax_number}}</v-flex>
                  </v-layout>
                  <v-layout row>
                    <v-flex xs3 offset-xs1>
                      <h5>Xu</h5>
                    </v-flex>
                    <v-flex xs8>{{hotel.coin}}</v-flex>
                  </v-layout>
                </v-container>
              </v-card-text>
            </v-card>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-card>
    </v-layout>
  </div>
</template>
<script>
export default {
  $_veeValidate: {
    validator: "new"
  },
  props: {
    arrayHotel: {
      type: Array
    },
    hotelPanel: {
      type: Array
    },
    arrayHotelType: {
      type: Array
    },
    arrayProvince: {
      type: Array
    },
    arrayService: {
      type: Array
    },
    api_token: {
      type: String
    }
  },
  data: function() {
    return {
      newHotelData: {
        name: "",
        email: "",
        description: "",
        rating: 3,
        district: "",
        address: "",
        credit_card: "",
        phone: "",
        tax_code: "",
        fax_number: "",
        images: [],
        policy: {
          checkin: "",
          checkout: "",
          cancelable: false,
          cancel_day: 0,
          refundRate: 0,
          detailPolicy: ""
        },
        child_age: "",
        
      },
      menuCheckin: false,
      menuCheckout: false,
      defaultHotelType: 1,
      defaultProvince: 1,
      defaultDistrict: 1,
      defaultWard: 1,
      userID: 1,
      arrayDistrict: [],
      arrayWard: [],
      formTitle: "",
      districtDisabled: true,
      wardDisabled: true,
      snackbar: false,
      snackbarText: "hihi",
      snackbarTimeout: 5000,
      dialog: false,
      hotel_stars_num: 2,
      confirmDialog: false,
      selectedId: 0,
      confirmDialogText: "",
      panel: [],
      firstTime: true,
      primaryImage: 0,
      hotel_id: 0,
      arrayAge: [
        { text: "<1", value: 0 },
        { text: "1", value: 1 },
        { text: "2", value: 2 },
        { text: "3", value: 3 },
        { text: "4", value: 4 },
        { text: "5", value: 5 },
        { text: "6", value: 6 },
        { text: "7", value: 7 },
        { text: "8", value: 8 },
        { text: "9", value: 9 },
        { text: "10", value: 10 },
        { text: "11", value: 11 },
        { text: "12", value: 12 },
        { text: "13", value: 13 },
        { text: "14", value: 14 },
        { text: "15", value: 15 },
        { text: "16", value: 16 },
        { text: "17", value: 17 }
      ],
      bookingListCantDelete: null,
      dictionary: {
        custom: {
          hotelName: {
            required: () => "tên khách sạn không được để trống"
          },
          hotelType: {
            required: () => "Vui lòng chọn loại khách sạn"
          },
          description: {
            required: () => "Mô tả khách sạn"
          },
          province: {
            required: () => "Tỉnh/Thành phố không được để trống"
          },
          district: {
            required: () => "Quận/Huyện không được để trống"
          },
          ward: {
            required: () => "Xã/Phường không được để trống"
          },
          address: {
            required: () => "Địa chỉ không được để trống"
          },
          credit_card: {
            required: () => "Số thẻ tín dụng không được để trống"
          },
          phone: {
            required: () => "Số điện thoại không được để trống"
          },
          fax_number: {
            required: () => "Số Fax không được để trống"
          },
          tax_code: {
            required: () => "Mã số thuế không được để trống"
          },
          email: {
            required: () => "Email không được bỏ trống"
          },
          child_age: {
            required: () => "Vui lòng cho biết độ tuổi được xem là trẻ em"
          }
        }
      }
    };
  },
  mounted() {
    this.$validator.localize("en", this.dictionary);
  },
  created() {},
  watch: {
    // panelIndex: function() {
    //   if (this.panelIndex !== null) {
    //     var hotel = this.arrayHotel[this.panelIndex];
    //     // if (hotel !== null) {
    //     this.hotel_stars_num = hotel.stars_num;
    //     this.$emit("chooseHotel", hotel.id);
    //   }
    // }
    hotelPanel: function() {
      this.panel = this.hotelPanel;
      this.panel[0] = true;
    },
    arrayHotel: function(newVal) {
      this.arrayHotel = newVal;
    },
    confirmDialog: function() {
      if (this.confirmDialog == false) {
        this.bookingListCantDelete = null;
      }
    }
  },
  computed: {
    addNewTitle: function() {
      this.formTitle = "Tạo khách sạn";
      this.defaultHotelType = this.arrayHotelType[0];
      this.newHotelData = {
        images : [],
        policy: {
          checkin: "",
          checkout: "",
          cancelable: false,
          cancel_day: 0,
          refundRate: 0,
          detailPolicy: ""
        }
      };
      this.$refs.formNewHotel.reset();
      return this.formTitle;
    }
  },
  methods: {
    onInput(ev, index) {
      if (ev == false) {
        for (var i = 0; i < this.panel.length; i++) {
          this.panel[i] = false;
        }
      }
      if (ev == true) {
        for (var i = 0; i < this.panel.length; i++) {
          this.panel[i] = false;
        }
        this.hotel_id = this.arrayHotel[index].id;
        // this.hotel_stars_num = this.arrayHotel[index].stars_num;
        this.$emit("chooseHotel", this.hotel_id);
        this.$emit("panelIndex", index);
      }
    },
    validate() {
      var _this = this;
      this.$validator.validate().then(valid => {
        if (!valid) {
        } else {
          axios({
            method: "post",
            url: "http://localhost:8000/api/manager/hotel",
            data: {
              name: this.newHotelData.name,
              email: this.newHotelData.email,
              hotelType: this.defaultHotelType,
              hotel_manager_id: this.userID,
              stars_num: this.newHotelData.rating,
              description: this.newHotelData.description,
              province: this.defaultProvince,
              district: this.defaultDistrict,
              ward: this.defaultWard,
              address: this.newHotelData.address,
              credit_card: this.newHotelData.credit_card,
              phone: this.newHotelData.phone,
              fax_number: this.newHotelData.fax_number,
              tax_code: this.newHotelData.tax_code,
              images: this.newHotelData.images,
              primaryId: this.primaryImage,
              checkin: this.newHotelData.policy.checkin,
              checkout: this.newHotelData.policy.checkout,
              cancelable: this.newHotelData.policy.cancelable,
              cancel_day: this.newHotelData.policy.cancel_day,
              refundRate: this.newHotelData.policy.refundRate,
              child_age: this.newHotelData.child_age,
              detailPolicy: this.newHotelData.policy.detailPolicy
            },
            headers: {
              Authorization: "Bearer " + this.api_token
            }
          })
            .then(response => {
              console.log(response.data);
              if (response.data.status == false) {
                alert("can't create new hotel with this info");
              } else {
                _this.dialog = false;
                _this.snackbarText = response.data.message;
                _this.snackbar = true;
                var temp_hotel_type = "";
                for (var j = 0; j < _this.arrayHotelType.length; j++) {
                  if (this.defaultHotelType == _this.arrayHotelType[j].id) {
                    temp_hotel_type = _this.arrayHotelType[j].name;
                  }
                }
                var hotel = {
                  id: response.data.id,
                  address: response.data.hotel.address,
                  coin: 0,
                  credit_card: response.data.hotel.credit_card,
                  description: response.data.hotel.description,
                  fax_number: response.data.hotel.fax_number,
                  email: response.data.hotel.email,
                  hotel_type: temp_hotel_type,
                  name: response.data.hotel.name,
                  images: response.data.hotel.images,
                  phone: response.data.hotel.phone,
                  stars_num: response.data.hotel.rating,
                  tax_code: response.data.hotel.tax_code,
                  child_age: response.data.hotel.child_age,
                  policy: {
                    checkin: response.data.hotel.policy.checkin,
                    checkout: response.data.hotel.policy.checkout,
                    cancelable: response.data.hotel.policy.cancelable,
                    cancel_day: response.data.hotel.policy.cancel_day,
                    refundRate: response.data.hotel.policy.refundRate,
                    detailPolicy: response.data.hotel.policy.detailPolicy
                  }
                };
                _this.arrayHotel.push(hotel);
              }
              console.log(hotel);
              console.log(_this.arrayHotel);
              this.$emit("changeArrayHotel", _this.arrayHotel);
            })
            .catch(error => {
              console.log(error.response);
            });
          this.dialog = false;
        }
      });
    },
    addImage(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.createImage(files[files.length - 1]);
    },
    createImage(file) {
      let reader = new FileReader();
      var _this = this;
      reader.onload = e => {
        var temp = {};
        temp.image_link = e.target.result;
        // console.log(_this.images.length);
        if (_this.newHotelData.images.length == 0) {
          temp.is_primary = 1;
          // this.primaryImage = 1;
        } else {
          temp.is_primary = 0;
        }
        temp.id = -1;
        _this.newHotelData.images.push(temp);
      };
      reader.readAsDataURL(file);
      // console.log(this.primaryImage);
    },
    choosePrimary(index) {
      for (var i = 0; i < this.newHotelData.images.length; i++) {
        this.newHotelData.images[i].is_primary = 0;
        if (i == index) {
          this.newHotelData.images[i].is_primary = 1;
        }
      }
      console.log(index);
      console.log(this.primaryImage);
    },
    cancel() {
      this.errors.clear();
      this.dialog = false;
      this.confirmDialog = false;
    },
    reset() {
      this.newHotelData.district = "";
      this.newHotelData.ward = "";
      this.districtDisabled = true;
      this.wardDisabled = true;
      this.errors.clear();
    },
    provinceSelected: function() {
      var _this = this;
      axios
        .get("http://localhost:8000/api/manager/district", {
          params: {
            provinceId: _this.defaultProvince
          },
          headers: {
            Authorization: "Bearer " + this.api_token
          }
        })
        .then(response => {
          if (response.status == 401) {
            this.logout;
          }
          _this.arrayDistrict = response.data.data;
        })
        .catch(function(error) {
          console.log(error);
        });
      this.districtDisabled = false;
      this.wardDisabled = true;
      this.newHotelData.district = "";
      this.newHotelData.ward = "";
    },
    districtSelected: function() {
      var _this = this;
      axios
        .get("http://localhost:8000/api/manager/ward", {
          params: {
            districtId: _this.defaultDistrict
          },
          headers: {
            Authorization: "Bearer " + this.api_token
          }
        })
        .then(response => {
          if (response.status == 401) {
            this.logout;
          }
          _this.arrayWard = response.data.data;
        })
        .catch(function(error) {
          console.log(error);
        });
      this.wardDisabled = false;
    },
    updateHotel: function() {
      var _this = this;
      console.log(this.newHotelData.images);
      debugger;
      this.$validator.validate().then(valid => {
        if (!valid) {
        } else {
          axios({
            method: "put",
            url: "http://localhost:8000/api/manager/hotel/" + this.selectedId,
            data: {
              name: this.newHotelData.name,
              email: this.newHotelData.email,
              hotelType: this.defaultHotelType,
              hotel_manager_id: this.userID,
              stars_num: this.newHotelData.rating,
              description: this.newHotelData.description,
              province: this.defaultProvince,
              district: this.defaultDistrict,
              ward: this.defaultWard,
              address: this.newHotelData.address,
              credit_card: this.newHotelData.credit_card,
              phone: this.newHotelData.phone,
              fax_number: this.newHotelData.fax_number,
              tax_code: this.newHotelData.tax_code,
              child_age: this.newHotelData.child_age,
              images: this.newHotelData.images,
              primaryId: this.primaryImage,
              checkin: this.newHotelData.policy.checkin,
              checkout: this.newHotelData.policy.checkout,
              cancelable: this.newHotelData.policy.cancelable,
              cancel_day: this.newHotelData.policy.cancel_day,
              refundRate: this.newHotelData.policy.refundRate,
              detailPolicy: this.newHotelData.policy.detailPolicy
            },
            headers: {
              Authorization: "Bearer " + this.api_token
            }
          })
            .then(response => {
              if (response.status == 401) {
                this.logout;
              }
              console.log(response);
              console.log(this.defaultWard);
              if (response.data.status == false) {
                alert("can't update new hotel with this info");
                console.log("cant");
              } else {
                console.log(response);
                this.snackbarText = response.data.message;
                this.snackbar = true;
                for (var i = 0; i < _this.arrayHotel.length; i++) {
                  if (_this.arrayHotel[i].id == _this.selectedId) {
                    console.log(_this.arrayHotel[i]);
                    _this.arrayHotel[i].name = response.data.hotel.name;
                    _this.arrayHotel[i].stars_num = response.data.hotel.stars_num;
                    for (var j = 0; j < _this.arrayHotelType.length; j++) {
                      if (_this.arrayHotelType[j].id == this.defaultHotelType)
                        _this.arrayHotel[i].hotel_type =
                          _this.arrayHotelType[j].name;
                    }
                    _this.arrayHotel[i].address = response.data.hotel.address;
                    _this.arrayHotel[i].description = response.data.hotel.description;
                    _this.arrayHotel[i].email = response.data.hotel.email;
                    _this.arrayHotel[i].email = response.data.hotel.email;
                    _this.arrayHotel[i].coin = 0;
                    _this.arrayHotel[i].credit_card = response.data.hotel.credit_card;
                    _this.arrayHotel[i].phone_number = response.data.hotel.phone;
                    _this.arrayHotel[i].credit_card = response.data.hotel.credit_card;
                    _this.arrayHotel[i].tax_code = response.data.hotel.tax_code;
                    _this.arrayHotel[i].fax_number = response.data.hotel.fax_number;
                    _this.arrayHotel[i].images = response.data.hotel.images;
                    _this.arrayHotel[i].child_age = response.data.hotel.child_age;
                    _this.arrayHotel[i].policy.cancel_day = response.data.hotel.policy.cancel_day;
                    _this.arrayHotel[i].policy.cancelable = response.data.hotel.policy.cancelable;
                    _this.arrayHotel[i].policy.checkin = response.data.hotel.policy.checkin;
                    _this.arrayHotel[i].policy.checkout = response.data.hotel.policy.checkout;
                    _this.arrayHotel[i].policy.refundRate = response.data.hotel.policy.refundRate;
                    _this.arrayHotel[i].policy.detailPolicy = response.data.hotel.policy.detailPolicy;
                    console.log(_this.arrayHotel[i]);
                  }
                }
                this.dialog = false;
              }
              //  _this.snackbar = true;
              //   _this.message = response.data.message;
              //   __this.dialog = false;

              this.$emit("changeArrayHotel", _this.arrayHotel);
            })
            .catch(error => {
              console.log(error.response);
            });
        }
      });
    },
    save: function() {
      console.log(this.newHotelData);
    },
    editHotel: function(hotelId) {
      console.log(this.newHotelData.images);
      this.districtDisabled = false;
      this.wardDisabled = false;
      this.dialog = true;
      this.selectedId = hotelId;
      this.formTitle = "Sửa thông tin khách sạn";
      var _this = this;
      var address = {};
      var hotel = {};
      for (var i = 0; i < _this.arrayHotel.length; i++) {
        if (_this.arrayHotel[i].id == this.selectedId) {
          hotel = _this.arrayHotel[i];
          this.newHotelData.images = _this.arrayHotel[i].images;
          for (var j = 0; j < _this.arrayHotelType.length; j++) {
            if (hotel.hotel_type == _this.arrayHotelType[j].name) {
              _this.defaultHotelType = _this.arrayHotelType[j].id;
            }
          }
        }
      }
      console.log(hotel);
      this.newHotelData.name = hotel.name;
      this.newHotelData.rating = hotel.stars_num;
      this.newHotelData.description = hotel.description;
      this.newHotelData.child_age = hotel.child_age;
      this.newHotelData.email = hotel.email;
      if (hotel.policy.cancel_day > 0 && hotel.policy.cancel_day != null) {
        this.newHotelData.policy.cancelable = true;
      } else {
        this.newHotelData.policy.cancelable = false;
      }
      this.newHotelData.policy.checkin = hotel.policy.checkin;
      this.newHotelData.policy.checkout = hotel.policy.checkout;
      this.newHotelData.policy.cancel_day = hotel.policy.cancel_day;
      this.newHotelData.policy.detailPolicy = hotel.policy.detailPolicy;
      this.newHotelData.policy.refundRate = hotel.policy.refundRate;
      this.newHotelData.images = hotel.images;
      console.log(hotel);
      console.log(this.newHotelData);
      axios
        .get("http://localhost:8000/api/manager/hotel-address", {
          params: {
            hotel_id: hotel.id
          },
          headers: {
            Authorization: "Bearer " + this.api_token
          }
        })
        .then(response => {
          if (response.status == 401) {
            this.logout;
          }
          address = response.data.data;
          for (var p = 0; p < _this.arrayProvince.length; p++) {
            if (response.data.data.province_id == _this.arrayProvince[p].id) {
              _this.defaultProvince = _this.arrayProvince[p].id;
              return axios
                .get("http://localhost:8000/api/manager/district", {
                  params: {
                    provinceId: _this.defaultProvince
                  },
                  headers: {
                    Authorization: "Bearer " + this.api_token
                  }
                })
                .then(response => {
                  if (response.status == 401) {
                    this.logout;
                  }
                  _this.arrayDistrict = response.data.data;
                  for (var d = 0; d < _this.arrayDistrict.length; d++) {
                    if (address.district_id == _this.arrayDistrict[d].id) {
                      _this.defaultDistrict = _this.arrayDistrict[d].id;
                      return axios
                        .get("http://localhost:8000/api/manager/ward", {
                          params: {
                            districtId: _this.defaultDistrict
                          },
                          headers: {
                            Authorization: "Bearer " + this.api_token
                          }
                        })
                        .then(response => {
                          if (response.status == 401) {
                            this.logout;
                          }
                          _this.arrayWard = response.data.data;
                          for (var d = 0; d < _this.arrayWard.length; d++) {
                            if (address.ward_id == _this.arrayWard[d].id) {
                              _this.defaultWard = _this.arrayWard[d].id;
                            }
                          }
                        })
                        .catch(function(error) {
                          console.log(error.response);
                        });
                    }
                  }
                })
                .catch(function(error) {
                  console.log(error.response);
                });
            }
          }
        })
        .catch(function(error) {
          console.log(error.response);
        });
      this.newHotelData.address = hotel.address;
      this.newHotelData.email = hotel.email;
      this.newHotelData.credit_card = hotel.credit_card;
      this.newHotelData.phone = hotel.phone;
      this.newHotelData.fax_number = hotel.fax_number;
      this.newHotelData.tax_code = hotel.tax_code;
    },
    deleteHotel: function(hotelId) {
      this.confirmDialog = true;
      this.selectedId = hotelId;
      this.confirmDialogText = "Bạn có muốn xóa khách sạn này " + "?";
    },
    deleteHotelConfirm: function() {
      var _this = this;
      axios
        .delete("http://localhost:8000/api/manager/hotel/" + this.selectedId, {
          headers: {
            Authorization: "Bearer " + this.api_token
          }
        })
        .then(response => {
          if (response.status == 401) {
            this.logout;
          }
          console.log(response);
          if (response.data.status == false) {
            if (response.data.booking_list != null) {
              this.confirmDialog = true;
              this.bookingListCantDelete = response.data.booking_list;
              console.log(response.data.booking_list);
            }
          } else {
            for (var i = 0; i < _this.arrayHotel.length; i++) {
              if (_this.arrayHotel[i].id == this.selectedId) {
                _this.arrayHotel.splice(i, 1);
              }
            }
            this.confirmDialog = false;
          }
        })
        .catch(error => {
          console.log(error);
        });
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
          // if (response.status == 401) {
          //   this.logout;
          // }
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
      localStorage.removeItem("api_token");
      this.api_token = null;
      location.href = "login";
    },
    deleteImage: function(i) {
      this.newHotelData.images.splice(i, 1);
    },
    detailOrder: function(id) {
      this.$router.push({
        name: "order",
        query: { hotelId: this.selectedId, orderId: id }
      });
    }
  }
};
</script>
<style scoped>
.primaryImage {
  border: 4px solid teal;
  padding: 2px;
}
#primaryBox {
  box-sizing: border-box;
  overflow: hidden;
}
.img-box {
  position: relative;
  height: 200px;
  margin-bottom: 10px;
}
.img-box > .img {
  border: 1px solid black;
}
.ribbon {
  position: absolute;
  background-color: teal;
  height: 20px;
  padding: auto;
  width: 200px;
  top: 6px;
  left: 0px;
  color: white;
}
.deleteImage {
  position: absolute;
  padding: auto;
  top: 6px;
  left: 180px;
  color: white;
}
#file {
  display: none;
}
.fileLabel {
  padding-top: 2px;
  width: 50px;
  height: 50px;
  line-height: 50px;
  text-align: center;
  margin-top: 75px;
  margin-left: 40%;
  border-radius: 50px;
}
.add-image {
  height: 200px;
  width: 200px;
  border: 4px dashed teal;
}
.img {
  height: 200px;
  width: 200px;
  margin-bottom: 20px;
}
</style>

