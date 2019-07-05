<template>
  <v-layout row wrap>
    <v-flex shrink md12>
      <v-img :aspect-ratio="16/5" src="/blog/img/slider/slider.png">
        <v-layout row wrap justify-center align-center fill-height>
          <v-flex md8 class="pa-1 black">
            <v-form ref="form">
              <v-layout row wrap class="search-form text-xs-center" align-center justify-center>
                <v-flex md4 class="ma-4 text-xs-left">
                  <span class="title">Place</span>
                  <v-text-field
                    color="teal"
                    outline
                    type="text"
                    v-model="placeVal"
                    label="Where do you want to go"
                  ></v-text-field>
                </v-flex>
                <v-flex md2 class="ma-4 text-xs-left">
                  <span class="title">Check-in</span>
                  <v-menu
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
                      <v-text-field
                        outline
                        color="teal"
                        type="text"
                        v-model="checkInFormattedVal"
                        hint="DD/MM/YYYY format"
                        persistent-hint
                        readonly
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker no-title v-model="checkInVal"></v-date-picker>
                  </v-menu>
                </v-flex>
                <v-flex md2 class="ma-4 text-xs-left">
                  <span class="title">Check-out</span>
                  <v-menu
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
                      <v-text-field
                        outline
                        color="teal"
                        type="text"
                        v-model="checkOutFormattedVal"
                        hint="DD/MM/YYYY format"
                        persistent-hint
                        readonly
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker no-title v-model="checkOutVal"></v-date-picker>
                  </v-menu>
                </v-flex>
                <v-flex md1 class="ma-4 text-xs-left">
                  <v-btn
                    color="teal"
                    dark
                    icon
                    large
                    depressed
                    style="width:60px; height:60px;"
                    v-on:click="search"
                  >
                    <v-icon large>search</v-icon>
                  </v-btn>
                </v-flex>
              </v-layout>
            </v-form>
          </v-flex>
        </v-layout>
      </v-img>
      <v-layout row wrap class="ma-4" justify-center align-center>
        <v-flex md6>
          <v-card light flat tile>
            <v-card-title>
              <span class="display-3 font-weight-bold">Welcome to Roberto</span>
              <v-card-text
                class="headline px-0"
              >Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi odio minima ea error iure esse enim deleniti voluptas tempora accusantium labore, molestiae, exercitationem consequatur quos culpa est laborum blanditiis a!</v-card-text>
            </v-card-title>
            <v-card-text>
              CEO:
              <a href="#">Nguyen Tran Hoang Thang</a>
            </v-card-text>
          </v-card>
        </v-flex>
        <v-flex md6>
          <v-layout row wrap>
            <v-flex md6 class="pa-1">
              <v-img :aspect-ratio="1/2" src="/blog/img/slider/default.png"></v-img>
            </v-flex>
            <v-flex md6 class="pa-1">
              <v-img class="mb-1" :aspect-ratio="1" src="/blog/img/slider/default.png"></v-img>
              <v-img :aspect-ratio="1" src="/blog/img/slider/default.png"></v-img>
            </v-flex>
          </v-layout>
        </v-flex>
        <v-flex md12 class="my-3">
          <v-img :aspect-ratio="16/2" src="/blog/img/slider/default.png"></v-img>
        </v-flex>
      </v-layout>
    </v-flex>
    <v-flex shrink md12></v-flex>
  </v-layout>
</template>

<script>
export default {
  props: {
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
      // slider: 1,
      placeVal: "",
      checkInVal: "",
      checkInFormattedVal: "",
      checkOutVal: "",
      checkOutFormattedVal: "",
    };
  },
  computed: {},
  watch: {
    placeVal:"loadSearchData",
    checkIn: "setSearchValue",
    checkInVal: "loadSearchData",
    checkIn: "setSearchValue",
    checkOutVal: "loadSearchData",
    checkOut: "setSearchValue",
  },
  created() {
    // window.setInterval(() => {
    //   if (this.slider == 5) {
    //     this.slider = 1;
    //   } else this.slider++;
    // }, 5000);
    this.setSearchValue();
  },
  methods: {
    loadSearchData: function() {
      this.$emit("loadSearchData", {
        place: this.placeVal,
        checkIn: this.checkInVal,
        checkInFormatted: this.checkInFormattedVal,
        checkOut: this.checkOutVal,
        checkOutFormatted: this.checkOutFormattedVal,
      });
    },
    search: function() {
      this.$router.push({ path: "searching" , query:{place:this.place.replace(/\s/g,'-'), check_in:this.checkIn, check_out:this.checkOut}});
    },
    setSearchValue: function() {
      this.placeVal = this.place;
      this.checkInVal = this.checkIn;
      this.checkOutVal = this.checkOut;
      this.checkInFormattedVal = this.checkInFormatted;
      this.checkOutFormattedVal = this.checkOutFormatted;
    }
  }
};
</script>

<style scoped>
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
.search-form {
  opacity: 0.9;
  background-color: #fff;
}
</style>
