<template>
  <v-layout row wrap class="mx-3">
    <v-flex shrink md8>
      <v-img :aspect-ratio="16/4" src="/blog/img/slider/default.png" class="mr-2 mb-3 radius">
        <v-layout row wrap fill-height class="lightbox white--text mt-5 mb-1 pl-5">
          <v-spacer></v-spacer>
          <v-flex md9 shrink class="pl-5">
            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-avatar size="90px" tile flat color="white" v-on="on">
                  <img :src="data.avatar.image_link" alt />
                </v-avatar>
              </template>
              <span>{{data.name}}</span>
            </v-tooltip>
            <div class="subheading font-weight-black mt-2">{{data.name}}</div>
            <div class="body-1">{{data.email}}</div>
          </v-flex>
          <v-flex md3>
            <v-btn
              dark
              depressed
              color="indigo darken-2"
              class="mr-3"
              v-if="!data.follow"
              v-on:click="followUser(data.user)"
            >
              <i class="fas fa-plus"></i> &nbsp;follow
            </v-btn>
            <v-btn
              dark
              depressed
              color="blue darken-2"
              class="mr-3"
              v-else
              v-on:click="unfollowUser(data.user)"
            >
              <i class="fas fa-check"></i>&nbsp;following
            </v-btn>
          </v-flex>
        </v-layout>
      </v-img>
      <v-layout class="row wrap mx-3 mb-5" v-for="(item,index) in data.review" :key="index">
        <v-badge left overlap :color="color.badge">
          <template v-slot:badge>
            <v-tooltip top v-if="item.can_comment == 1">
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
              <v-spacer></v-spacer>
              <v-menu bottom right>
                <template v-slot:activator="{ on }">
                  <v-btn fab icon v-on="on">
                    <v-icon color="black">more_vert</v-icon>
                  </v-btn>
                </template>
                <v-list dark>
                  <v-list-tile v-if="item.customer_review.status ==1">
                    <v-list-tile-title>Off notification</v-list-tile-title>
                  </v-list-tile>
                  <v-list-tile v-else>
                    <v-list-tile-title>Get notification</v-list-tile-title>
                  </v-list-tile>
                </v-list>
              </v-menu>
              <v-card-text>
                <span class="headline">{{item.title}}</span>
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
                    <v-card-text
                      class="font-weight-bold font-italic"
                    >{{item.content}}</v-card-text>
                  </v-card>
                </v-layout>
                <span class="grey--text">&nbsp;21/12/2019</span>
              </v-card-text>
            </v-card-title>
            <v-card-actions>
              <v-tooltip top>
                <template v-slot:activator="{ on }">
                  <v-icon
                    v-on="on"
                    class="ml-3 mr-1"
                    large
                    :color="color.heart"
                    v-on:click=";"
                    v-if="item.customer_review.like == 0"
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
              <span class="grey--text subheading">{{item.likes}}</span>
              <v-tooltip top>
                <template v-slot:activator="{ on }">
                  <v-icon
                    v-on="on"
                    class="ml-3 mr-1"
                    large
                    :color="color.comment"
                    v-on:click="item.model = true"
                    v-if="!item.model"
                  >chat_bubble_outline</v-icon>
                  <v-icon
                    v-on="on"
                    class="ml-3 mr-1"
                    large
                    :color="color.comment"
                    v-on:click="item.model = false"
                    v-else
                  >chat_bubble</v-icon>
                </template>
                <span>comment</span>
              </v-tooltip>
              <span class="grey--text subheading">{{item.comments}}</span>
            </v-card-actions>
            <v-divider v-show="item.model"></v-divider>
            <v-layout class="row wrap" justify-center v-if="item.model">
              <v-card light flat tile width="790px" class="mb-1" v-for="(value,i) in item.comment" :key="i">
                <v-card-title>
                  <v-avatar size="42px" color="black" flat>
                    <v-avatar size="40px" flat color="white">
                      <img :src="value.customer.avatar.image_link">
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
                <v-divider v-show="item.can_comment === 1"></v-divider>
              </v-card>
              <v-card flat tile width="790px" v-show="item.can_comment === 1">
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
      </v-layout>
    </v-flex>
    <v-flex shrink md4>
      <v-expansion-panel light class="elevation-0" expand v-model="expand">
        <v-expansion-panel-content class="mb-3">
          <template v-slot:actions>
            <v-icon>expand_more</v-icon>
          </template>
          <template v-slot:header>
            <div class="title my-3 text-uppercase font-weight-black">
              <v-icon color="black">assignment_ind</v-icon>&nbsp;profile
            </div>
          </template>
          <v-divider class="ma-0 pa-0"></v-divider>
          <v-container>
            <v-layout row wrap class="mb-2 ml-1" align-center>
              <v-flex md1>
                <i class="fas fa-user-circle red--text fa-lg"></i>
              </v-flex>
              <v-flex md3>
                <span class="font-weight-black">Username:</span>
              </v-flex>
              <v-flex md8 class="pl-2">
                <span class="font-weight-black subheading">{{data.username}}</span>
              </v-flex>
            </v-layout>
            <v-layout row wrap class="mb-2 ml-1" align-center>
              <v-flex md1>
                <i class="fas fa-signature orange--text fa-lg"></i>
              </v-flex>
              <v-flex md3>
                <span class="font-weight-black">Name:</span>
              </v-flex>
              <v-flex md8 class="pl-2">
                <span class="font-weight-black">{{data.name}}</span>
              </v-flex>
            </v-layout>
            <v-layout row wrap class="mb-2 ml-1" align-center>
              <v-flex md1>
                <i class="fas fa-envelope yellow--text fa-lg"></i>
              </v-flex>
              <v-flex md3>
                <span class="font-weight-black">Email:</span>
              </v-flex>
              <v-flex md8 class="pl-2">
                <span class="font-weight-black">{{data.email}}</span>
              </v-flex>
            </v-layout>
            <v-layout row wrap class="mb-2 ml-1" align-center>
              <v-flex md1>
                <i class="fas fa-phone green--text fa-lg"></i>
              </v-flex>
              <v-flex md3>
                <span class="font-weight-black">Phone number:</span>
              </v-flex>
              <v-flex md8 class="pl-2">
                <span class="font-weight-black">{{data.phone_number}}</span>
              </v-flex>
            </v-layout>
            <v-layout row wrap class="mb-2 ml-1" align-center>
              <v-flex md1>
                <i class="fab fa-creative-commons-nd blue--text fa-lg"></i>
              </v-flex>
              <v-flex md3>
                <span class="font-weight-black">Coin:</span>
              </v-flex>
              <v-flex md8 class="pl-2">
                <span class="font-weight-black">{{data.customer.coin}}</span>
              </v-flex>
            </v-layout>
            <v-layout row wrap class="mb-2 ml-1" align-center>
              <v-flex md1>
                <i class="fas fa-home indigo--text fa-lg"></i>
              </v-flex>
              <v-flex md3>
                <span class="font-weight-black">Address:</span>
              </v-flex>
              <v-flex md8 class="pl-2">
                <span class="font-weight-black">{{data.customer.address}}</span>
              </v-flex>
            </v-layout>
          </v-container>
        </v-expansion-panel-content>
        <v-expansion-panel-content class="mb-3">
          <template v-slot:actions>
            <v-icon>expand_more</v-icon>
          </template>
          <template v-slot:header>
            <div class="title my-3 text-uppercase font-weight-black">
              <v-icon color="black">group</v-icon>&nbsp;following &amp; followers
            </div>
          </template>
          <v-btn
            depressed
            color="grey lighten-2"
            v-on:click="followDialog = true"
            v-show="data.customerFollowings.length + data.hotelFollowings.length >0 || data.followers.length>0"
          >
            <v-icon small>notes</v-icon>&nbsp;see all
          </v-btn>
          <v-tabs
            centered
            grow
            color="grey lighten-2"
            light
            class="ma-1"
            v-show="data.customerFollowings.length + data.hotelFollowings.length >0 || data.followers.length>0"
          >
            <v-tabs-slider color="black"></v-tabs-slider>
            <v-tab href="#tab-1">followers ({{data.followers.length}})</v-tab>
            <v-tab
              href="#tab-2"
            >following ({{data.customerFollowings.length + data.hotelFollowings.length}})</v-tab>
            <v-tab-item value="tab-1">
              <v-card light flat v-for="(item,i) in data.followers" :key="i" v-show="i<4">
                <v-card-title>
                  <router-link :to="{name:'user',params:{id:item.follower.id}}">
                    <v-avatar size="52px" flat color="black">
                      <v-avatar size="50px" flat color="white">
                        <img :src="item.avatar.image_link" :alt="item.follower.name" />
                      </v-avatar>
                    </v-avatar>
                    <span class="pl-3 font-weight-bold">{{item.follower.name}}</span>
                  </router-link>
                </v-card-title>
                <v-divider class="pa-0 ma-0" v-show="i<3 && i<(data.followers.length-1)"></v-divider>
              </v-card>
            </v-tab-item>
            <v-tab-item value="tab-2">
              <v-card light flat v-for="(item,i) in data.customerFollowings" :key="i" v-show="i<4">
                <v-card-title>
                  <router-link :to="{name:'user',params:{id:item.followed.id}}">
                    <v-avatar size="52px" flat color="black">
                      <v-avatar size="50px" flat color="white">
                        <img :src="item.avatar.image_link" :alt="item.followed.name" />
                      </v-avatar>
                    </v-avatar>
                    <span class="pl-3 font-weight-bold">{{item.followed.name}}</span>
                  </router-link>
                </v-card-title>
                <v-divider class="pa-0 ma-0" v-show="i<3 && i<(data.customerFollowings.length-1)"></v-divider>
              </v-card>
            </v-tab-item>
          </v-tabs>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-flex>
    <v-dialog v-model="followDialog" persistent width="400px">
      <v-card flat tile light height="400px">
        <v-card-text>
          <v-btn depressed color="red" dark v-on:click="followDialog = false">
            <span class="text-uppercase">cancel</span>
          </v-btn>
          <v-tabs grow color="grey lighten-2" light class="ma-1">
            <v-tabs-slider color="black"></v-tabs-slider>
            <v-tab href="#tab-1">followers ({{data.followers.length}})</v-tab>
            <v-tab
              href="#tab-2"
            >following ({{data.customerFollowings.length + data.hotelFollowings.length}})</v-tab>
            <v-tab-item value="tab-1">
              <v-card light flat width="100%" height="260px" style="overflow:auto">
                <v-layout v-for="(item,i) in data.followers" :key="i">
                  <v-card-title style="width:100%">
                    <router-link :to="{name:'user',params:{id:item.follower.id}}">
                    <v-avatar size="52px" flat color="black">
                      <v-avatar size="50px" flat color="white">
                        <img :src="item.avatar.image_link" :alt="item.follower.name">
                      </v-avatar>
                    </v-avatar>
                    </router-link>
                    <v-spacer></v-spacer>
                    <v-tooltip top v-if="item.isFollowing == true">
                      <template v-slot:activator="{ on }">
                        <v-btn small depressed color="grey lighten-2" fab v-on="on">
                          <i class="fas fa-user-slash"></i>
                        </v-btn>
                      </template>
                      <span>unfollowing</span>
                    </v-tooltip>
                    <v-tooltip top v-else-if="item.isFollowing == false">
                      <template v-slot:activator="{ on }">
                        <v-btn small depressed color="grey lighten-2" fab v-on="on">
                          <i class="fas fa-user-plus"></i>
                        </v-btn>
                      </template>
                      <span>follow</span>
                    </v-tooltip>
                    <v-card-text class="pa-0 ma-0 mt-2">
                      <router-link :to="{name:'user',params:{id:item.follower.id}}"><span class="font-weight-bold">{{item.follower.name}}</span></router-link>
                      <v-divider class="pa-0 ma-0 mt-3" v-show="i<(data.followers.length-1)"></v-divider>
                    </v-card-text>
                  </v-card-title>
                </v-layout>
              </v-card>
            </v-tab-item>
            <v-tab-item value="tab-2">
              <v-card light flat width="100%" height="260px" style="overflow:auto">
                <v-layout v-for="(item,i) in data.customerFollowings" :key="i">
                  <v-card-title style="width:100%">
                    <v-avatar size="52px" flat color="black">
                      <v-avatar size="50px" flat color="white">
                        <img :src="item.avatar.image_link" :alt="item.followed.name">
                      </v-avatar>
                    </v-avatar>
                    <v-spacer></v-spacer>
                    <v-tooltip top v-if="item.isFollowing == true">
                      <template v-slot:activator="{ on }">
                        <v-btn small depressed color="grey lighten-2" fab v-on="on">
                          <i class="fas fa-user-slash"></i>
                        </v-btn>
                      </template>
                      <span>unfollowing</span>
                    </v-tooltip>
                    <v-tooltip top v-else-if="item.isFollowing == false">
                      <template v-slot:activator="{ on }">
                        <v-btn small depressed color="grey lighten-2" fab v-on="on">
                          <i class="fas fa-user-plus"></i>
                        </v-btn>
                      </template>
                      <span>follow</span>
                    </v-tooltip>
                    <v-card-text class="pa-0 ma-0 mt-2">
                      <span class="font-weight-bold">{{item.followed.name}}</span>
                      <v-divider class="pa-0 ma-0 mt-3" v-show="i<(data.customerFollowings.length-1)"></v-divider>
                    </v-card-text>
                  </v-card-title>
                </v-layout>
              </v-card>
            </v-tab-item>
          </v-tabs>
        </v-card-text>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
