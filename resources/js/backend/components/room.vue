<template>
  <div>
    <v-layout class="mx-3">
      <v-spacer></v-spacer>
      <v-dialog max-width="75%" scrollable v-model="dialog">
        <template v-slot:activator="{ on }">
          <v-btn class="primary" v-on="on" @click="addNewTitle">New Room Type</v-btn>
        </template>
        <v-layout>
          <v-flex>
            <v-card width="100%" class="p-5">
              <v-card-title class="text-xs-center">
                <h1>{{formTitle}}</h1>
              </v-card-title>
              <v-divider></v-divider>
              <v-card-text height="100px">
                <v-form ref="formNewHotel">
                  <v-layout row>
                    <v-text-field label="name"></v-text-field>
                  </v-layout>
                  <v-layout row>
                    <v-select label="Room mode"></v-select>
                    <v-select label="Room type"></v-select>
                    <v-select label="Bed type"></v-select>
                  </v-layout>
                </v-form>
              </v-card-text>
            </v-card>
          </v-flex>
        </v-layout>
      </v-dialog>
    </v-layout>
    <v-layout>
      <v-container>
        <!-- <v-img max-height="300px" max-width="300px" src="http://localhost:8000/images/room_no_data.png"></v-img>
        <h1>Let's create your first room !!!</h1>-->

        <v-expansion-panel v-model="panel" v-bind:popout="popout" expand class="text-xs-center">
          <v-expansion-panel-content>
            <template v-slot:header>
              <div>
                <h3>Rooms</h3>
              </div>
            </template>
            <v-container>
              <v-layout row wrap class="grey lighten-3 align-center justify-center">
                <v-flex xs12>
                  <v-img height="200px" contain src="http://localhost:8000/images/room_no_data.png"></v-img>
                </v-flex>
                <v-flex xs6 offset-sx3>
                  <h4>Please add the room type for your property ;) !!!</h4>
                </v-flex>
              </v-layout>
            </v-container>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-container>
    </v-layout>
  </div>
</template>
<script>
export default {
  props: {
    hotelId: {
      type: String
    }
  },
  data: function() {
    return {
      popout: false,
      room: 1,
      panel: [true],
      formTitle: ""
    };
  },
  created: {},
  methods: {
    addNewTitle: function() {
      this.formTitle = "New Room Type";
    },
    initialize: function() {}
  }
};
</script>

