<template>
  <div>
    <v-layout class="mx-5">
      <v-spacer></v-spacer>
      <v-dialog max-width="75%" scrollable v-model="dialog">
        <template v-slot:activator="{ on }">
          <v-btn class="primary" flat v-on="on" @click="addNewTitle">New Room Type</v-btn>
        </template>
        <v-layout>
          <v-flex>
            <v-card width="100%" class="p-5">
              <v-card-title class="text-xs-center">
                <h1>{{formTitle}}</h1>
              </v-card-title>
              <v-divider></v-divider>

              <v-card-text height="100px">
                <v-form ref="formNewRoom">
                  <h3>Gerneral Infomation</h3>
                  <v-layout row>
                    <v-text-field
                      v-validate="'required'"
                      :error-messages="errors.collect('roomName')"
                      data-vv-name="roomName"
                      outline
                      class="pr-3"
                      label="Room name"
                      v-model="room.room_name"
                    ></v-text-field>
                    <v-text-field
                      v-validate="'numeric|required'"
                      :error-messages="errors.collect('numberOfRoom')"
                      data-vv-name="numberOfRoom"
                      outline
                      type="number"
                      class="pl-3"
                      label="Number of rooms this type"
                      v-model="room.amount"
                    ></v-text-field>
                  </v-layout>
                  <v-layout row>
                    <v-textarea
                      outline
                      v-validate="'required'"
                      :error-messages="errors.collect('description')"
                      data-vv-name="description"
                      label="Room's description"
                      v-model="room.description"
                    ></v-textarea>
                  </v-layout>
                  <v-layout row>
                    <v-select
                      v-validate="'required'"
                      :error-messages="errors.collect('roomMode')"
                      data-vv-name="roomMode"
                      outline
                      class="pr-3"
                      label="Room mode"
                      v-model="defaultRoomMode"
                      :items="arrayRoomMode"
                      item-text="name"
                      item-value="id"
                      @change="chooseRoomMode"
                    ></v-select>
                    <v-select
                      v-validate="'required'"
                      :error-messages="errors.collect('roomType')"
                      data-vv-name="roomType"
                      outline
                      class="pl-3"
                      label="Room Type"
                      v-model="defaultRoomType"
                      :items="arrayRoomType"
                      item-text="name"
                      item-value="id"
                      :disabled="roomTypeDisable"
                    ></v-select>
                  </v-layout>
                  <v-layout row v-show="showAmount">
                    <v-flex xs3>
                      <v-text-field
                        v-validate="'required'"
                        :error-messages="errors.collect('maxAmountAdult')"
                        data-vv-name="maxAmountAdult"
                        outline
                        type="number"
                        min="1"
                        class="pr-3"
                        label="Max number of adults"
                        v-model="room.max_adult_amount"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs3 offset-xs1>
                      <v-text-field
                        outline
                        type="number"
                        min="1"
                        class="pl-3"
                        label="Max number of children"
                        v-model="room.max_child_amount"
                        @change="chooseMaxChildAmount"
                      ></v-text-field>
                    </v-flex>
                    <v-flex xs3 offset-xs1 v-show="showFreeAmount">
                      <v-layout row>
                        <v-flex xs4>
                          <v-select
                            outline
                            label="Child's age"
                            :items="arrayAge"
                            item-text="text"
                            item-value="value"
                            v-model="room.child_age"
                          ></v-select>
                        </v-flex>
                        <v-flex xs6 offset-xs1>
                          <v-text-field
                            outline
                            type="number"
                            min="1"
                            class="pl-3"
                            label="Number of free children"
                            v-model="room.free_child_amount"
                          ></v-text-field>
                        </v-flex>
                      </v-layout>
                    </v-flex>
                    <v-flex v-show="showFreeAmount" xs1>
                      <v-tooltip close-delay="800" top light>
                        <template v-slot:activator="{ on }">
                          <v-btn flat icon v-on="on">
                            <v-icon>info</v-icon>
                          </v-btn>
                        </template>
                        <span>
                          number of children won't be charge
                          <br>for this room if they under the age
                        </span>
                      </v-tooltip>
                    </v-flex>
                  </v-layout>
                  <v-divider></v-divider>
                  <h3>Bed Infomation</h3>
                  <!-- <v-layout row>
                    <v-text-field
                      class="pr-3"
                      label="ammout"
                      type="number"
                      min="1"
                      max="10"
                      v-model="amount"
                      @change="test"
                    ></v-text-field>
                    <v-select
                      class="pl-3"
                      label="Bed Type"
                      v-model="defaultBedType"
                      :items="arrayBedType"
                      item-text="name"
                      item-value="id"
                    ></v-select>
                  </v-layout>-->
                  <v-layout row v-for="(b,i) in bed" :key="i" justify-start>
                    <v-flex md-2>
                      <v-text-field
                        v-validate="'required'"
                        :error-messages="errors.collect('numberOfBed')"
                        data-vv-name="numberOfBed"
                        outline
                        label="Number of beds"
                        type="number"
                        min="1"
                        max="10"
                        v-model="b.amount"
                        @change="test"
                      ></v-text-field>
                    </v-flex>
                    <v-flex md-11 class="pl-5">
                      <v-select
                        v-validate="'required'"
                        :error-messages="errors.collect('bedType')"
                        data-vv-name="bedType"
                        outline
                        label="Bed Type"
                        v-model="b.bedTypeId"
                        :items="arrayBedType"
                        item-text="name"
                        item-value="id"
                      ></v-select>
                    </v-flex>
                    <v-flex md1>
                      <v-btn fab flat depressed v-if="i != 0" @click="deleteBedType(i)">
                        <v-icon medium color="red">delete</v-icon>
                      </v-btn>
                    </v-flex>
                  </v-layout>
                  <v-layout>
                    <v-btn round flat class="primary" @click="addBed">
                      <v-icon class="m-2">add_circle</v-icon>add another
                    </v-btn>
                  </v-layout>
                  <v-divider></v-divider>
                  <h3>Features</h3>
                  <v-layout row>
                    <v-flex class="no-spinners">
                      <v-text-field
                        v-validate="'decimal|min_value:1'"
                        :error-messages="errors.collect('roomSize')"
                        data-vv-name="roomSize"
                        class="pr-3"
                        type="number"
                        outline
                        suffix="m²"
                        label="Room size"
                        v-model="room.room_size"
                      ></v-text-field>
                    </v-flex>
                    <v-flex>
                      <v-text-field
                        v-validate="'decimal|min_value:1'"
                        :error-messages="errors.collect('price')"
                        data-vv-name="price"
                        outline
                        append-icon="attach_money"
                        class="pl-3"
                        label="Price"
                        v-model="room.price"
                      ></v-text-field>
                    </v-flex>
                  </v-layout>
                  <!-- <v-divider></v-divider>
                  <h3>Service</h3>
                  <v-layout wrap row>
                    <v-flex xs4 v-for="(service,i) in arrayService" :key="i">
                      <v-checkbox
                        class="pl-3"
                        :label="service.name"
                        :value="service.id"
                        v-model="arrayServiceChoose"
                      ></v-checkbox>
                    </v-flex>
                  </v-layout>-->
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  v-if="formTitle != 'Edit Room'"
                  color="blue darken-1"
                  flat
                  type="submit"
                  @click="addNewRoom"
                >Create</v-btn>
                <v-btn
                  v-else
                  color="blue darken-1"
                  flat
                  type="submit"
                  @click="editRoom(roomMode,roomId)"
                >Update</v-btn>
                <v-btn color="blue darken-1" flat @click="$refs.formNewRoom.reset()">Reset</v-btn>
                <v-btn color="blue darken-1" flat @click="cancel">Cancel</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-dialog>
    </v-layout>
    <v-layout>
      <v-container>
        <v-card class="blue-grey darken-4 p-2">
          <!-- <v-img max-height="300px" max-width="300px" src="http://localhost:8000/images/room_no_data.png"></v-img>
          <h1>Let's create your first room !!!</h1>-->

          <v-expansion-panel v-model="panelIndex" v-bind:popout="popout" expand class="elevation-0">
            <h1 class="white--text">Your rooms</h1>
            <v-expansion-panel-content
              v-for="(room,index) in arrayRoom"
              :key="index"
              class="primary"
            >
              <template v-slot:header>
                <div>
                  <!-- <h3>{{index}}</h3> -->
                  <h3>{{index}}</h3>
                </div>
              </template>
              <!-- <v-card>
              <v-card-text class="grey lighten-3 black--text">-->
              <v-tabs grow slider-color="yellow">
                <v-tab v-for="(r,i) in room" :key="i">{{r.room_type}}</v-tab>
                <v-tabs-items>
                  <v-tab-item v-for="(r,i) in room" :key="i">
                    <v-container class="grey lighten-3">
                      <v-layout row>
                        <v-spacer></v-spacer>
                        <v-btn @click="showEdit(index,r.id)">edit</v-btn>
                        <v-btn @click="deleteConfirm(index,r.id)">delete</v-btn>
                        <v-dialog width="30%" v-model="confirmDialog">
                          <v-card>
                            <v-card-title>
                              <h3>Confirmation</h3>
                            </v-card-title>
                            <v-card-text>Do you really want to delete this Room</v-card-text>
                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn @click="cancel">cancel</v-btn>
                              <v-btn @click="deleteRoom">delete</v-btn>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
                      </v-layout>

                      <v-layout>
                        <v-flex xs3 offset-xs1>
                          <h5>Room Name</h5>
                        </v-flex>
                        <v-flex xs8>{{r.room_name}}</v-flex>
                      </v-layout>
                      <v-layout>
                        <v-flex xs3 offset-xs1>
                          <h5>Room price</h5>
                        </v-flex>
                        <v-flex xs8>{{r.price}} $</v-flex>
                      </v-layout>
                      <v-layout>
                        <v-flex xs3 offset-xs1>
                          <h5>Room Size</h5>
                        </v-flex>
                        <v-flex xs8>{{r.room_size}} m²</v-flex>
                      </v-layout>
                      <v-layout align-center>
                        <v-flex xs3 offset-xs1>
                          <h5>Room maximum capacity</h5>
                        </v-flex>
                        <v-flex xs8 align-items-center>
                          {{r.max_adult_amount}} x
                          <i class="fas fa-male fa-2x"></i>
                          {{r.max_child_amount}} x
                          <i class="fas fa-child"></i>
                          <span v-if="r.free_child_amount!=0 && r.child_age!=0">
                            ({{r.free_child_amount}} child under {{r.child_age}} years stay
                            <span
                              class="green--text"
                            >Free!!!</span>)
                          </span>
                        </v-flex>
                      </v-layout>
                      <v-layout>
                        <v-flex xs3 offset-xs1>
                          <h5>Number of rooms this type</h5>
                        </v-flex>
                        <v-flex xs8>{{r.amount}}</v-flex>
                      </v-layout>
                      <!-- <v-divider></v-divider>
                      <h3>Services</h3>
                      <v-layout>
                        {{r.service}}
                        <v-flex
                          v-for="(service,index) in r.service"
                          :key="index"
                          xs3
                          offset-xs1
                        ><h6><i class="mx-3 fas" :class="icon = 'fa-'+service.icon"></i>{{service.name}}</h6></v-flex>
                      </v-layout>-->
                    </v-container>
                  </v-tab-item>
                </v-tabs-items>
              </v-tabs>
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-card>
      </v-container>
    </v-layout>
  </div>
