<template>
  <v-layout row wrap>
    <v-flex shrink md8 v-if="flag.state">
      <v-layout class="pa-0 ma-0" v-if="couponCode.length>0 || expiredCouponCode.length > 0">
        <v-flex md12 v-if="!createForm">
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
                    <td>
                      <v-layout row wrap class="pa-0 ma-0" align-center>
                        <v-flex md2>
                          <div
                            class="indigo--text text-md-center font-weight-black display-1"
                          >{{c.item.discount_value}}%</div>
                        </v-flex>
                        <v-flex md5 class="border-right pa-2">
                          <v-layout row wrap class="pa-0 ma-0">
                            <div>
                              <div>
                                <span class="font-weight-black">{{c.item.title}}</span>
                              </div>
                              <div>
                                <span class="font-italic caption">"{{c.item.title}}"</span>
                              </div>
                              <div>
                                <span class="font-weight-black title brown--text">"{{c.item.code}}"</span>
                              </div>
                            </div>
                          </v-layout>
                        </v-flex>
                        <v-flex md5 class="pa-2">
                          <v-layout row wrap class="pa-0 ma-0">
                            <v-flex md4>
                              <span class="caption">Bắt Đầu:</span>
                            </v-flex>
                            <v-flex md8>
                              <span class="font-weight-black">{{formatDate(c.item.start_at)}}</span>
                            </v-flex>
                            <v-flex md4>
                              <span class="caption">Kết Thúc:</span>
                            </v-flex>
                            <v-flex md8>
                              <span
                                class="font-weight-black"
                                v-if="c.item.end_at != null"
                              >{{formatDate(c.item.end_at)}}</span>
                              <a
                                class="teal--text caption"
                                v-else
                                @click="openDatePicker(c.item)"
                              >Thêm...</a>
                            </v-flex>
                            <v-flex md10 v-if="c.item.days">
                              <div>
                                Đã diễn ra được&nbsp;
                                <span class="font-weight-black">{{c.item.days}}&nbsp;</span>ngày...
                              </div>
                            </v-flex>
                          </v-layout>
                        </v-flex>
                      </v-layout>
                    </td>
                    <td>
                      <div v-if="c.item.start_at ==null && radio ==1">
                        <a href="#" class="red--text caption">Xóa...</a>
                      </div>
                      <div v-if="radio ==0">
                        <a href="#" class="indigo--text caption" @click="endCode(c.item.id)">Dừng...</a>
                      </div>
                    </td>
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
        <v-flex md12 v-else>
          <v-form ref="form" data-vv-scope="form1" class="pa-1 brown lighten-2">
            <v-layout row wrap class="pa-2 ma-0 white" align-center>
              <v-flex md12>
                <div
                  class="ma-3 font-weight-black headline text-md-center text-uppercase brown--text"
                >tạo mã coupon</div>
              </v-flex>
              <v-flex md12>
                <v-divider class="brown"></v-divider>
              </v-flex>
              <v-flex md6>
                <span class="caption">Ngày bắt đầu:&nbsp;</span>
                <v-menu
                  ref="start"
                  v-model="mn.menu1"
                  :return-value.sync="code.start_at"
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
                    <input
                      style="width:150px"
                      class="text-md-center border pa-2 mb-3"
                      type="text"
                      v-model="startFormatted"
                      readonly
                      v-on="on"
                    />
                  </template>
                  <v-date-picker light no-title scrollable v-model="code.start_at" :min="now">
                    <v-spacer></v-spacer>
                    <v-btn flat v-on:click="mn.menu1 = false">Hủy</v-btn>
                    <v-btn flat v-on:click="$refs.start.save(code.start_at)">OK</v-btn>
                  </v-date-picker>
                </v-menu>
              </v-flex>
              <v-flex md5 offset-md1>
                <span class="caption">Ngày kết thúc:&nbsp;</span>
                <v-menu
                  ref="end"
                  v-model="mn.menu2"
                  :return-value.sync="code.end_at"
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
                    <input
                      style="width:150px"
                      class="text-md-center border pa-2 mb-3"
                      type="text"
                      v-model="endFormatted"
                      readonly
                      v-on="on"
                    />
                  </template>
                  <v-date-picker
                    light
                    no-title
                    scrollable
                    v-model="code.end_at"
                    :min="code.start_at+1"
                  >
                    <v-spacer></v-spacer>
                    <v-btn flat @click="mn.menu2 = false">Hủy</v-btn>
                    <v-btn flat @click="$refs.end.save(code.end_at)">OK</v-btn>
                  </v-date-picker>
                </v-menu>
              </v-flex>
              <v-flex md4>
                <v-text-field
                  :error-messages="errors.collect('form1.code')"
                  data-vv-name="code"
                  v-validate="'required'"
                  type="text"
                  outline
                  color="brown"
                  v-model="code.code"
                  label="Nhập mã coupon tại đây..."
                ></v-text-field>
              </v-flex>
              <v-flex md7 offset-md1>
                <v-textarea
                  :error-messages="errors.collect('form1.title')"
                  data-vv-name="title"
                  v-validate="'required'"
                  type="text"
                  outline
                  auto-grown
                  rows="2"
                  color="brown"
                  v-model="code.title"
                  label="Nhập tiêu đề khuyến mãi tại đây..."
                ></v-textarea>
              </v-flex>
              <v-flex md5 mb-3>
                <span class="subheading">Mức giảm (%):&nbsp;</span>
                <input
                  type="number"
                  min="1"
                  max="100"
                  v-model="code.discount"
                  class="text-md-center pa-2 border"
                  style="width:100px"
                />
              </v-flex>
              <v-flex md5 offset-md1 mb-3>
                <span class="subheading">Số lượng:&nbsp;</span>
                <input
                  type="number"
                  min="1"
                  v-model="code.amount"
                  class="text-md-center pa-2 border"
                  style="width:100px"
                />
              </v-flex>
              <v-flex m12>
                <v-textarea
                  :error-messages="errors.collect('form1.content')"
                  data-vv-name="content"
                  v-validate="'required'"
                  outline
                  auto-grow
                  rows="6"
                  color="brown"
                  v-model="code.content"
                  label="Nhập nội dung chương trình tại đây..."
                ></v-textarea>
              </v-flex>
            </v-layout>
          </v-form>
        </v-flex>
      </v-layout>
      <v-layout class="pa-0 ma-0" justify-center align-center v-else>
        <div v-if="!createForm">
          <span>{{flag.text}}</span>
        </div>
        <v-flex md12 v-else>
          <v-form ref="form" data-vv-scope="form1" class="pa-1 brown lighten-2">
            <v-layout row wrap class="pa-2 ma-0 white" align-center>
              <v-flex md12>
                <div
                  class="ma-3 font-weight-black headline text-md-center text-uppercase brown--text"
                >tạo mã coupon</div>
              </v-flex>
              <v-flex md12>
                <v-divider class="brown"></v-divider>
              </v-flex>
              <v-flex md6>
                <span class="caption">Ngày bắt đầu:&nbsp;</span>
                <v-menu
                  ref="start"
                  v-model="mn.menu1"
                  :return-value.sync="code.start_at"
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
                    <input
                      style="width:150px"
                      class="text-md-center border pa-2 mb-3"
                      type="text"
                      v-model="startFormatted"
                      readonly
                      v-on="on"
                    />
                  </template>
                  <v-date-picker light no-title scrollable v-model="code.start_at" :min="now">
                    <v-spacer></v-spacer>
                    <v-btn flat v-on:click="mn.menu1 = false">Hủy</v-btn>
                    <v-btn flat v-on:click="$refs.start.save(code.start_at)">OK</v-btn>
                  </v-date-picker>
                </v-menu>
              </v-flex>
              <v-flex md5 offset-md1>
                <span class="caption">Ngày kết thúc:&nbsp;</span>
                <v-menu
                  ref="end"
                  v-model="mn.menu2"
                  :return-value.sync="code.end_at"
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
                    <input
                      style="width:150px"
                      class="text-md-center border pa-2 mb-3"
                      type="text"
                      v-model="endFormatted"
                      readonly
                      v-on="on"
                    />
                  </template>
                  <v-date-picker
                    light
                    no-title
                    scrollable
                    v-model="code.end_at"
                    :min="code.start_at+1"
                  >
                    <v-spacer></v-spacer>
                    <v-btn flat @click="mn.menu2 = false">Hủy</v-btn>
                    <v-btn flat @click="$refs.end.save(code.end_at)">OK</v-btn>
                  </v-date-picker>
                </v-menu>
              </v-flex>
              <v-flex md4>
                <v-text-field
                  :error-messages="errors.collect('form1.code')"
                  data-vv-name="code"
                  v-validate="'required'"
                  type="text"
                  outline
                  color="brown"
                  v-model="code.code"
                  label="Nhập mã coupon tại đây..."
                ></v-text-field>
              </v-flex>
              <v-flex md7 offset-md1>
                <v-textarea
                  :error-messages="errors.collect('form1.title')"
                  data-vv-name="title"
                  v-validate="'required'"
                  type="text"
                  outline
                  auto-grown
                  rows="2"
                  color="brown"
                  v-model="code.title"
                  label="Nhập tiêu đề khuyến mãi tại đây..."
                ></v-textarea>
              </v-flex>
              <v-flex md5 mb-3>
                <span class="subheading">Mức giảm (%):&nbsp;</span>
                <input
                  type="number"
                  min="1"
                  max="100"
                  v-model="code.discount"
                  class="text-md-center pa-2 border"
                  style="width:100px"
                />
              </v-flex>
              <v-flex md5 offset-md1 mb-3>
                <span class="subheading">Số lượng:&nbsp;</span>
                <input
                  type="number"
                  min="1"
                  v-model="code.amount"
                  class="text-md-center pa-2 border"
                  style="width:100px"
                />
              </v-flex>
              <v-flex m12>
                <v-textarea
                  :error-messages="errors.collect('form1.content')"
                  data-vv-name="content"
                  v-validate="'required'"
                  outline
                  auto-grow
                  rows="6"
                  color="brown"
                  v-model="code.content"
                  label="Nhập nội dung chương trình tại đây..."
                ></v-textarea>
              </v-flex>
            </v-layout>
          </v-form>
        </v-flex>
      </v-layout>
    </v-flex>
    <v-flex md8 v-else>
      <v-layout align-center justify-center>
        <v-icon large color="brown">fas fa-circle-notch fa-spin</v-icon>
      </v-layout>
    </v-flex>
    <v-flex md3 offset-md1>
      <v-card light flat tile>
        <v-card-title>
          <v-layout row wrap class="pa-0 ma-2">
            <v-flex md12>
              <v-btn
                round
                depressed
                color="brown lighten-2"
                @click.stop="createForm = true"
                class="white--text"
                v-if="createForm === false"
              >
                <v-icon small>add</v-icon>&nbsp;Tạo một mã
              </v-btn>
              <v-btn
                round
                depressed
                color="brown lighten-2"
                @click.stop="createForm = false"
                class="white--text"
                v-else
              >
                <v-icon small>close</v-icon>&nbsp;Hủy
              </v-btn>
            </v-flex>
            <v-flex md12>
              <v-divider class="brown"></v-divider>
            </v-flex>
            <v-flex md12 v-if="!createForm">
              <v-radio-group v-model="radio">
                <v-layout row wrap class="pa-0 ma-0">
                  <v-flex md12>
                    <span class="body-1 brown--text">Chọn danh sách:</span>
                  </v-flex>
                  <v-flex md12>
                    <v-layout row wrap class="pa-0 ma-0" align-center>
                      <v-flex md2>
                        <v-radio :value="0" @click="radio = 0; search = ''" color="brown"></v-radio>
                      </v-flex>
                      <v-flex md8 class="caption">
                        Đang diễn ra&nbsp;
                        <span class="font-weight-black">({{couponCode.length}})</span>
                      </v-flex>
                    </v-layout>
                  </v-flex>
                  <v-flex md12>
                    <v-layout row wrap class="pa-0 ma-0" align-center>
                      <v-flex md2>
                        <v-radio :value="1" @click="radio = 1; search = ''" color="orange"></v-radio>
                      </v-flex>
                      <v-flex md8 class="caption">
                        Chưa kích hoạt&nbsp;
                        <span
                          class="font-weight-black"
                        >({{waitingCouponCode.length}})</span>
                      </v-flex>
                    </v-layout>
                  </v-flex>
                  <v-flex md12>
                    <v-layout row wrap class="pa-0 ma-0" align-center>
                      <v-flex md2>
                        <v-radio :value="2" @click="radio = 2;search = ''" color="black"></v-radio>
                      </v-flex>
                      <v-flex md8 class="caption">
                        Hết hạn&nbsp;
                        <span class="font-weight-black">({{expiredCouponCode.length}})</span>
                      </v-flex>
                    </v-layout>
                  </v-flex>
                  <v-flex md12>
                    <v-divider dark></v-divider>
                  </v-flex>
                  <v-flex md12>
                    <div>
                      <div>
                        <span class="body-1 brown--text">Tìm mã...</span>
                      </div>
                      <div>
                        <input type="text" v-model="search" class="pa-2 border" />
                      </div>
                      <div>
                        <span class="grey--text caption font-italic">*nhập coupon-code...</span>
                      </div>
                    </div>
                  </v-flex>
                </v-layout>
              </v-radio-group>
            </v-flex>
            <v-flex v-else>
              <v-chip color="orange" text-color="white" @click="resetForm">Hoàn Tác</v-chip>
              <v-chip color="teal" text-color="white" @click="openConfirm">Tạo</v-chip>
            </v-flex>
          </v-layout>
        </v-card-title>
      </v-card>
    </v-flex>
    <v-dialog persistent v-model="confirm" max-width="500">
      <v-card flat title class="pa-2">
        <v-card-title class="headline">Xem lại chi tiết dữ liệu vừa tạo</v-card-title>
        <v-card-text>
          <v-layout row wrap class="pa-2 ma-0 border" align-center>
            <v-flex md3>
              <div
                class="indigo--text text-md-center font-weight-black display-2"
              >{{code.discount}}%</div>
            </v-flex>
            <v-flex md8 offset-md1>
              <v-layout row wrap class="border-left pa-0 ma-0 px-3" align-center>
                <v-flex md4>
                  <span class="caption">Mã Coupon:</span>
                </v-flex>
                <v-flex md6 offset-md1>
                  <span class="font-weight-black brown--text title">"{{code.code}}"</span>
                </v-flex>
                <v-flex md12>
                  <div class="ma-2 pl-1">
                    <div>
                      <span class="font-weight-black body-1">{{code.title}}</span>
                    </div>
                    <div>
                      <span class="font-italic caption">"{{code.content}}"</span>
                    </div>
                  </div>
                </v-flex>
                <v-flex md4>
                  <span class="caption">Ngày Bắt Đầu:</span>
                </v-flex>
                <v-flex md6 offset-md1>
                  <span class="font-weight-black caption">{{formatDate(code.start_at)}}</span>
                </v-flex>
                <v-flex md4>
                  <span class="caption">Ngày Kết Thúc:</span>
                </v-flex>
                <v-flex md6 offset-md1>
                  <span class="font-weight-black caption">{{formatDate(code.end_at)}}</span>
                </v-flex>
                <v-flex md4>
                  <span class="caption">Số Lượng:</span>
                </v-flex>
                <v-flex md6 offset-md1>
                  <span class="font-weight-black caption">{{code.amount}}</span>
                </v-flex>
              </v-layout>
            </v-flex>
          </v-layout>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn round color="red" flat="flat" @click="confirm = false">Hủy</v-btn>
          <v-btn round color="green darken-1" flat="flat" @click="submitForm">Đồng Ý</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog persistent v-model="datePicker.state" max-width="450">
      <v-card flat title class="pa-2">
        <v-card-title>
          <input
            type="text"
            v-model="datePicker.endFormatted"
            readonly
            style="width:100%"
            class="pa-3 text-md-center border"
          />
        </v-card-title>
        <v-card-text>
          <v-date-picker
            width="400"
            dark
            no-title
            scrollable
            v-model="datePicker.end_at"
            :min="datePicker.start_at+1"
            class="elevation-0"
          >
            <v-spacer></v-spacer>
            <v-btn round flat @click="datePicker.state = false" color="red">Hủy</v-btn>
            <v-btn round flat @click="addEndDate()" color="teal">OK</v-btn>
          </v-date-picker>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
