<template>
  <div>
    <v-layout justify-space-around>
      <v-card width="23%" class="cyan lighten-3" height="150px">
        <v-card-title>
          <v-icon class="m-2">event_note</v-icon>
          <h2>Orders</h2>
        </v-card-title>
        <v-card-text>12</v-card-text>
      </v-card>
      <v-card width="23%" class="yellow accent-3" height="150px">
        <v-card-title>
          <v-icon class="m-2">airline_seat_individual_suite</v-icon>
          <h2>Rooms</h2>
        </v-card-title>
        <v-card-text>12</v-card-text>
      </v-card>
      <v-card width="23%" class="pink accent-2 white--text" height="150px">
        <v-card-title>
          <v-icon class="white--text m-2">loyalty</v-icon>
          <h2>Promotion</h2>
        </v-card-title>
        <v-card-text>12</v-card-text>
      </v-card>
      <v-card width="23%" class="indigo darken-1 white--text" height="150px">
        <v-card-title>
          <v-icon class="white--text m-2">stars</v-icon>
          <h2>ETC</h2>
        </v-card-title>
        <v-card-text>12</v-card-text>
      </v-card>
    </v-layout>
    <v-layout class="m-5">
      <v-spacer></v-spacer>
      <v-dialog max-width="75%" scrollable v-model="dialog">
        <template v-slot:activator="{ on }">
          <v-btn class="primary" v-on="on" @click="addNewTitle;">New hotel</v-btn>
        </template>
        <v-layout row>
          <v-flex>
            <v-card width="100%" class="p-5">
              <v-card-title class="text-xs-center">
                <h1>{{formTitle}}</h1>
              </v-card-title>
              <v-divider></v-divider>
              <v-card-text height="100px">
                <v-form ref="formNewHotel">
                  <v-layout row>
                    <v-text-field
                      v-validate="'required|min:10'"
                      :error-messages="errors.collect('hotelName')"
                      data-vv-name="hotelName"
                      class="pr-3"
                      label="Hotel name"
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
                      label="Hotel type"
                      v-model="defaultHotelType"
                      required
                      outline
                    ></v-select>
                  </v-layout>
                  <v-layout row>
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
                      label="Hotel Description"
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
                      label="Province"
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
                      label="District"
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
                      label="Ward"
                      v-model="defaultWard"
                      :disabled="wardDisabled"
                      required
                      outline
                    ></v-select>
                  </v-layout>
                  <v-layout row>
                    <v-text-field
                      label="Address"
                      v-validate="'required'"
                      class="pr-3"
                      :error-messages="errors.collect('address')"
                      data-vv-name="address"
                      v-model="newHotelData.address"
                      required
                      outline
                    ></v-text-field>
                    <v-text-field
                      label="Credit Card"
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
                      label="Phone number"
                      v-validate="'required'"
                      class="pr-3"
                      :error-messages="errors.collect('phone')"
                      data-vv-name="phone"
                      v-model="newHotelData.phone"
                      required
                      outline
                    ></v-text-field>
                    <v-text-field
                      label="Fax number"
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
                      label="Tax code"
                      v-validate="'required'"
                      :error-messages="errors.collect('tax_code')"
                      data-vv-name="tax_code"
                      v-model="newHotelData.tax_code"
                      required
                      outline
                    ></v-text-field>
                  </v-layout>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  v-if="formTitle != 'Edit Hotel'"
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
    <v-layout class="m-5">
      <v-expansion-panel v-model="panelIndex" focusable>
        <h1>Yours hotels</h1>
        <v-expansion-panel-content v-for="(hotel,i) in arrayHotel" :key="i">
          <template v-slot:header>
            <div>
              <v-layout>
                <v-flex xs10>
                  <h3>Hotel {{hotel.name}}</h3>
                </v-flex>
                <v-flex xs2 class="text-right">
                  <v-btn icon @click.stop="editHotel(arrayHotel[i].id)">
                    <v-icon color="primary">create</v-icon>
                  </v-btn>
                  <v-btn icon @click.stop="deleteHotel(arrayHotel[i].id)">
                    <v-icon color="red">delete</v-icon>
                  </v-btn>
                  <v-dialog max-width="20%" v-model="confirmDialog">
                    <v-card>
                      <v-card-title>Confirmation</v-card-title>
                      <v-card-text>{{confirmDialogText}}</v-card-text>
                      <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" flat @click.stop="deleteHotelConfirm()">Confirm</v-btn>
                        <v-btn color="red" flat @click="cancel">Cancel</v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                </v-flex>
              </v-layout>
            </div>
          </template>
          <v-card>
            <v-card-text class="grey lighten-3">
              <v-container>
                <v-parallax
                  dark
                  height="100px"
                  src="https://pix6.agoda.net/hotelImages/10953/-1/62732aec5194871b6ee397fedbb3bf62.jpg?s=1024x768"
                >
                  <v-layout align-start justify-end column>
                    <v-flex align-self-end class="m-4">
                      <v-avatar class="yellow" size="54">
                        <v-avatar class="primary" size="50">
                          <h3 class="mt-2">{{hotel.review_point}}</h3>
                          <!-- <v-img
                          src="https://www.sccpre.cat/png/big/87/870692_glow-circle-png.png"
                        >
                          <h3 class="mt-3">{{hotel.review_point}}</h3>
                          </v-img>-->
                        </v-avatar>
                      </v-avatar>
                    </v-flex>
                    <h1 class="ml-2">{{hotel.name}}</h1>
                    <v-rating
                      background-color="orange lighten-3"
                      color="orange"
                      readonly
                      v-model="hotel_stars_num"
                    ></v-rating>
                    <div class="mb-3">
                      <v-icon color="pink">room</v-icon>Tp HCM
                    </div>
                  </v-layout>
                </v-parallax>
                <v-divider></v-divider>
                <v-layout row>
                  <v-flex xs3 offset-xs1>
                    <h5>Hotel Type</h5>
                  </v-flex>
                  <v-flex xs8>{{hotel.hotel_type}}</v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs3 offset-xs1>
                    <h5>Hotel Description</h5>
                  </v-flex>
                  <v-flex xs8>{{hotel.description}}</v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs3 offset-xs1>
                    <h5>Hotel Tax code</h5>
                  </v-flex>
                  <v-flex xs8>{{hotel.tax_code}}</v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs3 offset-xs1>
                    <h5>Review point</h5>
                  </v-flex>
                  <v-flex xs8>{{hotel.review_point}}</v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs3 offset-xs1>
                    <h5>Fax number</h5>
                  </v-flex>
                  <v-flex xs8>{{hotel.fax_number}}</v-flex>
                </v-layout>
                <v-layout row>
                  <v-flex xs3 offset-xs1>
                    <h5>Coin</h5>
                  </v-flex>
                  <v-flex xs8>{{hotel.coin}}</v-flex>
                </v-layout>
              </v-container>
            </v-card-text>
          </v-card>
        </v-expansion-panel-content>
      </v-expansion-panel>
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
    arrayHotelType: {
      type: Array
    },
    arrayProvince: {
      type: Array
    }
  },
  data: function() {
    return {
      newHotelData: {
        name: "",
        description: "",
        rating: 3,
        district: "",
        address: "",
        credit_card: "",
        phone: "",
        tax_code: "",
        fax_number: ""
      },
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
      panelIndex: -9,
      hotel_stars_num: 2,
      confirmDialog: false,
      selectedId: 0,
      confirmDialogText: ""
    };
  },
  watch: {
    panelIndex: function() {
      var hotel = this.arrayHotel[this.panelIndex];
      this.hotel_stars_num = hotel.stars_num;
      // this.snackbar = true;
      // this.snackbarText = "Now working with hotel " + hotel.name;
      // this.snackbarTimeout = 1000;
      this.$emit("chooseHotel", hotel.id);
    }
  },
  computed: {
    addNewTitle: function() {
      this.formTitle = "Add new hotel";
      this.defaultHotelType = this.arrayHotelType[0];
      this.$refs.formNewHotel.reset();
      return this.formTitle;
    }
  },
  methods: {
    validate() {
      var _this = this;
      this.$validator.validate().then(valid => {
        if (!valid) {
        } else {
          axios({
            method: "post",
            url: "http://localhost:8000/api/manager/hotel",
            params: {
              name: this.newHotelData.name,
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
              tax_code: this.newHotelData.tax_code
            }
          })
            .then(response => {
              console.log(response);
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
                  address: {
                    address: this.newHotelData.address
                  },
                  coin: 0,
                  credit_card: this.newHotelData.credit_card,
                  description: this.newHotelData.description,
                  fax_number: this.newHotelData.fax_number,
                  hotel_type: temp_hotel_type,
                  name: this.newHotelData.name,
                  phone_number: this.newHotelData.phone,
                  stars_num: this.newHotelData.rating,
                  tax_code: this.newHotelData.tax_code
                };
                _this.arrayHotel.push(hotel);
              }
              console.log(_this.arrayHotel);
              this.$emit("changeArrayHotel", _this.arrayHotel);
            })
            .catch(error => {
              console.log(error);
            });
        }
      });
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
          }
        })
        .then(response => {
          _this.arrayDistrict = response.data;
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
          }
        })
        .then(response => {
          _this.arrayWard = response.data.data;
          console.log(response);
        })
        .catch(function(error) {
          console.log(error);
        });
      this.wardDisabled = false;
    },
    updateHotel: function() {
      var _this = this;
      console.log(this.selectedId);
      this.$validator.validate().then(valid => {
        if (!valid) {
        } else {
          axios({
            method: "put",
            url: "http://localhost:8000/api/manager/hotel/" + this.selectedId,
            params: {
              name: this.newHotelData.name,
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
              tax_code: this.newHotelData.tax_code
            }
          })
            .then(response => {
              console.log(response);
              console.log(this.defaultWard);
              if (response.data.status == false) {
                alert("can't update new hotel with this info");
              } else {
                _this.dialog = false;
                _this.snackbarText = response.data.message;
                _this.snackbar = true;
                for (var i = 0; i < _this.arrayHotel.length; i++) {
                  if (_this.arrayHotel[i].id == _this.selectedId) {
                    // console.log(_this.arrayHotel[i]);
                    _this.arrayHotel[i].name = this.newHotelData.name;
                    _this.arrayHotel[i].stars_num = this.newHotelData.rating;
                    for (var j = 0; j < _this.arrayHotelType.length; j++) {
                      if (_this.arrayHotelType[j].id == this.defaultHotelType)
                        _this.arrayHotel[i].hotel_type =
                          _this.arrayHotelType[j].name;
                    }
                    _this.arrayHotel[
                      i
                    ].address.address = this.newHotelData.address;
                    _this.arrayHotel[i].coin = 0;
                    _this.arrayHotel[
                      i
                    ].credit_card = this.newHotelData.credit_card;
                    _this.arrayHotel[i].phone_number = this.newHotelData.phone;
                    _this.arrayHotel[
                      i
                    ].credit_card = this.newHotelData.credit_card;
                    _this.arrayHotel[i].tax_code = this.newHotelData.tax_code;
                    _this.arrayHotel[
                      i
                    ].fax_number = this.newHotelData.fax_number;
                  }
                }
              }
              this.$emit("changeArrayHotel", _this.arrayHotel);
            })
            .catch(error => {
              console.log(error);
            });
        }
      });
    },
    save: function() {
      console.log(this.newHotelData);
    },
    editHotel: function(hotelId) {
      this.districtDisabled = false;
      this.wardDisabled = false;
      this.dialog = true;
      this.selectedId = hotelId;
      this.formTitle = "Edit Hotel";
      var _this = this;
      var address = {};
      var hotel = {};
      for (var i = 0; i < _this.arrayHotel.length; i++) {
        if (_this.arrayHotel[i].id == this.selectedId) {
          hotel = _this.arrayHotel[i];
          for (var j = 0; j < _this.arrayHotelType.length; j++) {
            if (hotel.hotel_type == _this.arrayHotelType[j].name) {
              _this.defaultHotelType = _this.arrayHotelType[j].id;
            }
          }
        }
      }
      this.newHotelData.name = hotel.name;
      this.newHotelData.rating = hotel.stars_num;
      this.newHotelData.description = hotel.description;
      axios
        .get("http://localhost:8000/api/manager/hotel-address", {
          params: {
            api_token: 123,
            hotel_id: hotel.id
          }
        })
        .then(response => {
          address = response.data.data;
          console.log(response.data);
          for (var p = 0; p < _this.arrayProvince.length; p++) {
            if (response.data.data.province_id == _this.arrayProvince[p].id) {
              _this.defaultProvince = _this.arrayProvince[p].id;
              console.log(this.defaultProvince9);
              return axios
                .get("http://localhost:8000/api/manager/district", {
                  params: {
                    provinceId: _this.defaultProvince
                  }
                })
                .then(response => {
                  _this.arrayDistrict = response.data;
                  for (var d = 0; d < _this.arrayDistrict.length; d++) {
                    if (address.district_id == _this.arrayDistrict[d].id) {
                      _this.defaultDistrict = _this.arrayDistrict[d].id;
                      console.log(this.defaultDistrict);
                      return axios
                        .get("http://localhost:8000/api/manager/ward", {
                          params: {
                            districtId: _this.defaultDistrict
                          }
                        })
                        .then(response => {
                          _this.arrayWard = response.data.data;
                          for (var d = 0; d < _this.arrayWard.length; d++) {
                            if (address.ward_id == _this.arrayWard[d].id) {
                              _this.defaultWard = _this.arrayWard[d].id;
                            }
                          }
                        })
                        .catch(function(error) {
                          console.log(error);
                        });
                    }
                  }
                })
                .catch(function(error) {
                  console.log(error);
                });
            }
          }
        })
        .catch(function(error) {
          console.log(error);
        });
      this.newHotelData.address = hotel.address.address;
      this.newHotelData.credit_card = hotel.credit_card;
      this.newHotelData.phone = hotel.phone_number;
      this.newHotelData.fax_number = hotel.fax_number;
      this.newHotelData.tax_code = hotel.tax_code;
    },
    deleteHotel: function(hotelId) {
      this.confirmDialog = true;
      this.selectedId = hotelId;
      this.confirmDialogText =
        "Are you really want to delete this " + hotelId + " ?";
    },
    deleteHotelConfirm: function() {
      var _this = this;
      axios
        .delete("http://localhost:8000/api/manager/hotel/" + this.selectedId)
        .then(response => {
          console.log(response);
          if (response.data.status == true) {
            for (var i = 0; i < _this.arrayHotel.length; i++) {
              if (_this.arrayHotel[i].id == this.selectedId) {
                _this.arrayHotel.splice(i, 1);
              }
            }
          }
        })
        .catch(error => {
          console.log(error);
        });
      this.confirmDialog = false;
    }
  }
};
</script>
