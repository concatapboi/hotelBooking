<template>
  <v-layout row wrap>
    <v-flex shrink md7 v-if="flag.state">
      <v-layout class="pa-0 ma-0" v-if="couponCode.length>0 || expiredCoupponCode.length > 0">
        <v-flex md12 v-if="!addCode">
          <template>
            <v-card flat>
              <v-data-table
                :rows-per-page-items='[5,10,15,{"text":"$vuetify.dataIterator.rowsPerPageAll","value":-1}]'
                :headers="tblHeaders"
                :search="search"
                :items="data"
                class="elevation-0 border"
              >
                <template v-slot:items="c">
                  <tr>
                    <td></td>
                    <td class="border-left"></td>
                  </tr>
                </template>
                <template v-slot:expand="c">
                  <v-card flat tile light color="brown lighten-2">
                    <v-card-text></v-card-text>
                    <v-layout align-center class="pa-0 ma-1 border grey lighten-2" row wrap></v-layout>
                  </v-card>
                </template>
              </v-data-table>
            </v-card>
          </template>
        </v-flex>
        <v-flex v-else>
            <v-layout row wrap class="pa-0 ma-0" align-center>
                
            </v-layout>
        </v-flex>
      </v-layout>
      <v-layout class="pa-0 ma-0" justify-center align-center v-else>
        <div>
          <span>{{flag.text}}</span>
        </div>
      </v-layout>
    </v-flex>
    <v-flex md7 v-else>
      <v-layout align-center justify-center>
        <v-icon large color="brown">fas fa-circle-notch fa-spin</v-icon>
      </v-layout>
    </v-flex>
    <v-flex md4 offset-md1>
      <v-card light flat tile>
        <v-card-title>
          <div class="title my-3 text-uppercase font-weight-black">
            <v-icon color="brown">fiber_manual_record</v-icon>&nbsp;dành cho bạn
          </div>
          <v-layout row wrap class="pa-0 ma-2">
            <v-flex md12>
              <v-btn round depressed color="brown lighten-2" @click.stop=";" class="white--text">
                <v-icon small>add</v-icon>&nbsp;Tạo một mã
              </v-btn>
            </v-flex>
            <v-flex md12>
              <v-divider class="brown"></v-divider>
            </v-flex>
            <v-flex md12>
              <v-radio-group v-model="radio">
                <v-layout row wrap class="pa-0 ma-0">
                  <v-flex md12>
                    <span class="body-1 brown--text">Chọn danh sách:</span>
                  </v-flex>
                  <v-flex md6>
                    <v-layout row wrap class="pa-0 ma-0" align-center>
                      <v-flex md2>
                        <v-radio :value="0" @click="radio = 0" color="brown"></v-radio>
                      </v-flex>
                      <v-flex md8 offset-md1 class="caption">Đang diễn ra</v-flex>
                    </v-layout>
                  </v-flex>
                  <v-flex md6>
                    <v-layout row wrap class="pa-0 ma-0" align-center>
                      <v-flex md2>
                        <v-radio :value="1" @click="radio = 1" color="black"></v-radio>
                      </v-flex>
                      <v-flex md8 offset-md1 class="caption">Hết hạn</v-flex>
                    </v-layout>
                  </v-flex>
                  <v-flex md12>
                    <v-divider dark></v-divider>
                  </v-flex>
                  <v-flex md12>
                    <div>
                      <div>
                        <span class="body-1 orange--text">Tìm mã...</span>
                      </div>
                      <div>
                        <input type="text" v-model="code" class="pa-2 border" />
                      </div>
                      <div>
                        <span class="grey--text caption font-italic">*nhập tên mã coupon</span>
                      </div>
                    </div>
                  </v-flex>
                </v-layout>
              </v-radio-group>
            </v-flex>
          </v-layout>
        </v-card-title>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  data() {
    return {
      search: "",
      radio: 0,
      addCode: false,
      tblHeaders: [
        {
          text: "Danh sách khuyến mãi...",
          value: "title",
          align: "",
          class: "purple--text",
          sortable: false,
          width: ""
        },
        {
          text: "",
          value: "",
          align: "",
          class: "orange--text",
          sortable: false,
          width: ""
        }
      ],
      flag: {
        state: false,
        text: "Dữ liệu không tìm thấy! Không có chương trình khuyến mãi nào."
      },
      hotelId: this.$route.query.hotelId,
      data: [],
      couponCode: [],
      expiredCoupponCode: []
    };
  },
  created() {
    // if (Object.keys(this.$route.query).length == 0) {
    //   this.$router.push({ name: "home" });
    // }
    this.load();
  },
  watch: {},
  methods: {
    load: function() {
      axios({
        method: "get",
        url: "http://localhost:8000/api/manager/coupon-code",
        headers: {
          Authorization: "Bearer " + localStorage.getItem("api_token")
        },
        params: {
          hotelId: this.hotelId
        }
      })
        .then(res => {
          this.flag.state = true;
          console.log(res.data.status);
          if (res.data.status == true) {
            this.couponCode = res.data.couponCode;
            this.expiredCouponCode = res.data.expiredCouponCode;
            this.data = this.couponCode;
          } else {
            this.$router.push({ name: "home" });
          }
        })
        .catch(error => {
          console.log(error.response);
          if (error.response.status == 401) {
            this.router.push({ name: "login" });
          }
        });
    },
    formatDate: function(date) {
      if (!date) return null;
      date = date.substr(0, 10);
      const [year, month, day] = date.split("-");
      return `${day}/${month}/${year}`;
    }
  }
};
</script>

<style scoped>
</style>