export default {
  props: ["user"],
  mounted() {},
  watch: {
    $route: "getData"
  },
  data() {
    return {
      followDialog: false,
      like: false,
      model: false,
      expand: [true, true, true],
      id: this.$route.params.id,
      data: {
        customer: {},
        avatar: {},
        followers: [],
        customerFollowings: [],
        hotelFollowings: [],
        review: []
      },
      color: {
        header: "#2c3e50",
        badge: "#1cc3b2",
        heart: "#ff6348",
        fullHeart: "#f8a5c2",
        comment: "#1cc3b2",
        fullComment: "#f5f6fa",
        check: "#fa8231"
      }
    };
  },
  created() {
    this.getData();
  },
  methods: {
    getData: function() {
      // if (this.user.id == this.$route.params.id) {
      //   this.$router.push({ name: "account" });
      //   return;
      // }
      this.id = this.$route.params.id
      axios({
        method: "get",
        url: "http://localhost:8000/api/userInfo",
        headers: {
            Authorization: "Bearer " + localStorage.getItem("login_token")
          },
        params: {
          id: this.id
        }
      })
        .then(res => {
          if (!res.data.status) {
            this.$router.push({ name: "account" });
            return;
          }
          console.log(res.data.user);
          this.data = res.data.user;
          return;
        })
        .catch(error => {
          console.log(error.response);
        });
    },
    followUser: function(value) {
      axios({
        method: "get",
        url: "http://localhost:8000/api/following",
        params: {
          type: 0,
          id: this.user.id,
          followed: value.id
        }
      }).then(res => {
        console.log(res.data.data);
        if (res.data.data == null) {
          this.$emit("loadSnackbar", "Something wrong!");
          return;
        }
        this.$emit("loadSnackbar", "Following " + value.name);
        this.getData();
        return;
      });
    },
    unfollowUser: function(value) {
      axios({
        method: "get",
        url: "http://localhost:8000/api/un-following",
        params: {
          type: 0,
          id: this.user.id,
          followed: value.id
        }
      }).then(res => {
        console.log(res.data.data);
        if (res.data.data == null) {
          this.$emit("loadSnackbar", "Something wrong!");
          return;
        }
        this.$emit("loadSnackbar", "Unfollowing " + value.name);
        this.getData();
        return;
      });
    }
  }
};
</script>

<style scoped>
.follow-color {
  color: #dfe4ea;
}
.unfollow-color {
  color: #2d98da;
}
.v-tooltip__content {
  opacity: 1 !important;
  padding: 4px !important;
  border-bottom-left-radius: 20%;
  box-shadow: none !important;
}
.v-menu__content {
  box-shadow: none !important;
}
.radius {
  border-bottom-left-radius: 20%;
}
</style>