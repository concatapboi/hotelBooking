<template>
  <v-layout row wrap class="mx-3">
    <v-flex shrink md8 v-if="feeds.length !=0">
      <v-layout class="row wrap mx-3 mb-5" v-for="(r,index) in feeds" :key="index">
        <v-badge left overlap :color="color.badge">
          <template v-slot:badge>
            <v-tooltip top v-if="r.can_comment == 1">
              <template v-slot:activator="{ on }">
                <v-icon small color="white" v-on="on" class="pointer">lock_open</v-icon>
              </template>
              <span>Bình luận</span>
            </v-tooltip>
            <v-tooltip top v-else>
              <template v-slot:activator="{ on }">
                <v-icon small color="black" v-on="on" class="pointer">lock</v-icon>
              </template>
              <span>Khóa bình luận</span>
            </v-tooltip>
          </template>
          <v-card light min-height="120px" class="pa-1" flat tile width="800px">
            <v-card-title>
              <v-avatar size="72px" color="black" flat>
                <v-avatar size="70px" color="white">
                  <v-tooltip top>
                    <template v-slot:activator="{ on }">
                      <img :src="'/img/user/'+r.customer.avatar.image_link" v-on="on" />
                    </template>
                    <span>{{r.customer.name }}</span>
                  </v-tooltip>
                </v-avatar>
              </v-avatar>
              <span class="title pl-3 font-weight-light">{{r.customer.name}}</span>
              <v-spacer></v-spacer>
              <!-- <v-menu bottom right>
                <template v-slot:activator="{ on }">
                  <v-btn fab icon v-on="on">
                    <v-icon color="black">more_vert</v-icon>
                  </v-btn>
                </template>
                <v-list dark>
                  <v-list-tile v-if="r.customer_review.status ==0">
                    <v-list-tile-title>Get notification</v-list-tile-title>
                  </v-list-tile>
                  <v-list-tile v-else>
                    <v-list-tile-title>Off notification</v-list-tile-title>
                  </v-list-tile>
                </v-list>
              </v-menu> -->
            </v-card-title>
            <v-divider class="m-0 p-0"></v-divider>
            <v-card-text>
              <span class="headline">" {{r.title}} "</span>
              <v-layout>
                <v-card
                  flat
                  tile
                  tag="div"
                  width="100%"
                  class="radius"
                  color="grey lighten-2"
                  light
                >
                  <v-card-text class="font-weight-bold font-italic">{{r.content}}</v-card-text>
                </v-card>
              </v-layout>
              <span class="grey--text">&nbsp;{{formatDate(r.created_at)}}</span>
            </v-card-text>
            <v-card-actions>
              <!-- <v-tooltip top>
                <template v-slot:activator="{ on }">
                  <v-icon
                    v-on="on"
                    class="ml-3 mr-1"
                    large
                    :color="color.heart"
                    v-on:click=";"
                    v-if="r.customer_review.like == 0"
                  >favorite_border</v-icon>
                  <v-icon
                    v-on="on"
                    class="ml-3 mr-1"
                    large
                    :color="color.heart"
                    v-on:click=";"
                    v-else
                  >favorite</v-icon>
                </template>
                <span>like</span>
              </v-tooltip>
              <span class="grey--text subheading">{{r.likes}}</span> -->
              <v-tooltip top>
                <template v-slot:activator="{ on }">
                  <v-icon
                    v-on="on"
                    class="ml-3 mr-1"
                    large
                    :color="color.comment"
                    v-on:click="r.model = true"
                    v-if="!r.model"
                  >chat_bubble_outline</v-icon>
                  <v-icon
                    v-on="on"
                    class="ml-3 mr-1"
                    large
                    :color="color.comment"
                    v-on:click="r.model = false"
                    v-else
                  >chat_bubble</v-icon>
                </template>
                <span>bình luận</span>
              </v-tooltip>
              <span class="grey--text subheading">{{r.comments}}</span>
            </v-card-actions>
            <v-divider v-show="r.comments>0 && r.model" class="pa-0 ma-0"></v-divider>
            <v-layout class="row wrap" justify-center v-if="r.model">
              <v-card
                light
                flat
                tile
                width="790px"
                class="mb-1"
                v-for="(c,i) in r.comment"
                :key="i"
              >
                <v-card-title>
                  <v-avatar size="42px" color="black" flat>
                    <v-avatar size="40px" flat color="white">
                      <img :src="'/img/user/'+c.customer.avatar.image_link" />
                    </v-avatar>
                  </v-avatar>
                  <span class="pl-3">{{c.customer.name}}</span>
                </v-card-title>
                <v-card-text>
                  <v-layout>
                    <v-card flat tile tag="div" color="grey lighten-2" width="100%" class="radius">
                      <v-card-text class="font-weight-bold font-italic black--text">{{c.content}}</v-card-text>
                    </v-card>
                  </v-layout>
                </v-card-text>
                <v-divider class="pa-0 ma-0"></v-divider>
              </v-card>
              <v-card flat tile width="790px" v-show="r.can_comment === 1">
                <v-layout row wrap align-center>
                  <v-flex md10 class="pl-3">
                    <v-card-title>
                      <v-textarea
                      v-model="comment.content"
                        outline
                        auto-grow
                        rows="2"
                        color="teal"
                        label="Nhập bình luận mới tại đây..."
                        clear-icon="$vuetify.icons.clear"
                        clearable
                      ></v-textarea>
                    </v-card-title>
                  </v-flex>
                  <v-flex>
                    <v-card-actions>
                      <v-btn round large depressed :disabled="comment.length ===0" color="teal" class="white--text" @click="sendComment(r.id)">
                        <span>Gửi</span>
                      </v-btn>
                    </v-card-actions>
                  </v-flex>
                </v-layout>
              </v-card>
            </v-layout>
          </v-card>
        </v-badge>
      </v-layout>
      <!-- <v-layout
        class="row wrap mx-3 mb-5"
        v-for="(item,index) in examples"
        :key="index"
        v-show="item.hide"
      >
        <v-badge left overlap :color="color.badge">
          <template v-slot:badge>
            <v-tooltip top v-if="item.review.comments.state">
              <template v-slot:activator="{ on }">
                <v-icon small color="white" v-on="on" class="pointer">lock_open</v-icon>
              </template>
              <span>Open comment</span>
            </v-tooltip>
            <v-tooltip top v-else>
              <template v-slot:activator="{ on }">
                <v-icon small color="black" v-on="on" class="pointer">lock</v-icon>
              </template>
              <span>Lock comment</span>
            </v-tooltip>
          </template>
          <v-card light min-height="120px" class="pa-1" flat tile width="800px">
            <v-card-title>
              <v-avatar size="72px" color="black" flat>
                <v-avatar size="70px" color="white">
                  <v-tooltip top>
                    <template v-slot:activator="{ on }">
                      <img :src="item.customer.avatar" v-on="on" />
                    </template>
                    <span>{{item.customer.name }}</span>
                  </v-tooltip>
                </v-avatar>
              </v-avatar>
              <span class="title pl-3 font-weight-light">{{item.customer.name}}</span>
              <v-spacer></v-spacer>
              <v-menu bottom right>
                <template v-slot:activator="{ on }">
                  <v-btn fab icon v-on="on">
                    <v-icon color="black">more_vert</v-icon>
                  </v-btn>
                </template>
                <v-list dark>
                  <v-list-tile>
                    <v-list-tile-title>Hide</v-list-tile-title>
                  </v-list-tile>
                  <v-list-tile>
                    <v-list-tile-title>Off notification</v-list-tile-title>
                  </v-list-tile>
                </v-list>
              </v-menu>
            </v-card-title>
            <v-divider class="m-0 p-0"></v-divider>
            <v-card-text>
              <span class="headline">" {{item.review.title}} "</span>
              <v-layout>
                <v-card
                  flat
                  tile
                  tag="div"
                  width="100%"
                  class="radius"
                  color="grey lighten-2"
                  light
                >
                  <v-card-text class="font-weight-bold font-italic">{{item.review.content}}</v-card-text>
                </v-card>
              </v-layout>
              <span class="grey--text">&nbsp;{{item.review.createdAt}}</span>
            </v-card-text>
            <v-card-actions>
              <v-tooltip top>
                <template v-slot:activator="{ on }">
                  <v-icon
                    v-on="on"
                    class="ml-3 mr-1"
                    large
                    :color="color.heart"
                    v-on:click="item.like =!item.like"
                    v-if="!item.like"
                  >favorite_border</v-icon>
                  <v-icon
                    v-on="on"
                    class="ml-3 mr-1"
                    large
                    :color="color.heart"
                    v-on:click="item.like =!item.like"
                    v-else
                  >favorite</v-icon>
                </template>
                <span>like</span>
              </v-tooltip>
              <span class="grey--text subheading">{{item.review.likes}}</span>
              <v-tooltip top>
                <template v-slot:activator="{ on }">
                  <v-icon
                    v-on="on"
                    class="ml-3 mr-1"
                    large
                    :color="color.comment"
                    v-on:click="item.model = !item.model"
                    v-if="!item.model"
                  >chat_bubble_outline</v-icon>
                  <v-icon
                    v-on="on"
                    class="ml-3 mr-1"
                    large
                    :color="color.comment"
                    v-on:click="item.model = !item.model"
                    v-else
                  >chat_bubble</v-icon>
                </template>
                <span>comment</span>
              </v-tooltip>
              <span class="grey--text subheading">{{item.review.comments.amount}}</span>
            </v-card-actions>
            <v-divider v-show="item.review.comments.amount>0 && item.model" class="pa-0 ma-0"></v-divider>
            <v-layout class="row wrap" justify-center v-if="item.model">
              <v-card
                light
                flat
                tile
                width="790px"
                class="mb-1"
                v-for="(value,i) in item.review.comments.items"
                :key="i"
              >
                <v-card-title>
                  <v-avatar size="42px" color="black" flat>
                    <v-avatar size="40px" flat color="white">
                      <img :src="value.customer.avatar" />
                    </v-avatar>
                  </v-avatar>
                  <span class="pl-3">{{value.customer.name}}</span>
                </v-card-title>
                <v-card-text>
                  <v-layout>
                    <v-card flat tile tag="div" color="grey lighten-2" width="100%" class="radius">
                      <v-card-text
                        class="font-weight-bold font-italic black--text"
                      >{{value.content}}</v-card-text>
                    </v-card>
                  </v-layout>
                </v-card-text>
                <v-divider class="pa-0 ma-0"></v-divider>
              </v-card>
              <v-card flat tile width="790px" v-show="item.review.comments.state">
                <v-layout row wrap align-center>
                  <v-flex md10 class="pl-3">
                    <v-card-title>
                      <v-textarea
                        outline
                        auto-grow
                        rows="2"
                        color="teal"
                        label="New comment"
                        clear-icon="$vuetify.icons.clear"
                        clearable
                      ></v-textarea>
                    </v-card-title>
                  </v-flex>
                  <v-flex>
                    <v-card-actions>
                      <v-btn large depressed dark color="teal">
                        <span>Send</span>
                      </v-btn>
                    </v-card-actions>
                  </v-flex>
                </v-layout>
              </v-card>
            </v-layout>
          </v-card>
        </v-badge>
      </v-layout>-->
    </v-flex>
    <v-flex shrink md8 v-else-if="flag == true">
      <v-img src="/blog/img/slider/oops.png">
        <v-layout row wrap fill-height justify-center align-center>
          <v-flex md12>
            <div class="text-md-center headline font-italic">{{oops}}</div>
          </v-flex>
        </v-layout>
      </v-img>
    </v-flex>
    <v-flex shrink md8 v-else>
      <v-layout row wrap fill-height justify-center align-center>
        <v-flex md12>
          <div class="text-md-center headline font-italic">
            <v-icon large>fas fa-circle-notch fa-spin</v-icon>
          </div>
        </v-flex>
      </v-layout>
    </v-flex>
    <v-flex shrink md4>
      <v-expansion-panel light class="elevation-0" expand v-model="expand">
        <v-expansion-panel-content class="mb-3">
          <template v-slot:actions>
            <v-icon>expand_more</v-icon>
          </template>
          <template v-slot:header>
            <div class="title my-3 text-uppercase">Nhà cung cấp nổi bật</div>
          </template>
          <v-list two-line subheader>
            <v-subheader inset class="ma-0 caption">
              <span class="font-weight-bold">gợi ý từ hệ thống</span>
            </v-subheader>
            <v-divider class="ma-0"></v-divider>
            <v-list-tile v-for="(item,i) in top5Hotel" :key="i" v-on:click=";">
              <v-list-tile-avatar class="ma-2">
                <v-icon large :color="stars.top1" v-if=" i===0">star</v-icon>
                <v-icon large :color="stars.top2" v-else-if="i===1">star</v-icon>
                <v-icon large :color="stars.top3" v-else-if=" i===2">star</v-icon>
                <v-icon large :color="stars.none" v-else>star</v-icon>
              </v-list-tile-avatar>
              <v-list-tile-content>
                <v-tooltip color="black" left max-width="300px">
                  <template v-slot:activator="{ on }">
                    <v-list-tile-title v-on="on">
                      <router-link
                        :to="{name:'hotel',params:{id:item.hotel.id}}"
                        target="_blank"
                      >{{item.hotel.name}}</router-link>
                    </v-list-tile-title>
                    <v-list-tile-sub-title v-on="on">
                      <v-icon small color="pink">room</v-icon>&nbsp;{{item.hotel.address}}
                    </v-list-tile-sub-title>
                  </template>
                  <v-badge overlap left color="red">
                    <template v-slot:badge>
                      <i class="fas fa-info"></i>
                    </template>
                    <v-card color="black" dark class="radius">
                      <v-card-title>
                        <v-rating
                          v-model="item.hotel.stars_num"
                          color="#fff200"
                          background-color="grey darken-1"
                          empty-icon="$vuetify.icons.ratingFull"
                          half-incrementss
                          readonly
                          small
                        ></v-rating>
                        <span>{{item.hotel.description}}</span>
                      </v-card-title>
                    </v-card>
                  </v-badge>
                </v-tooltip>
              </v-list-tile-content>
              <v-list-tile-action>
                <v-btn
                  round
                  depressed
                  color="grey lighten-2"
                  v-on:click="followHotel(item.hotel,i)"
                  v-if="!item.follow"
                >
                  <i class="fas fa-plus mx-2"></i>
                  <span class="caption mr-1">theo dõi</span>
                </v-btn>
                <v-btn round depressed color="teal" v-on:click="unfollowHotel(item.hotel,i)" v-else>
                  <i class="fas fa-check mx-2 white--text"></i>
                  <span class="white--text caption mr-1">hủy theo dõi</span>
                </v-btn>
              </v-list-tile-action>
            </v-list-tile>
          </v-list>
        </v-expansion-panel-content>
        <v-expansion-panel-content class="mb-3">
          <template v-slot:actions>
            <v-icon>expand_more</v-icon>
          </template>
          <template v-slot:header>
            <div class="title my-3 text-uppercase">người dùng nổi bật</div>
          </template>
          <v-list two-line subheader>
            <v-subheader inset class="ma-0 caption">
              <span class="font-weight-bold">gợi ý từ hệ thống</span>
            </v-subheader>
            <v-divider class="ma-0"></v-divider>
            <v-list-tile v-for="(item,i) in top5User" :key="i" v-on:click=";">
              <v-list-tile-avatar class="ma-2">
                <v-avatar size="52px" flat color="black">
                  <router-link :to="{name:'user',params:{id:item.user.id}}">
                    <v-avatar size="50px" flat color="white">
                      <img :src="'/img/user/'+item.avatar.image_link" alt />
                    </v-avatar>
                  </router-link>
                </v-avatar>
              </v-list-tile-avatar>
              <v-list-tile-content>
                <router-link :to="{name:'user',params:{id:item.user.id}}">
                  <v-list-tile-title>{{item.user.name}}</v-list-tile-title>
                </router-link>
                <v-list-tile-title class="text-caption">{{item.user.username}}</v-list-tile-title>
              </v-list-tile-content>
              <v-list-tile-action>
                <v-btn
                  round
                  depressed
                  color="grey lighten-2"
                  v-on:click="followUser(item.user,i)"
                  v-if="!item.follow"
                >
                  <i class="fas fa-plus mx-2"></i>
                  <span class="caption mr-1">theo dõi</span>
                </v-btn>
                <v-btn round depressed color="teal" v-on:click="unfollowUser(item.user,i)" v-else>
                  <i class="fas fa-check mx-2 white--text"></i>
                  <span class="white--text caption mr-1">hủy theo dõi</span>
                </v-btn>
              </v-list-tile-action>
            </v-list-tile>
          </v-list>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  props: {
    customer: {
      type: Object
    }
  },
  mounted() {},
  data() {
    return {
      comment: {
        review_id: 0,
        content: "",
        able: false
      },
      oops: "",
      user: {},
      expand: [true, true, true],
      feeds: [],
      examples: [
        {
          review: {
            title: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
            content: "Illum velit nesciunt amet.",
            usefulPoint: 1,
            createdAt: "2019-05-14 15:08:24",
            likes: 0,
            comments: {
              state: true,
              amount: 2,
              items: [
                {
                  customer: {
                    name: "Catlyn Hayl",
                    avatar: "http://localhost:8000/img/rocket.png"
                  },
                  likes: 3,
                  content: "Quas, deserunt?"
                },
                {
                  customer: {
                    name: "Romio Tinker",
                    avatar: "http://localhost:8000/img/fish.png"
                  },
                  likes: 0,
                  content:
                    "Provident quidem natus ea id nam veniam quasi eum possimus nulla, quisquam, vel, maiores cumque obcaecati tempore nesciunt incidunt ex. Quas, deserunt?"
                }
              ]
            }
          },
          customer: {
            name: "Sam Smith",
            avatar: "http://localhost:8000/img/rainbow.png"
          },
          reviewPoint: 1,
          model: false,
          like: false,
          hide: true
        },
        {
          review: {
            title: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
            content:
              "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum velit nesciunt amet. Explicabo voluptatibus amet officia quam, necessitatibus mollitia iure neque? Obcaecati, ratione quis a atque sed temporibus? Ullam, consequatur.",
            usefulPoint: 0,
            createdAt: "2019-05-14 15:08:24",
            likes: 5,
            comments: {
              state: false,
              amount: 1,
              items: [
                {
                  customer: {
                    name: "Hamter Pattle",
                    avatar: "http://localhost:8000/img/face.png"
                  },
                  likes: 5,
                  content:
                    "Provident quidem natus ea id nam veniam quasi eum possimus nulla, quisquam, vel, maiores cumque obcaecati tempore nesciunt incidunt ex. Quas, deserunt?"
                }
              ]
            }
          },
          customer: {
            name: "Tom Holland",
            avatar: "http://localhost:8000/img/spider-man.png"
          },
          reviewPoint: 4,
          model: false,
          like: false,
          hide: true
        },
        {
          review: {
            title: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
            content:
              "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum velit nesciunt amet. Explicabo voluptatibus amet officia quam, necessitatibus mollitia iure neque? Obcaecati, ratione quis a atque sed temporibus? Ullam, consequatur.",
            usefulPoint: 1,
            createdAt: "2019-05-14 15:08:24",
            likes: 100,
            comments: {
              state: true,
              amount: 4,
              items: [
                {
                  customer: {
                    name: "Sam Joker",
                    avatar: "http://localhost:8000/img/poop.png"
                  },
                  likes: 83,
                  content:
                    "Provident quidem natus ea id nam veniam quasi eum possimus nulla, quisquam, vel, maiores cumque obcaecati tempore nesciunt incidunt ex. Quas, deserunt?"
                },
                {
                  customer: {
                    name: "Bruce Wayne",
                    avatar: "http://localhost:8000/img/dog3.png"
                  },
                  likes: 3,
                  content:
                    "Provident quidem natus ea id nam veniam quasi eum possimus nulla, quisquam, vel, maiores cumque obcaecati tempore nesciunt incidunt ex. Quas, deserunt?"
                },
                {
                  customer: {
                    name: "Robert Hayl",
                    avatar: "http://localhost:8000/img/avatar1.png"
                  },
                  likes: 0,
                  content:
                    "Provident quidem natus ea id nam veniam quasi eum possimus nulla, quisquam, vel, maiores cumque obcaecati tempore nesciunt incidunt ex. Quas, deserunt?"
                },
                {
                  customer: {
                    name: "Banner Dannyl",
                    avatar: "http://localhost:8000/img/frog.png"
                  },
                  likes: 100,
                  content:
                    "Provident quidem natus ea id nam veniam quasi eum possimus nulla, quisquam, vel, maiores cumque obcaecati tempore nesciunt incidunt ex. Quas, deserunt?"
                }
              ]
            }
          },
          customer: {
            name: "Taylor Swift",
            avatar: "http://localhost:8000/img/snake.png"
          },
          reviewPoint: 3,
          model: false,
          like: true,
          hide: true
        },
        {
          review: {
            title: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
            content:
              "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum velit nesciunt amet. Explicabo voluptatibus amet officia quam, necessitatibus mollitia iure neque? Obcaecati, ratione quis a atque sed temporibus? Ullam, consequatur.",
            usefulPoint: 0,
            createdAt: "2019-05-14 15:08:24",
            likes: 10,
            comments: {
              state: false,
              amount: 0,
              items: []
            }
          },
          customer: {
            name: "Charlie Puth",
            avatar: "http://localhost:8000/img/candy.png"
          },
          reviewPoint: 3,
          model: false,
          like: false,
          hide: true
        },
        {
          review: {
            title: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
            content:
              "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum velit nesciunt amet. Explicabo voluptatibus amet officia quam, necessitatibus mollitia iure neque? Obcaecati, ratione quis a atque sed temporibus? Ullam, consequatur.",
            usefulPoint: 1,
            createdAt: "2019-05-14 15:08:24",
            likes: 300,
            comments: {
              state: false,
              amount: 5,
              items: [
                {
                  customer: {
                    name: "Robin Neyli",
                    avatar: "http://localhost:8000/img/dog2.png"
                  },
                  likes: 1,
                  content:
                    "Provident quidem natus ea id nam veniam quasi eum possimus nulla, quisquam, vel, maiores cumque obcaecati tempore nesciunt incidunt ex. Quas, deserunt?"
                },
                {
                  customer: {
                    name: "Tome Hayl",
                    avatar: "http://localhost:8000/img/face3.png"
                  },
                  likes: 79,
                  content:
                    "Provident quidem natus ea id nam veniam quasi eum possimus nulla, quisquam, vel, maiores cumque obcaecati tempore nesciunt incidunt ex. Quas, deserunt?"
                },
                {
                  customer: {
                    name: "Vit Sammel",
                    avatar: "http://localhost:8000/img/dinosaur.png"
                  },
                  likes: 3,
                  content:
                    "Provident quidem natus ea id nam veniam quasi eum possimus nulla, quisquam, vel, maiores cumque obcaecati tempore nesciunt incidunt ex. Quas, deserunt?"
                },
                {
                  customer: {
                    name: "Dava Rubby",
                    avatar: "http://localhost:8000/img/cat.png"
                  },
                  likes: 30,
                  content:
                    "Provident quidem natus ea id nam veniam quasi eum possimus nulla, quisquam, vel, maiores cumque obcaecati tempore nesciunt incidunt ex. Quas, deserunt?"
                },
                {
                  customer: {
                    name: "Caml Ponn",
                    avatar: "http://localhost:8000/img/dog1.png"
                  },
                  likes: 0,
                  content:
                    "Provident quidem natus ea id nam veniam quasi eum possimus nulla, quisquam, vel, maiores cumque obcaecati tempore nesciunt incidunt ex. Quas, deserunt?"
                }
              ]
            }
          },
          customer: {
            name: "Robert Downey Jr",
            avatar: "http://localhost:8000/img/iron-man.png"
          },
          reviewPoint: 5,
          model: false,
          like: true,
          hide: true
        }
      ],
      color: {
        header: "#2c3e50",
        badge: "#1cc3b2",
        heart: "#ff6348",
        fullHeart: "#f8a5c2",
        comment: "#1cc3b2",
        fullComment: "#f5f6fa",
        grey: "#CAD3C8",
        news: "#1B1464",
        follow: "#2d98da"
      },
      top5Hotel: [],
      top5User: [],
      avatar: {
        link: null
      },
      stars: {
        top1: "#fed330",
        top2: "#a55eea",
        top3: "#6ab04c",
        none: "#7ed6df"
      },
      flag: false
    };
  },
  mounted() {},
  created() {
    this.user = this.customer;
    this.load();
  },
  watch:{
    "comment.content": function(val) {
      if (val.length == 0) {
        this.comment.able = false;
        this.comment.review_id = 0;
        this.comment.content = "";
      } else {
        this.comment.able = true;
      }
    }
  },
  methods: {
    load: function() {
      this.$emit("loadLogin");
      if (localStorage.getItem("login_token") != null) {
        this.getFeeds();
        this.getTop5User();
        this.getTop5Hotel();
        this.oops = "Hôm nay chẳng có gì...";
      }
    },
    getFeeds: function() {
      axios({
        method: "get",
        url: "http://localhost:8000/api/review",
        headers: {
          Authorization: "Bearer " + localStorage.getItem("login_token")
        }
      })
        .then(res => {
          console.log(res.data.data);
          this.feeds = res.data.data;
          this.flag = true;
          return;
        })
        .catch(error => {
          console.log(error.response);
          if (error.response.status == 401) {
            localStorage.removeItem("login_token");
            this.login.token = localStorage.getItem("login_token");
            this.$router.push({ name: "login" });
          }
        });
    },
    getTop5Hotel: function() {
      axios({
        method: "get",
        url: "http://localhost:8000/api/get-top5-hotel",
        params: {
          id: this.user.id
        }
      }).then(res => {
        console.log(res.data.top5);
        this.top5Hotel = res.data.top5;
        return;
      });
    },
    getTop5User: function() {
      axios({
        method: "get",
        url: "http://localhost:8000/api/get-top5-user",
        params: {
          id: this.user.id
        }
      }).then(res => {
        console.log(res.data.user);
        this.top5User = res.data.user;
        return;
      });
    },
    followUser: function(value,index) {
      this.top5User[index].follow = true;
      var flag = true;
      axios({
        method: "get",
        url: "http://localhost:8000/api/following",
        params: {
          type: 0,
          id: this.user.id,
          followed: value.id
        },
        headers: {
          Authorization: "Bearer " + localStorage.getItem("login_token")
        }
      })
        .then(res => {
          console.log(res.data.data);
          if (res.data.data == null) {
            flag = false;
<<<<<<< Updated upstream
            this.$emit("loadSnackbar", "Something wrong!");
          }
          this.$emit("loadSnackbar", "Following " + value.name);
=======
            this.$emit("loadSnackbar", "Rất tiếc, thực hiện chưa hoàn thành. Thử lại?");
          }
          // this.$emit("loadSnackbar", "Following " + value.name);
>>>>>>> Stashed changes
        })
        .catch(error => {
          flag = false;
          console.log(error.response);
          if (error.response.status == 401) {
            localStorage.removeItem("login_token");
            this.login.token = localStorage.getItem("login_token");
            this.$router.push({ name: "login" });
          }
        });
        if(!flag){
          this.top5User[index].follow = false;
        }
    },
    unfollowUser: function(value,index) {
      this.top5User[index].follow = false;
      var flag = true;
      axios({
        method: "get",
        url: "http://localhost:8000/api/un-following",
        params: {
          type: 0,
          id: this.user.id,
          followed: value.id
        },
        headers: {
          Authorization: "Bearer " + localStorage.getItem("login_token")
        }
      })
        .then(res => {
          console.log(res.data.data);
          if (res.data.data == null) {
            flag = false;
<<<<<<< Updated upstream
            this.$emit("loadSnackbar", "Something wrong!");
          }
          this.$emit("loadSnackbar", "Unfollowing " + value.name);
=======
            this.$emit("loadSnackbar", "Rất tiếc, thực hiện chưa hoàn thành. Thử lại?");
          }
          // this.$emit("loadSnackbar", "Unfollowing " + value.name);
>>>>>>> Stashed changes
        })
        .catch(error => {
          flag = false;
          console.log(error.response);
          if (error.response.status == 401) {
            localStorage.removeItem("login_token");
            this.login.token = localStorage.getItem("login_token");
            this.$router.push({ name: "login" });
          }
        });
        if(!flag){
          this.top5User[index].follow = true;
        }
    },
    followHotel: function(value,index) {
      this.top5Hotel[index].follow = true;
      var flag = true;
      axios({
        method: "get",
        url: "http://localhost:8000/api/following",
        params: {
          type: 1,
          id: this.user.id,
          followed: value.id
        },
        headers: {
          Authorization: "Bearer " + localStorage.getItem("login_token")
        }
      })
        .then(res => {
          console.log(res.data.data);
          if (res.data.data == null) {
            flag = false;
<<<<<<< Updated upstream
            this.$emit("loadSnackbar", "Something wrong!");
          }
          this.$emit("loadSnackbar", "Following " + value.name);
=======
            this.$emit("loadSnackbar", "Rất tiếc, thực hiện chưa hoàn thành. Thử lại?");
          }
          // this.$emit("loadSnackbar", "Following " + value.name);
>>>>>>> Stashed changes
        })
        .catch(error => {
          flag = false;
          console.log(error.response);
          if (error.response.status == 401) {
            localStorage.removeItem("login_token");
            this.login.token = localStorage.getItem("login_token");
            this.$router.push({ name: "login" });
          }
        });
        if(!flag){
          this.top5Hotel[index].follow=false;
        }
    },
    unfollowHotel: function(value,index) {
      this.top5Hotel[index].follow = false;
      var flag  = true;
      axios({
        method: "get",
        url: "http://localhost:8000/api/un-following",
        params: {
          type: 1,
          id: this.user.id,
          followed: value.id
        },
        headers: {
          Authorization: "Bearer " + localStorage.getItem("login_token")
        }
      })
        .then(res => {
          console.log(res.data.data);
          if (res.data.data == null) {
            flag = false;
<<<<<<< Updated upstream
            this.$emit("loadSnackbar", "Something wrong!");
          }
          this.$emit("loadSnackbar", "Unfollowing " + value.name);
=======
            this.$emit("loadSnackbar", "Rất tiếc, thực hiện chưa hoàn thành. Thử lại?");
          }
          // this.$emit("loadSnackbar", "Unfollowing " + value.name);
>>>>>>> Stashed changes
        })
        .catch(error => {
          flag = false;
          console.log(error.response);
          if (error.response.status == 401) {
            localStorage.removeItem("login_token");
            this.login.token = localStorage.getItem("login_token");
            this.$router.push({ name: "login" });
          }
        });
        if(!flag){
          this.top5Hotel[index].follow = true;
        }