export default {
  $_veeValidate: {
    validator: "new"
  },
  data() {
    return {
      confirm: false,
      search: "",
      radio: 0,
      createForm: false,
      tblHeaders: [
        {
          text: "Danh sách khuyến mãi...",
          value: "code",
          align: "",
          class: "brown--text",
          sortable: false,
          width: ""
        },
        {
          text: "",
          value: "",
          align: "",
          class: "orange--text",
          sortable: false,
          width: "10%"
        }
      ],
      flag: {
        state: false,
        text: "Dữ liệu không tìm thấy! Không có chương trình khuyến mãi nào."
      },
      mn: {
        menu1: false,
        menu2: false
      },
      hotelId: this.$route.query.hotelId,
      data: [],
      couponCode: [],
      expiredCouponCode: [],
      waitingCouponCode: [],
      code: {
        code: "",
        discount: 1,
        title: "",
        content: "",
        start_at: "",
        end_at: "",
        amount: 1
      },
      now: new Date().toISOString().substr(0, 10),
      startFormatted: "",
      endFormatted: "",
      dictionary: {
        custom: {
          code: {
            required: () => "Vẫn chưa nhập mã cần tạo"
          },
          title: {
            required: () => "Vẫn chưa nhập tiêu đề khuyến mãi cần tạo"
          },
          content: {
            required: () => "Vẫn chưa nhập tiêu đề khuyến mãi cần tạo"
          }
        }
      },
      datePicker: {
        state: false,
        id: 0,
        end_at: "",
        start_at: "",
        endFormatted: this.formatDate(this.now)
      }
    };
  },
  created() {
    this.$emit("chooseHotel", this.hotelId);
    // if (Object.keys(this.$route.query).length == 0) {
    //   this.$router.push({ name: "home" });
    // }
    this.load();
  },
  mounted() {
    this.$validator.localize("en", this.dictionary);
  },
  watch: {
    "datePicker.end_at": function() {
      this.datePicker.endFormatted = this.formatDate(this.datePicker.end_at);
    },
    "code.start_at": function() {
      this.startFormatted = this.formatDate(this.code.start_at);
    },
    "code.end_at": function() {
      this.endFormatted = this.formatDate(this.code.end_at);
    },
    radio: function() {
      switch (this.radio) {
        case 0:
          this.data = this.couponCode;
          break;
        case 1:
          this.data = this.waitingCouponCode;
          break;
        case 2:
          this.data = this.expiredCouponCode;
          break;
      }
    }
  },
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
            this.waitingCouponCode = res.data.waitingCouponCode;
            if (this.couponCode.length == 0) {
              if (this.waitingCouponCode.length != 0) {
                this.radio = 1;
              } else {
                this.radio = 2;
              }
            } else {
              this.radio = 0;
              this.data = this.couponCode;
            }
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
      // date = date.substr(0, 10);
      const [year, month, day] = date.split("-");
      return `${day}/${month}/${year}`;
    },
    resetForm: function() {
      this.$refs.form.reset();
      this.startFormatted = "";
      this.code.start_at = "";
      this.code.end_at = "";
      this.endFormatted = "";
      this.$validator.reset();
    },
    openConfirm: function() {
      this.$validator.validateAll("form1").then(valid => {
        if (valid) {
          this.confirm = true;
        }
      });
    },
    submitForm: function() {
      this.$validator.validateAll("form1").then(valid => {
        if (valid) {
          axios({
            method: "post",
            url: "http://localhost:8000/api/manager/coupon-code",
            headers: {
              Authorization: "Bearer " + localStorage.getItem("api_token")
            },
            data: {
              hotelId: this.hotelId,
              code: this.code
            }
          })
            .then(res => {
              console.log(res.data);
              if (res.data.status == true) {
                this.resetForm();
                this.createForm = false;
                this.confirm = false;
                var newCoupon = res.data.data;
                if (newCoupon.waiting) {
                  this.waitingCouponCode.push(newCoupon);
                  this.radio = 1;
                } else {
                  this.couponCode.push(newCoupon);
                  this.radio = 0;
                }
                this.search = newCoupon.code;
                console.log(this.search);
              } else {
                this.$router.push({ name: "home" });
              }
            })
            .catch(error => {
              console.log(error.response);
              console.log(error);
              if (error.response.status == 401) {
                this.router.push({ name: "login" });
              }
            });
        }
      });
    },
    getIndex(id) {
      var index = 0;
      var arr = [];
      switch (this.radio) {
        case 0:
          arr = this.couponCode;
          break;
        case 1:
          arr = this.waitingCouponCode;
          break;
      }
      if (arr.length != 0) {
        arr.forEach((element, i) => {
          if (element.id == id) index = i;
        });
      }
      return index;
    },
    endCode: function(id) {
      axios({
        method: "put",
        url: "http://localhost:8000/api/manager/coupon-code/" + id,
        headers: {
          Authorization: "Bearer " + localStorage.getItem("api_token")
        },
        params: {
          id: id,
          flag: 0
        }
      })
        .then(res => {
          console.log(res.data);
          if (res.data.status == true) {
            var index = this.getIndex(id);
            this.expiredCouponCode.push(res.data.couponCode);
            this.couponCode.splice(index, 1);
            this.radio = 2;
            this.search = res.data.couponCode.code;
          } else {
            // this.$router.push({ name: "home" });
          }
        })
        .catch(error => {
          console.log(error.response);
          if (error.response.status == 401) {
            this.router.push({ name: "login" });
          }
        });
    },
    openDatePicker: function(item) {
      this.datePicker.state = true;
      this.datePicker.id = item.id;
      if(item.start_at > this.now)
        this.datePicker.start_at = item.start_at;
      else 
        this.datePicker.start_at = this.now;
      this.datePicker.end_at = "";
      this.datePicker.endFormatted = "";
    },
    addEndDate: function() {
      axios({
        method: "put",
        url:
          "http://localhost:8000/api/manager/coupon-code/" + this.datePicker.id,
        headers: {
          Authorization: "Bearer " + localStorage.getItem("api_token")
        },
        params: {
          id: this.datePicker.id,
          flag: 1,
          end_at: this.datePicker.end_at
        }
      })
        .then(res => {
          console.log(res.data);
          if (res.data.status == true) {
            this.datePicker.state = false;
            var index = this.getIndex(this.datePicker.id);
            switch(this.radio){
              case 0:
              this.couponCode[index].end_at = this.datePicker.end_at;
              this.search = this.couponCode[index].code;
              break;
              case 1:
              this.waitingCouponCode[index].end_at = this.datePicker.end_at;
              this.search = this.waitingCouponCode[index].code;
              break;
            }
          } else {
            // this.$router.push({ name: "home" });
          }
        })
        .catch(error => {
          console.log(error);
          console.log(error.response);
          if (error.response.status == 401) {
            this.router.push({ name: "login" });
          }
        });
    }
  }
};
</script>

<style scoped>
</style>