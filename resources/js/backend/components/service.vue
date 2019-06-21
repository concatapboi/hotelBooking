<template>
  <div>
    <v-container>
      <v-card class="blue-grey darken-4 p-2">
        <v-expansion-panel v-model="panel" v-bind:popout="popout" expand class="elevation-0">
          <h1 class="white--text">Service</h1>
          <v-expansion-panel-content
            v-for="(service,index) in services"
            :key="index"
            class
            hide-actions
          >
            <template v-slot:header>
              <v-layout row align-content-center>
                <v-flex xs11 align-self-center>
                  <i class="m-2 fas" :class="icon = 'fa-'+service.service.icon"></i>
                  <span class="title">{{service.service.name}}</span>
                </v-flex>
                <v-flex xs1 align-self-center>
                  <v-switch
                    color="primary"
                    v-model="panel[index]"
                    :value="panel[index]"
                    @click.native.stop
                    @change="chooseService(index,service.service.id)"
                  ></v-switch>
                  <!-- <v-btn @click="choose">asd</v-btn> -->
                </v-flex>
              </v-layout>
            </template>
            <v-container class="grey lighten-3">
              <v-layout justify-center row wrap>
                <v-radio-group v-model="service.room.radio" row>
                  <v-radio color="primary" @change="chooseAll(index,service.service.id)" label="All room modes" value="all"></v-radio>
                  <v-radio
                    color="primary"
                    label="Some room modes"
                    value="some"
                    @change="chooseSome(service.service.id)"
                  ></v-radio>
                </v-radio-group>
                <v-select
                  dense
                  chips
                  multiple
                  outline
                  v-if="service.room.radio =='some'"
                  v-model="service.room.chosenRoom"
                  :items="arrayRoomType"
                  item-text="name"
                  item-value="id"
                  label="Choose room(s)"
                  @change="chooseRoom(index,service.service.id)"
                ></v-select>
              </v-layout>
              <v-layout wrap>
                <span xs-4 offset-xs4></span>
                <v-flex xs-4></v-flex>
              </v-layout>
            </v-container>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-card>
      <!-- <h1>Services</h1> -->
      <!-- <v-layout row wrap v-for="(service,index) in arrayService" :key="index">
        <v-flex xs12>{{service.name}}</v-flex>
      </v-layout>-->
    </v-container>
    
  </div>
</template>
<script>
export default {
  props: {
    hotelId: {
      type: Number
    },
    api_token :{
      type : String
    }
  },
  data: function() {
    return {
      popout: false,

      services: [],
      panel: [false, false, false, false, false],
      arrayRoomType: [],
      choosenRoom: [],
      radioGroup: [],
      firsttime: false
    };
  },
  created() {
    this.initialize();
  },
  watch: {
    panel: function(newArray, oldArray) {
      if (this.firsttime == false) {
        for (var i = 0; i < newArray.length; i++) {
          if (newArray[i] != oldArray[i]) {
            var index = i;
            var serviceId = this.services[i].service.id;
          }
        }
        this.chooseService(index, serviceId);
      }
      if (this.firsttime == true) {
        this.firsttime = false;
      }
    }
  },
  methods: {
    initialize: function() {
      this.firsttime = true;
      axios
        .get("http://localhost:8000/api/manager/service", {
          params: {
            api_token: 123,
            hotelId: this.hotelId
          }
        })
        .then(response => {
          if (response.data.status == true) {
            console.log(response);
            this.services = response.data.data;
            this.panel = response.data.panel;
          }
        })
        .catch(function(error) {
          console.log(error);
        });
      axios
        .get("http://localhost:8000/api/manager/room-types", {
          params: {
            api_token: 123,
            hotelId: this.hotelId
          }
        })
        .then(response => {
          // console.log(response);
          this.arrayRoomType = response.data.data;
          console.log(this.arrayRoomType);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    chooseService: function(index, serviceId) {
      if (this.panel[index] === null) {
        this.panel[index] = false;
      }
      if (this.panel[index] == true) {
        console.log(this.services[index].room.chosenRoom);
        axios({
          method: "post",
          url: "http://localhost:8000/api/manager/add-service",
          params: {
            hotelId: this.hotelId,
            api_token: 123,
            serviceId: serviceId,
            chosenRoom: this.services[index].room.chosenRoom,
            radio: this.services[index].room.radio
          }
        })
          .then(response => {
            console.log(response);
          })
          .catch(error => {
            console.log(error);
          });
      } else {
        this.chooseSome(serviceId);
      }
    },
    chooseAll: function(index,serviceId) {
      axios({
          method: "post",
          url: "http://localhost:8000/api/manager/add-all-room",
          params: {
            hotelId: this.hotelId,
            api_token: 123,
            serviceId: serviceId,
          }
        })
          .then(response => {
            console.log(response);
          })
          .catch(error => {
            console.log(error);
          });
    },
    chooseRoom: function(index,serviceId) {
      this.chooseSome(serviceId);
      axios({
          method: "post",
          url: "http://localhost:8000/api/manager/add-service-room",
          params: {
            hotelId: this.hotelId,
            api_token: 123,
            serviceId: serviceId,
            chosenRoom: this.services[index].room.chosenRoom,
          }
        })
          .then(response => {
            console.log(response);
          })
          .catch(error => {
            console.log(error);
          });
    },
    chooseSome: function(serviceId) {
      axios({
          method: "delete",
          url: "http://localhost:8000/api/manager/remove-service-room",
          params: {
            hotelId: this.hotelId,
            api_token: 123,
            serviceId: serviceId,
          }
        })
          .then(response => {
            console.log(response);
          })
          .catch(error => {
            console.log(error);
          });
    }
  }
};
</script>

