<template>
  <div>
    <v-data-table :headers="headers" :items="bookingList" class="elevation-1">
      <template v-slot:items="booking" class="setHeight">
        <td class="text-xs-center">{{booking.item.id}}</td>
        <td class="text-xs-center">{{booking.item.room_name}}</td>
        <td class="text-xs-center">{{booking.item.check_in}}</td>
        <td class="text-xs-center">{{booking.item.check_out}}</td>
        <td class="text-xs-center">{{booking.item.room_price * booking.item.room_amount}} $</td>
        <td class="text-xs-center">
          <!-- <v-btn round color="warning" :ripple="false" depressed small></v-btn> -->
          <span v-if="booking.item.status_id == 1">
            <v-chip disabled color="warning" text-color="white">{{booking.item.status}}</v-chip>
          </span>
          <span v-else-if="booking.item.status_id == 2">
            <v-chip disabled color="blue" text-color="white">Wait for payment</v-chip>
          </span>
          <span v-else-if="booking.item.status_id == 3">
            <v-chip disabled color="red" text-color="white">declined</v-chip>
          </span>
          <span v-else-if="booking.item.status_id == 4">
            <v-chip disabled color="success" text-color="white">completed</v-chip>
          </span>
        </td>
        <td class="text-xs-center action-width">
          <div>
            <v-layout row wrap justify-center>
              <v-flex md12>
                <v-dialog v-model="dialog" max-width="80%">
                  <template v-slot:activator="{ on }">
                    <v-btn
                      round
                      color="primary"
                      small
                      depressed
                      v-on="on"
                      @click="ShowDetailBooking(booking.item)"
                    >detail</v-btn>
                  </template>
                  <v-card>
                    <v-card-text>
                      <h5>Customer's info</h5>
                      <v-layout row wrap>
                        <v-flex md2 offset-md1>Name</v-flex>
                        <v-flex md9>{{detailBooking.contact_name}}</v-flex>
                      </v-layout>
                      <v-layout row wrap>
                        <v-flex md2 offset-md1>Email</v-flex>
                        <v-flex md9>{{detailBooking.contact_email}}</v-flex>
                      </v-layout>
                      <v-layout row wrap>
                        <v-flex md2 offset-md1>Phone</v-flex>
                        <v-flex md9>{{detailBooking.contact_phone}}</v-flex>
                      </v-layout>
                      <v-layout row wrap>
                        <v-flex md2 offset-md1>Address</v-flex>
                        <v-flex md9>{{detailBooking.contact_address}}</v-flex>
                      </v-layout>
                      <v-layout row wrap>
                        <v-flex md2 offset-md1>Special request</v-flex>
                        <v-flex md9>{{detailBooking.special_request}}</v-flex>
                      </v-layout>
                      <v-divider></v-divider>
                      <h5>Booking's Detail</h5>
                      <v-layout row wrap>
                        <v-flex md2 offset-md1>Room name</v-flex>
                        <v-flex md9>{{detailBooking.room_name}}</v-flex>
                      </v-layout>
                      <v-layout row wrap>
                        <v-flex md2 offset-md1>Room price</v-flex>
                        <v-flex md9>{{detailBooking.room_price}}</v-flex>
                      </v-layout>
                      <v-layout row wrap>
                        <v-flex md2 offset-md1>Room amount</v-flex>
                        <v-flex md9>{{detailBooking.room_amount}}</v-flex>
                      </v-layout>
                      <v-layout row wrap>
                        <v-flex md2 offset-md1>check in</v-flex>
                        <v-flex md9>{{detailBooking.check_in}}</v-flex>
                      </v-layout>
                      <v-layout row wrap>
                        <v-flex md2 offset-md1>check out</v-flex>
                        <v-flex md9>{{detailBooking.check_out}}</v-flex>
                      </v-layout>
                      <v-layout row wrap>
                        <v-flex md2 offset-md1>room Id</v-flex>
                        <v-flex md9>{{detailBooking.room_id}}</v-flex>
                      </v-layout>
                      <v-layout row wrap>
                        <v-flex md2 offset-md1>Payment method</v-flex>
                        <v-flex md9>{{detailBooking.payment_method}}</v-flex>
                      </v-layout>
                      <v-divider></v-divider>
                      <!-- {{detailBooking.hotel_name}}
                  {{detailBooking.room_name}}
                  {{detailBooking.room_price}}
                  {{detailBooking.room_amount}}
                  {{detailBooking.check_in}}
                  {{detailBooking.check_out}}
                  {{detailBooking.room_id}}
                  {{detailBooking.customer_id}}
                  {{detailBooking.status_id}}
                      {{detailBooking.payment_method}}-->
                    </v-card-text>
                  </v-card>
                </v-dialog>
              </v-flex>
              <span row wrap v-if="booking.item.status_id == 1">
                <v-flex md12>
                  <v-btn
                    round
                    depressed
                    small
                    color="success"
                    @click="acceptBooking(booking.item)"
                  >accept</v-btn>
                </v-flex>
                <v-flex md12>
                  <v-btn
                    round
                    depressed
                    small
                    color="error"
                    @click="declineBooking(booking.item)"
                  >decline</v-btn>
                </v-flex>
              </span>
              <span v-else-if="booking.item.status_id == 2">
                <v-flex md12>
                  <v-btn
                    round
                    depressed
                    small
                    color="blue"
                    class="white--text"
                    @click="confirmBooking(booking.item)"
                  >Confirm payment</v-btn>
                </v-flex>
              </span>
              <span v-else-if="booking.item.status_id == 4">
                <v-flex md12>
                  <v-btn
                    round
                    depressed
                    small
                    color="red"
                    class="white--text"
                    @click="cancelBooking(booking.item)"
                  >cancel</v-btn>
                </v-flex>
              </span>
            </v-layout>
          </div>
        </td>
      </template>
    </v-data-table>
  </div>
