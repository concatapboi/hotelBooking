<template>
  <div>
    <v-data-table :headers="headers" :items="bookingList" class="elevation-1">
      <template v-slot:items="booking">
        <td class="text-xs-center">{{booking.item.id}}</td>
        <td class="text-xs-center">{{booking.item.room_name}}</td>
        <td class="text-xs-center">{{booking.item.check_in}}</td>
        <td class="text-xs-center">{{booking.item.check_out}}</td>
        <td class="text-xs-center">{{booking.item.room_price * booking.item.room_amount}}</td>
        <td class="text-xs-center">
          <v-btn color="warning" :ripple="false" depressed small>{{booking.item.status}}</v-btn>
        </td>
        <td class="text-xs-center">
          <div>
            <v-dialog v-model="dialog" max-width="80%">
              <template v-slot:activator="{ on }">
                <v-btn
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

                    <!-- {{detailBooking.contact_email}}
                    {{detailBooking.contact_phone}}
                    {{detailBooking.contact_address}}
                    {{detailBooking.special_request}}
                    {{detailBooking.contact_address}}-->
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
            <v-btn depressed small color="success ">accept</v-btn>
            <v-btn depressed small color="error">cancel</v-btn>
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

