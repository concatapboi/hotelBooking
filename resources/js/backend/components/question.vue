<template>
  <v-layout row wrap>
    <v-flex shrink md7 v-if="flag.state">
      <v-layout class="pa-0 ma-0" v-if="questionList.length >0">
        <v-flex md12>
          <template>
            <v-card flat>
              <v-data-table
                :rows-per-page-items='[10,15,20,{"text":"$vuetify.dataIterator.rowsPerPageAll","value":-1}]'
                :headers="tblHeaders"
                :search="search"
                :items="data"
                class="elevation-0 border"
              >
                <template v-slot:items="q">
                  <tr>
                    <td>
                      <v-layout row wrap class="pa-0 ma-2">
                        <v-flex md2>
                          <v-avatar color="black" size="52px">
                            <v-avatar color="white" size="50px">
                              <img :src="'/img/user/'+q.item.customer.avatar.image_link" alt />
                            </v-avatar>
                          </v-avatar>
                        </v-flex>
                        <v-flex md19>
                          <div>
                            <div>
                              <span class="body-1 font-weight-black">{{q.item.title}}</span>
                            </div>
                            <div>
                              <span class="caption font-italic">"{{q.item.content}}"</span>
                            </div>
                            <div>
                              <span
                                class="caption grey--text pl-3"
                              >-&nbsp;{{formatDate(q.item.created_at)}}</span>
                            </div>
                          </div>
                        </v-flex>
                      </v-layout>
                    </td>
                    <td class="border-left">
                      <span v-if="q.item.reply !=null">
                        <a
                          href="#"
                          @click="q.expanded = true;openQues(q.item.title)"
                          class="purple--text"
                          v-if="!q.expanded"
                        >Xem...</a>
                        <a
                          href="#"
                          @click="q.expanded = false; closeQues()"
                          class="red--text"
                          v-else
                        >Hủy.</a>
                      </span>
                      <span v-else>
                        <a
                          href="#"
                          @click="q.expanded = true;openQues(q.item.title)"
                          class="orange--text"
                          v-if="!q.expanded"
                        >Hồi đáp?</a>
                        <a
                          href="#"
                          @click="q.expanded = false;closeQues()"
                          class="red--text"
                          v-else
                        >Hủy.</a>
                      </span>
                    </td>
                  </tr>
                </template>
                <template v-slot:expand="q">
                  <v-card flat tile light color="purple lighten-2">
                    <v-card-text v-if="q.item.reply !=null">
                      <div>
                        <div>
                          <span class="body-1 font-italic">"{{q.item.content}}"</span>
                        </div>
                        <div>
                          <span
                            class="caption pl-3"
                          >-&nbsp;{{formatDate(q.item.created_at)}}</span>
                        </div>
                      </div>
                    </v-card-text>
                    <v-layout align-center class="pa-0 ma-1 border grey lighten-2" row wrap v-else>
                      <v-flex md7 offset-md1>
                        <v-textarea
                          v-model="text"
                          auto-grow
                          rows="3"
                          color="orange"
                          label="nhập tại đây..."
                          clear-icon="$vuetify.icons.clear"
                          clearable
                        ></v-textarea>
                      </v-flex>
                      <v-flex md3 offset-md1>
                        <v-btn :disabled="text.length ==0" round depressed large color="orange" class="white--text" @click="replyQuestion(q.item.id)">gửi</v-btn>
                      </v-flex>
                    </v-layout>
                  </v-card>
                </template>
              </v-data-table>
            </v-card>
          </template>
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
        <v-icon large color="teal">fas fa-circle-notch fa-spin</v-icon>
      </v-layout>
    </v-flex>
    <v-flex md4 offset-md1>
      <v-card light flat tile>
        <v-card-title>
          <v-layout row wrap class="pa-0 ma-2">
            <v-flex md12>
              <v-radio-group v-model="radio">
                <v-layout row wrap class="pa-0 ma-0">
                  <v-flex md12>
                    <span class="body-1 purple--text">Chọn danh sách:</span>
                  </v-flex>
                  <v-flex md4>
                    <v-layout row wrap class="pa-0 ma-0" align-center>
                      <v-flex md2>
                        <v-radio :value="0" @click="radio = 0" color="black"></v-radio>
                      </v-flex>
                      <v-flex md8 offset-md1 class="caption">Tất cả</v-flex>
                    </v-layout>
                  </v-flex>
                  <v-flex md4>
                    <v-layout row wrap class="pa-0 ma-0" align-center>
                      <v-flex md2>
                        <v-radio :value="1" @click="radio = 1" color="purple"></v-radio>
                      </v-flex>
                      <v-flex md8 offset-md1 class="caption">Đã phản hồi</v-flex>
                    </v-layout>
                  </v-flex>
                  <v-flex md4>
                    <v-layout row wrap class="pa-0 ma-0" align-center>
                      <v-flex md2>
                        <v-radio :value="2" @click="radio = 2" color="orange"></v-radio>
                      </v-flex>
                      <v-flex md8 offset-md1 class="caption">Mới</v-flex>
                    </v-layout>
                  </v-flex>
                </v-layout>
              </v-radio-group>
            </v-flex>
            <v-flex md12>
              <div>
                <div class="mb-1">
                  <span class="body-1 purple--text">Lựa chọn khác</span>
                </div>
                <div>
                  <input type="text" v-model="search" class="pa-2 border" style="width:100%"/>
                </div>
                <div class="mt-1">
                  <span class="grey--text cption font-italic">*nhập tiêu đề câu hỏi...</span>
                </div>
              </div>
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
      text:'',
      radio: 0,
      search: "",
      tblHeaders: [
        {
          text: "Danh sách câu hỏi từ khách hàng...",
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
        text: "Dữ liệu không tìm thấy! Không có câu hỏi dành cho các bạn."
      },
      hotelId: this.$route.query.hotelId,
      data: [],
      questionList: [],
      oldQuestionList: [],
      newQuestionList: []
    };
  },
  created() {
    this.$emit("chooseHotel", this.hotelId);
    // if (Object.keys(this.$route.query).length == 0) {
    //   this.$router.push({ name: "home" });
    // }
    this.load();
  },
  watch: {
    radio: function() {
      switch (this.radio) {
        case 0:
          this.data = this.questionList;
          break;
        case 1:
          this.data = this.oldQuestionList;
          break;
        case 2:
          this.data = this.newQuestionList;
          break;
      }
    }
  },
  methods: {
    openQues: function(val) {
      this.search = val;
    },
    closeQues: function() {
      this.search = "";
    },
    load: function() {
      console.log(this.hotelId);
      axios({
        method: "get",
        url: "http://localhost:8000/api/manager/question",
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
          console.log(res.data.questions);
          if (res.data.status == true) {
            this.questionList = res.data.questions;
            this.oldQuestionList = res.data.oldQuestions;
            this.newQuestionList = res.data.newQuestions;
            this.data = this.questionList;
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
    },
    getIndex(arr,id) {
      var index = 0;
      if (arr.length != 0) {
        arr.forEach((element, i) => {
          if (element.id == id) index = i;
        });
      }
      return index;
    },
    replyQuestion: function(id){
      var questionIndex = this.getIndex(this.newQuestionList,id);
      axios({
        method: "post",
        url: "http://localhost:8000/api/manager/reply",
        headers: {
          Authorization: "Bearer " + localStorage.getItem("api_token")
        },
        data: {
          hotel_id: this.hotelId,
          question_id: id,
          text: this.text,
        }
      })
        .then(res => {
          console.log(res.data);
          if (res.data.status == true) {
            this.newQuestionList.splice(questionIndex,1);
            this.questionList.splice(this.getIndex(this.questionList,id),1);
            this.oldQuestionList.push(res.data.question);
            this.questionList.push(res.data.question);
            this.data  = this.oldQuestionList;
            this.openQues(res.data.question.title);
          } else {
            // this.$router.push({ name: "home" });
          }
        })
        .catch(error => {
          console.log(error);
          console.log(error.response);
          if (error.response.status == 401) {
            // this.router.push({ name: "login" });
          }
        });
    }
  }
};
</script>

<style scoped>
</style>