</template>
<script>
export default {
  props: {
    api_token: {
      type: String
    }
  },
  data: function() {
    return {
      dialog: false,
      detailBooking: {
        hotel_name: ""
      },
      bookingList: [],
      headers: [
        { text: "Id", value: 0, sortable: false, align: "center" },
        { text: "Room Name", value: 0, sortable: false, align: "center" },
        { text: "Check in", value: 0, sortable: false, align: "center" },
        { text: "Check out", value: 0, sortable: false, align: "center" },
        { text: "Total price", value: 0, sortable: false, align: "center" },
        { text: "status", value: 0, sortable: false, align: "center" },
        { text: "Action", value: 0, sortable: false, align: "center" }
      ],
      hotelId: this.$route.query.hotelId
    };
  },
  created() {
    this.$emit("chooseHotel", this.hotelId);
    this.initialize();
  },
  methods: {
    initialize: function() {
      axios({
        method: "get",
        url: "http://localhost:8000/api/manager/all-booking",
        headers: {
          Authorization: "Bearer " + this.api_token
        },
        params: {
          hotelId: this.hotelId
        }
      })
        .then(response => {
          console.log(response.data);
          if (response.status == 401) {
            this.logout;
          }
          if (response.data.status == true) {
            this.bookingList = response.data.booking;
          }
        })
        .catch(error => {
          console.log(error.response);
        });
    },
    ShowDetailBooking: function(item) {
      console.log(item);
      var index = this.bookingList.indexOf(item);
      this.detailBooking = this.bookingList[index];
    },
    acceptBooking : function(booking){
        axios({
        method: "post",
        url: "http://localhost:8000/api/manager/accept",
        headers: {
          Authorization: "Bearer " + this.api_token
        },
        data : {
            bookingId : booking.id
        }
      })
        .then(response => {
          if (response.status == 401) {
            this.logout;
          }
          console.log(response);
          booking.status_id = response.data.data;
        })
        .catch(error => {
          console.log(error.response);
        });
    },
    declineBooking : function(booking){
        axios({
        method: "post",
        url: "http://localhost:8000/api/manager/decline",
        headers: {
          Authorization: "Bearer " + this.api_token
        },
        data : {
            bookingId : booking.id
        }
      })
        .then(response => {
          if (response.status == 401) {
            this.logout;
          }
          console.log(response);
          booking.status_id = response.data.data;
        })
        .catch(error => {
          console.log(error.response);
        });
    },
    confirmBooking : function(booking){
        axios({
        method: "post",
        url: "http://localhost:8000/api/manager/confirm",
        headers: {
          Authorization: "Bearer " + this.api_token
        },
        data : {
            bookingId : booking.id
        }
      })
        .then(response => {
          if (response.status == 401) {
            this.logout;
          }
          console.log(response);
          booking.status_id = response.data.data;
        })
        .catch(error => {
          console.log(error.response);
        });
    },
    cancelBooking : function(booking){
        axios({
        method: "post",
        url: "http://localhost:8000/api/manager/cancel",
        headers: {
          Authorization: "Bearer " + this.api_token
        },
        data : {
            bookingId : booking.id
        }
      })
        .then(response => {
          if (response.status == 401) {
            this.logout;
          }
          console.log(response);
          booking.status_id = response.data.data;
        })
        .catch(error => {
          console.log(error.response);
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
          if (response.status == 401) {
            this.logout;
          }
          console.log(response);
        })
        .catch(error => {
          console.log(error.response);
        });
      localStorage.removeItem("api_token");
      this.api_token = null;
      location.href = "login";
    }
  }
};
</script>
<style scoped>
.action-width {
  width: 100px;
}
</style>