</template>
<script>
export default {
  props: {
    // hotelId: {
    //   type: Number
    // },
    arrayService: {
      type: Array
    },
    api_token: {
      type: String
    }
  },
  watch: {
    panelIndex: function() {
      // console.log(this.panelIndex);
    },
    // hotelId: function() {
    //   this.hotelId = localStorage.getItem("hotelId");
    // }
  },
  data: function() {
    return {
      popout: false,
      panelIndex: -1,
      dialog: false,
      formTitle: "",
      showAmount: false,
      showFreeAmount: false,
      room: {
        room_name: "",
        amount: 1,
        description: "",
        max_adult_amount: 1,
        max_child_amount: 0,
        free_child_amount: 0,
        child_age: 13,
        room_size: 1,
        price: 1
      },
      bed: [
        {
          amount: 1,
          bedTypeId: 1
        }
      ],
      arrayRoom: [],
      arrayRoomMode: [],
      defaultRoomMode: 1,
      arrayRoomType: [],
      defaultRoomType: 1,
      arrayServiceChoose: [],
      roomTypeDisable: true,
      arrayBedType: [],
      defaultBedType: 1,
      amount: 1,
      total: 1,
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
      dictionary: {
        custom: {
          roomName: {
            required: "The room name field is required"
          },
          numberOfRoom: {
            numeric:
              "The Number of room type field only accept positive integer"
          },
          roomSize: {
            decimal: "The Room Size field only accept positive float"
          },
          price: {
            decimal: "The Price field only accept positive float"
          }
        }
      },
      confirmDialog: false,
      roomIndex: 0,
      roomId: 0,
      roomType: 0,
      hotelId: this.$route.query.hotelId,
    };
  },
  created() {
    this.$emit("chooseHotel", this.hotelId);
    this.initialize();
  },
  mounted() {
    this.$validator.localize("en", this.dictionary);
  },
  methods: {
    chooseRoomMode: function() {
      this.roomTypeDisable = false;
      console.log(this.hotelId);
      axios
        .get("http://localhost:8000/api/manager/room-type", {
          params: {
            hotelId: this.hotelId,
            roomModeId: this.defaultRoomMode
          },
          headers: {
            Authorization: "Bearer " + this.api_token
          }
        })
        .then(response => {
          this.arrayRoomType = response.data.data;
          console.log(response);
        })
        .catch(function(error) {
          console.log(error.response);
        });
      this.showAmount = false;
      if (this.defaultRoomMode == 2) {
        this.room.max_adult_amount = 2;
      } else if (this.defaultRoomMode != 1) {
        this.room.max_adult_amount = 2;
        this.showAmount = true;
      }
      // console.log(this.defaultRoomMode);
    },
    chooseMaxChildAmount: function() {
      this.showFreeAmount = false;
      this.room.free_child_amount = this.room.max_child_amount;
      if (this.room.max_child_amount != 0) {
        this.showFreeAmount = true;
      }
    },
    test: function() {
      console.log(this.amount);
    },
    addNewTitle: function() {
      this.formTitle = "New Room";
      this.$refs.formNewRoom.reset();
    },
    initialize: function() {
      this.chooseRoomMode();
      axios
        .get("http://localhost:8000/api/manager/room", {
          params: {
            hotelId: this.hotelId
          },
          headers: {
            Authorization: "Bearer " + this.api_token
          }
        })
        .then(response => {
          if (response.data.status == true) {
            console.log(" array room : " + response);
            this.arrayRoom = response.data.data;
          }
          console.log(this.arrayRoom);
        })
        .catch(function(error) {
          console.log(error.response);
        });
      axios
        .get("http://localhost:8000/api/manager/room-mode", {
          headers: {
            Authorization: "Bearer " + this.api_token
          }
        })
        .then(response => {
          this.arrayRoomMode = response.data;
        })
        .catch(function(error) {
          console.log(error.response);
        });

      axios
        .get("http://localhost:8000/api/manager/bed-type", {
          headers: {
            Authorization: "Bearer " + this.api_token
          }
        })
        .then(response => {
          this.arrayBedType = response.data;
        })
        .catch(function(error) {
          console.log(error.response);
        });
    },
    addBed: function() {
      var newBed = {
        amount: 1,
        bedTypeId: 1
      };
      this.bed.push(newBed);
    },
    deleteBedType: function(index) {
      this.bed.splice(index, 1);
    },
    addNewRoom: function() {
      console.log(this.bed);
      this.$validator.validate().then(valid => {
        if (!valid) {
        } else {
          axios({
            method: "post",
            url: "http://localhost:8000/api/manager/room",
            data: {
              hotel_id: this.hotelId,
              room_name: this.room.room_name,
              description: this.room.description,
              price: this.room.price,
              amount: this.room.amount,
              max_adult_amount: this.room.max_adult_amount,
              max_child_amount: this.room.max_child_amount,
              room_size: this.room.room_size,
              room_mode_id: this.defaultRoomMode,
              room_type_id: this.defaultRoomType,
              bed: this.bed
            },
            headers: {
              Authorization: "Bearer " + this.api_token
            }
          })
            .then(response => {
              console.log(this.arrayRoom);
              console.log(response);
            })
            .catch(error => {
              console.log(error.response);
            });
        }
      });
    },
    deleteConfirm: function(roomType, roomId) {
      this.confirmDialog = true;
      this.roomId = roomId;
      this.roomType = roomType;
    },
    cancel: function() {
      this.dialog = false;
      this.confirmDialog = false;
    },
    deleteRoom: function() {
      axios({
        method: "delete",
        url: "http://localhost:8000/api/manager/room/" + this.roomId,
        data: {
          hotelId: this.hotelId
        },
        headers: {
          Authorization: "Bearer " + this.api_token
        }
      })
        .then(response => {
          for (let [key, value] of Object.entries(this.arrayRoom)) {
            if (key === this.roomType) {
              for (var i = 0; i < value.length; i++) {
                if (value[i].id == this.roomId) {
                  value.splice(i, 1);
                }
              }
              this.confirmDialog = false;
              if (value.length < 1) {
                delete this.arrayRoom[key];
              }
            }
          }
        })
        .catch(error => {
          console.log(error.response);
        });
    },
    showEdit: function(roomType, roomId) {
      this.dialog = true;
      this.formTitle = "Edit Room";
      this.roomId = roomId;
      axios
        .get("http://localhost:8000/api/manager/room/" + roomId, {
          params: {
            hotelId: this.hotelId
          },
          headers: {
            Authorization: "Bearer " + this.api_token
          }
        })
        .then(response => {
          if (response.data.status == true) {
            var room = response.data.data;
            this.room.room_name = room.room_name;
            this.room.amount = room.amount;
            this.room.description = room.description;
            this.room.max_adult_amount = room.max_adult_amount;
            this.room.max_child_amount = room.max_child_amount;
            this.room.child_age = room.child_age;
            this.room.free_child_amount = room.free_child_amount;
            this.room.room_size = room.room_size;
            this.room.price = room.price;
            this.defaultRoomMode = room.room_mode_id;
            this.defaultRoomType = room.room_type_id;
            // if (response.data.bed.length > 0) {
            //   this.bed = response.data.bed;
            // }
            this.bed = response.data.bed;
          }
        })
        .catch(function(error) {
          console.log(error.response);
        });
    },
    editRoom: function(roomType, roomId) {
      axios({
        method: "put",
        url: "http://localhost:8000/api/manager/room/" + roomId,
        data: {
          hotel_id: this.hotelId,
          room_name: this.room.room_name,
          description: this.room.description,
          price: this.room.price,
          amount: this.room.amount,
          max_adult_amount: this.room.max_adult_amount,
          max_child_amount: this.room.max_child_amount,
          room_size: this.room.room_size,
          room_mode_id: this.defaultRoomMode,
          room_type_id: this.defaultRoomType,
          bed: this.bed
        },
        headers: {
          Authorization: "Bearer " + this.api_token
        }
      })
        .then(response => {
          for (let [key, value] of Object.entries(this.arrayRoom)) {
            console.log(key);
            console.log(value);
            console.log(roomType);
          }
        })
        .catch(error => {
          console.log(error.response);
        });
    }
  }
};
</script>

