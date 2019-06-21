<template>
  <v-layout row wrap>
    <v-flex shrink md12>
      <v-img :aspect-ratio="16/2" src="/blog/img/slider/default.png" class="pt-5">
        <v-layout row wrap justify-center>
          <v-flex md10 class="text-md-center">
            <span class="title text-uppercase font-weight-black">our hotels</span>
          </v-flex>
          <v-flex md10 class="text-md-center">
            <router-link :to="{name:'home'}">Home</router-link>&nbsp;/&nbsp;Our Hotels
          </v-flex>
        </v-layout>
      </v-img>
      <v-layout
        row
        wrap
        justify-center
        align-center
        class="my-1"
        v-for="(hotel,index) in data"
        :key="index"
      >
        <v-flex md3>
          <v-img :aspect-ratio="1/1" src="/blog/img/slider/default.png"></v-img>
        </v-flex>
        <v-flex md8>
          <v-card light flat tile>
            <v-card-title>
              <span class="display-3 font-weight-bold">{{hotel.item.name}}</span>
              <v-card-text class="headline px-0">{{hotel.item.description}}</v-card-text>
            </v-card-title>
            <v-card-text>
              <a :href="'#'+hotel.item.id" v-on:click="detailOf(hotel)">
                <i class="fas fa-angle-right"></i>&nbsp;More...
              </a>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>
    </v-flex>
    <v-dialog
      v-model="dialog.state"
      fullscreen
      hide-overlay
      transition="dialog-bottom-transition"
      scrollable
    >
      <v-card tile light>
        <v-toolbar card flat dark color="teal">
          <v-btn icon dark v-on:click="dialog.state = false">
            <v-icon>close</v-icon>
          </v-btn>
          <v-toolbar-title class="text-uppercase">{{dialog.data.item.name}}</v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
        <v-card-text class="py-0">
          <v-layout row wrap>
            <v-flex md3 class="px-3">
              <v-img :aspect-ratio="4/3" src="/blog/img/slider/default.png" class="my-2">
                <v-layout row wrap justify-center align-center fill-height>
                  <v-flex md10>
                    <v-rating
                      v-model="dialog.data.item.stars_num"
                      color="#fff200"
                      background-color="grey darken-1"
                      empty-icon="$vuetify.icons.ratingFull"
                      half-incrementss
                      readonly
                      small
                    ></v-rating>
                  </v-flex>
                </v-layout>
              </v-img>
              <v-layout row wrap class="mb-2 ml-1" align-center>
                <v-flex md1>
                  <i class="fas fa-thumbs-up teal--text fa-lg"></i>
                </v-flex>
                <v-flex md4>
                  <span class="font-weight-black">Review Points:</span>
                </v-flex>
                <v-flex md7 class="pl-2">
                  <span class="font-weight-black">{{dialog.data.item.review_point}}</span>
                </v-flex>
              </v-layout>
              <v-layout row wrap class="mb-2 ml-1" align-center>
                <v-flex md1>
                  <i class="fas fa-phone teal--text fa-lg"></i>
                </v-flex>
                <v-flex md4>
                  <span class="font-weight-black">Phone Number:</span>
                </v-flex>
                <v-flex md7 class="pl-2">
                  <span class="font-weight-black">{{dialog.data.item.phone_number}}</span>
                </v-flex>
              </v-layout>
              <v-layout row wrap class="mb-2 ml-1" align-center>
                <v-flex md1>
                  <i class="fas fa-envelope teal--text fa-lg"></i>
                </v-flex>
                <v-flex md4>
                  <span class="font-weight-black">Email:</span>
                </v-flex>
                <v-flex md7 class="pl-2">
                  <span class="font-weight-black">xxx@gmail.com</span>
                </v-flex>
              </v-layout>
              <v-layout row wrap class="mb-2 ml-1" align-center>
                <v-flex md1>
                  <i class="fas fa-fax teal--text fa-lg"></i>
                </v-flex>
                <v-flex md4>
                  <span class="font-weight-black">Fax Number:</span>
                </v-flex>
                <v-flex md7 class="pl-2">
                  <span class="font-weight-black">{{dialog.data.item.fax_number}}</span>
                </v-flex>
              </v-layout>
              <v-layout row wrap class="mb-2 ml-1" align-center>
                <v-flex md1>
                  <i class="fas fa-dollar-sign teal--text fa-lg"></i>
                </v-flex>
                <v-flex md4>
                  <span class="font-weight-black">Tax Code:</span>
                </v-flex>
                <v-flex md7 class="pl-2">
                  <span class="font-weight-black">{{dialog.data.item.tax_code}}</span>
                </v-flex>
              </v-layout>
              <v-layout row wrap class="mb-2 ml-1" align-center>
                <v-flex md1>
                  <i class="fas fa-map-marker-alt teal--text fa-lg"></i>
                </v-flex>
                <v-flex md4>
                  <span class="font-weight-black">Address:</span>
                </v-flex>
                <v-flex md7 class="pl-2">
                  <span class="font-weight-black">tp Ho Chi Minh</span>
                </v-flex>
              </v-layout>
              <v-btn depressed dark>follow</v-btn>
            </v-flex>
            <v-flex md9 class="pa-3">
              <v-tabs centered grow color="grey lighten-2" light class="ma-1">
                <v-tabs-slider color="black"></v-tabs-slider>
                <v-tab href="#tab-1">description</v-tab>
                <v-tab href="#tab-2">map</v-tab>
                <v-tab href="#tab-3">rooms</v-tab>
                <v-tab-item value="tab-1">
                  <v-card light flat tile>
                    <v-layout row wrap class="mx-0 mt-1">
                      <v-flex md12>
                        <v-card-title class="title font-weight-black">{{dialog.data.item.description}}</v-card-title>
                        <v-card-text>
                          CEO:
                          <a href="#">Nguyen Tran Hoang Thang</a>
                        </v-card-text>
                        <v-card-actions>
                          <a href="https://www.instagram.com/" target="_blank">
                            <i class="fab fa-instagram fa-4x black--text mr-3"></i>
                          </a>
                          <a href="https://www.facebook.com/" target="_blank">
                            <i class="fab fa-facebook-f fa-4x black--text mr-3"></i>
                          </a>
                          <a href="https://www.youtube.com/" target="_blank">
                            <i class="fab fa-youtube fa-4x black--text mr-3"></i>
                          </a>
                          <a href="https://www.twitter.com/" target="_blank">
                            <i class="fab fa-twitter fa-4x black--text mr-3"></i>
                          </a>
                          <a href="https://plus.google.com/" target="_blank">
                            <i class="fab fa-google-plus-g fa-4x black--text mr-3"></i>
                          </a>
                        </v-card-actions>
                      </v-flex>
                      <v-flex md3 class="pa-1" v-for="(item,i) in 7" :key="i">
                        <v-img :aspect-ratio="1/1" src="/blog/img/slider/default.png"></v-img>
                      </v-flex>
                    </v-layout>
                  </v-card>
                </v-tab-item>
                <v-tab-item value="tab-2">
                  <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.9551334403727!2d106.67572371411624!3d10.7379414628408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f62a90e5dbd%3A0x674d5126513db295!2zxJDhuqFpIEjhu41jIEPDtG5nIE5naOG7hyBTw6BpIEfDsm4!5e0!3m2!1svi!2s!4v1560999432503!5m2!1svi!2s"
                    width="100%"
                    height="500"
                    frameborder="0"
                    style="border:0"
                    allowfullscreen
                  ></iframe>
                </v-tab-item>
                <v-tab-item value="tab-3">
                  <v-card light flat tile>
                    <v-layout row wrap class="mx-0 mt-1">
                      <v-flex md8>
                        <v-layout row wrap class="mx-0">
                          <v-flex md3>
                            <v-img :aspect-ratio="1/1" src="/blog/img/slider/default.png"></v-img>
                          </v-flex>
                          <v-flex md9></v-flex>
                        </v-layout>
                      </v-flex>
                      <v-flex md4>lojc</v-flex>
                    </v-layout>
                  </v-card>
                </v-tab-item>
              </v-tabs>
            </v-flex>
          </v-layout>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
export default {
  data() {
    return {
      data: [],
      dialog: {
        state: false,
        data: {
          item:[],
          type:[],
          followers:0
        }
      }
    };
  },
  created() {
    this.getData();
  },
  watch: {},
  methods: {
    getData: function() {
      axios({
        method: "get",
        url: "http://localhost:8000/api/hotel",
        params: {}
      }).then(res => {
        console.log(res.data.data[0].item.name);
        if (res.data.status) {
          this.data = res.data.data;
          return;
        }
      });
    },
    detailOf: function(val) {
      this.dialog.state = true;
      this.dialog.data = val;
      console.log(this.dialog.data.item.name);
    }
  }
};
</script>

<style scoped>
.pointer {
  cursor: pointer;
}
</style>