<template>
  <v-layout row wrap class="mx-3">
    <v-flex shrink md8>
      <v-layout
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
          <v-card :color="color.header" width="800px" min-height="120px" class="pa-1" flat tile>
            <v-card-title class="white--text">
              <v-avatar size="70px" flat color="white">
                <v-tooltip top>
                  <template v-slot:activator="{ on }">
                    <img :src="item.customer.avatar" v-on="on">
                  </template>
                  <span>{{item.customer.name }}</span>
                </v-tooltip>
              </v-avatar>
              <span class="title pl-3 font-weight-light">{{item.customer.name}}</span>
              <v-spacer></v-spacer>
              <v-tooltip top>
                <template v-slot:activator="{ on }">
                  <v-icon medium :color="color.grey" v-on="on" v-on:click="hide(index)">close</v-icon>
                </template>
                <span>Hide</span>
              </v-tooltip>
            </v-card-title>
            <v-card-text>
              <span class="headline white--text">" {{item.review.title}} "</span>
              <v-layout>
                <v-card flat tile tag="div" class="radius">
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
              <span class="white--text subheading">{{item.review.likes}}</span>
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
              <span class="white--text subheading">{{item.review.comments.amount}}</span>
            </v-card-actions>
            <v-layout class="row wrap" justify-center v-if="item.model">
              <v-card
                flat
                tile
                width="790px"
                class="mb-1"
                v-for="(value,i) in item.review.comments.items"
                :key="i"
              >
                <v-card-title>
                  <v-avatar size="40px" flat color="white">
                    <img :src="value.customer.avatar">
                  </v-avatar>
                  <span class="pl-3">{{value.customer.name}}</span>
                </v-card-title>
                <v-card-text>{{value.content}}</v-card-text>
              </v-card>
              <v-card flat tile width="790px" v-show="item.review.comments.state">
                <v-layout align-center>
                  <v-flex class="md10">
                    <v-text-field
                      label="New comment"
                      full-width
                      flat
                      :color="color.comment"
                      class="wrap"
                    ></v-text-field>
                  </v-flex>
                  <v-flex>
                    <div class="enterButton text-lg-center radius">
                      <v-tooltip top>
                        <template v-slot:activator="{ on }">
                          <v-icon large :color="color.header" class="pt-2" v-on="on">check</v-icon>
                        </template>
                        <span>Send text</span>
                      </v-tooltip>
                    </div>
                  </v-flex>
                </v-layout>
              </v-card>
            </v-layout>
          </v-card>
        </v-badge>
      </v-layout>
      <v-layout justify-center align-center>
        <v-card :color="color.header" flat tile width="600px" height="60px" class="px-5">
          <v-card-title class="text-lg-center" v-on:click="true">
            <v-icon medium color="white">fas fa-circle-notch fa-spin</v-icon>
            <span class="white--text title font-weight-light ml-3 pointer">Load more news...</span>
          </v-card-title>
        </v-card>
      </v-layout>
    </v-flex>
    <v-flex shrink md4>
      <v-expansion-panel dark class="elevation-0" expand v-model="expand">        
          <v-expansion-panel-content class="mb-3" v-for="(panel,index) in panels" :key="index">
            <template v-slot:actions>
              <v-icon>expand_more</v-icon>
            </template>
            <template v-slot:header>
              <div class="title my-3 text-uppercase">{{panel.header}}</div>
            </template>
            <v-list two-line subheader>
              <v-subheader inset class="ma-0 caption">
                based on &nbsp;
                <span class="font-weight-bold">system recommend</span>
              </v-subheader>
              <v-divider class="ma-0"></v-divider>
              <v-list-tile v-for="(item,i) in panel.items" :key="i">
                <v-list-tile-avatar class="ma-2">
                  <v-icon large :color="stars.top1" v-if="index===0 && i===0">star</v-icon>
                  <v-icon large :color="stars.top2" v-else-if="index===0 && i===1">star</v-icon>
                  <v-icon large :color="stars.top3" v-else-if="index===0 && i===2">star</v-icon>
                  <v-icon large :color="stars.none" v-else-if="index===0 && i===3">star</v-icon>
                  <v-avatar size="50px" flat color="white" v-show="index===1">
                    <img src="http://localhost:8000/img/spider-man.png" alt>
                  </v-avatar>
                </v-list-tile-avatar>
                <v-list-tile-content>
                  <v-list-tile-title>{{item.name}}</v-list-tile-title>
                  <v-list-tile-sub-title v-show="index===0">{{panel.description}}</v-list-tile-sub-title>
                  <v-list-tile-sub-title v-show="index===0">
                    <v-icon small color="pink">room</v-icon>&nbsp; tp Ho Chi Minh
                  </v-list-tile-sub-title>
                  <v-list-tile-sub-title v-show="index===1">{{item.username}}</v-list-tile-sub-title>
                </v-list-tile-content>
                <v-list-tile-action>
                  <v-btn fab icon>
                    <v-icon
                      medium
                      :color="color.follow"
                      v-if="index===0"
                      v-on:click="followHotel"
                    >control_point</v-icon>
                    <v-icon medium :color="color.follow" v-else v-on:click="followUser">person_add</v-icon>
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
  data() {
    return {
      expand: [true, true, true],
      examples: [
        {
          review: {
            title: "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
            content:
              "Illum velit nesciunt amet. Explicabo voluptatibus amet officia quam, necessitatibus mollitia iure neque? Obcaecati, ratione quis a atque sed temporibus? Ullam, consequatur.",
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
      panels: [
        {
          header: "top hotel",
          description:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum molestias adipisci ex similique eaque optio ipsa atque tempora, placeat et minima obcaecati non architecto reprehenderit voluptatum aspernatur, magni debitis eum.",
          items: []
        },
        {
          header: "suggesions",
          description:
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum molestias adipisci ex similique eaque optio ipsa atque tempora, placeat et minima obcaecati non architecto reprehenderit voluptatum aspernatur, magni debitis eum.",
          items: []
        }
      ],
      avatar:{
        link:null,
      },
      stars: {
        top1: "#fed330",
        top2: "#a55eea",
        top3: "#6ab04c",
        none: "#7ed6df"
      }
    };
  },
  created() {
    this.getTop5Hotel();
    this.getTop5User();
  },
  methods: {
    getTop5Hotel: function() {
      axios({
        method: "get",
        url: "http://localhost:8000/api/get-top5-hotel"
      }).then(res => {
        console.log(res.data.top5);
        this.panels[0].items = res.data.top5;
        return;
      });
    },
    getTop5User: function() {
      axios({
        method: "get",
        url: "http://localhost:8000/api/get-top5-user"
      }).then(res => {
        console.log(res.data.user);
        this.panels[1].items = res.data.user;
        return;
      });
    },
    followUser: function() {
      this.$emit("loadSnackbar", "Follow User!");
      return;
    },
    followHotel: function() {
      this.$emit("loadSnackbar", "Follow Hotel!");
      return;
    },
    hide: function(index) {
      this.snackbar.state = !this.snackbar.state;
      this.snackbar.content = "Hide " + index;
      this.examples[index].hide = false;
      return;
    }
  }
};
</script>
<style scoped>
.enterButton {
  width: 90px;
  height: 60px;
  background-color: #1cc3b2;
  cursor: pointer;
}
.radius {
  border-bottom-left-radius: 20%;
}
.pointer {
  cursor: pointer;
}
</style>
