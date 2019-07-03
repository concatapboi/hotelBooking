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
      <v-dialog max-width="75%" scrollable v-model="dialog">
        <template v-slot:activator="{ on }">
          <v-btn class="primary" flat v-on="on" @click="addNewTitle;">New hotel</v-btn>
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
                  <h3>General information</h3>
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
                      class="pr-3"
                      v-validate="'required'"
                      :error-messages="errors.collect('tax_code')"
                      data-vv-name="tax_code"
                      v-model="newHotelData.tax_code"
                      required
                      outline
                    ></v-text-field>
                    <v-text-field
                      label="email"
                      class="pl-3"
                      v-validate="'required'"
                      :error-messages="errors.collect('email')"
                      data-vv-name="email"
                      v-model="newHotelData.email"
                      required
                      outline
                    ></v-text-field>
                  </v-layout>
                  <v-divider></v-divider>
                  <h3>Images</h3>
                  <v-layout row wrap align-space-between justify-start>
                    <!-- <v-flex style="height : 200px;" v-if="images" md3> -->
                    <v-flex v-for="(image,i) in images" :key="i" md3>
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
                        >
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
                        >
                      </div>
                    </v-flex>
                    <v-flex md3 class="justify-center">
                      <div class="add-image">
                        <label for="file" class="fileLabel" v-ripple="{ class: `primary--text` }">
                          <v-icon color="primary">add</v-icon>
                        </label>
                        <input type="file" id="file" multiple ref="images" @change="addImage">
                      </div>
                    </v-flex>
                  </v-layout>
                  <v-divider></v-divider>
                  <h3>Policies</h3>
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
      <v-card dark flat color="blue-grey darken-4" class="p-2">
        <v-expansion-panel class="elevation-0" v-model="panel" focusable expand>
          <h1>Yours hotels</h1>
          <v-expansion-panel-content
            hide-actions
            class="primary"
            v-for="(hotel,i) in arrayHotel"
            :key="i"
          >
            <template v-slot:header>
              <div>
                <v-layout>
                  <v-flex xs10>
                    <h3 class="black--text">Hotel {{hotel.name}}</h3>
                  </v-flex>
                  <v-flex xs2 class="text-right">
                    <v-btn icon @click.stop="editHotel(arrayHotel[i].id)">
                      <v-icon color="orange">create</v-icon>
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
              <v-card-text class="grey lighten-3 black--text">
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
      hotel_stars_num: 2,
      confirmDialog: false,
      selectedId: 0,
      confirmDialogText: "",
      panel: [],
      firstTime: true,
      images: [],
      primaryImage: 0,
      hotel_id: 0
    };
  },
  created() {
    this.panel = this.hotelPanel;
  },
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
    },
    panel: function(oldPanel, newPanel) {
      var index = 0;
      if (this.firstTime == false) {
        for (var i = 0; i < this.panel.length; i++) {
          if (oldPanel[i] != newPanel[i]) {
            index = i;
          }
        }

        for (var i = 0; i < this.panel.length; i++) {
          this.panel[i] = false;
        }
        this.panel[index] = true;
        this.hotel_id = this.arrayHotel[index].id;
        this.hotel_stars_num = this.arrayHotel[index].stars_num;
        this.$emit("chooseHotel", this.hotel_id);
        this.$emit("panelIndex", index);
        // localStorage.hotelId = hotelId;
      } else {
        this.firstTime = false;
      }
    },
    dialog: function() {
      if (this.dialog == false) {
        this.images = [];
      }
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
              // arrayService: this.arrayServiceChoose,
              images: this.images,
              primaryId: this.primaryImage
            },
            headers: {
              Authorization: "Bearer " + this.api_token
            }
          })
            .then(response => {
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
              console.log(error.response);
            });
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
        temp.is_primary = 0;
        if (_this.images.length < 1) {
          temp.is_primary = 1;
        }
        _this.images.push(temp);
      };
      reader.readAsDataURL(file);
      console.log(this.images);
    },
    choosePrimary(index) {
      for (var i = 0; i < this.images.length; i++) {
        this.images[i].is_primary = 0;
        if (i == index) {
          this.images[i].is_primary = 1;
        }
      }
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
      console.log(this.images);
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
              images: this.images,
              primaryId: this.primaryImage
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
              console.log(error.response);
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
          this.images = _this.arrayHotel[i].images;
          console.log(hotel);
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
              console.log(this.defaultProvince);
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
                  console.log(response);
                  _this.arrayDistrict = response.data.data;
                  for (var d = 0; d < _this.arrayDistrict.length; d++) {
                    if (address.district_id == _this.arrayDistrict[d].id) {
                      _this.defaultDistrict = _this.arrayDistrict[d].id;
                      console.log(this.defaultDistrict);
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
      alert("xoa");
    },
    deleteHotelConfirm: function() {
      var _this = this;
      axios
        .delete("http://localhost:8000/api/manager/hotel/" + this.selectedId)
        .then(response => {
          if (response.status == 401) {
            this.logout;
          }
          console.log(response);
          // if (response.data.status == true) {
          //   for (var i = 0; i < _this.arrayHotel.length; i++) {
          //     if (_this.arrayHotel[i].id == this.selectedId) {
          //       _this.arrayHotel.splice(i, 1);
          //     }
          //   }
          // }
        })
        .catch(error => {
          console.log(error);
        });
      this.confirmDialog = false;
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
          if (response.status == 401) {
            this.logout;
          }
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
      this.images.splice(i, 1);
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
  border: 4px dashed green;
}
.img {
  height: 200px;
  width: 200px;
  margin-bottom: 20px;
}
</style>