<<<<<<< Updated upstream
    },
    getIndex(id) {
      var index = -1;
      if (this.feeds.length != 0) {
        this.feeds.forEach((element, i) => {
          if (element.id == id) index = i;
        });
      }
      return index;
=======
>>>>>>> Stashed changes
    },
<<<<<<< HEAD
=======
    getIndex(id) {
      var index = -1;
      if (this.feeds.length != 0) {
        this.feeds.forEach((element, i) => {
          if (element.id == id) index = i;
        });
      }
      return index;
    },
>>>>>>> master
    sendComment: function(reviewID) {
      var flag = true;
      var index = this.getIndex(reviewID);
      this.comment.review_id = reviewID;
      axios({
        method: "post",
        url: "http://localhost:8000/api/comment",
        data: {
          comment: this.comment
        },
        headers: {
          Authorization: "Bearer " + localStorage.getItem("login_token")
        }
      })
        .then(res => {
          console.log(res.data.status);
          if (res.data.status == true) {
            console.log(res.data.comment);
            var comment = res.data.comment;
            this.feeds[index].comment.push(comment);
            this.feeds[index].comments = this.feeds[index].comments+1;
            this.comment.able = false;
            this.comment.content = "";
            this.comment.review_id = 0;
          } else {
            this.$emit("loadSnackbar", "Rất tiếc, thực hiện chưa hoàn thành. Thử lại?");
          }
        })
        .catch(error => {
          this.comment.able = false;
          this.comment.content = "";
          this.comment.review_id = 0;
          console.log(error.response);
          if (error.response.status == 401) {
            localStorage.removeItem("login_token");
            this.$router.push({ name: "login" });
          }
        });
    },
    hide: function(index) {
      this.snackbar.state = !this.snackbar.state;
      this.snackbar.content = "Hide " + index;
      this.examples[index].hide = false;
      return;
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
a {
  text-decoration-line: none !important;
  color: #000;
}
.pointer {
  cursor: pointer;
}
.follow-color {
  color: #dfe4ea;
}
.unfollow-color {
  color: #2d98da;
}
.v-tooltip__content {
  opacity: 1 !important;
  padding: 4px !important;
  box-shadow: none !important;
}
.v-menu__content {
  box-shadow: none !important;
}
.radius {
  border-bottom-left-radius: 20%;
}
</style>
