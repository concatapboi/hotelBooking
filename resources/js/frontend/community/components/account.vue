<template>
  <v-layout row wrap class="mx-3">
    <v-flex shrink md8>
      <v-img :aspect-ratio="16/4" :src="cover.link" class="mr-2 radius">
        <v-layout row wrap fill-height class="lightbox white--text mt-5 mb-1">
          <v-spacer></v-spacer>
          <v-flex md9 shrink class="pl-3">
            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-avatar size="90px" tile flat color="white" class="ml-4" v-on="on">
                  <img :src="avatar.link" alt>
                </v-avatar>
              </template>
              <span>{{user.name}}</span>
            </v-tooltip>
            <div class="subheading font-weight-black mt-2">{{user.name}}</div>
            <div class="body-1">{{user.email}}</div>
          </v-flex>
          <v-flex>
            <v-menu bottom left>
              <template v-slot:activator="{ on }">
                <v-btn dark icon v-on="on">
                  <v-icon color="cyan lighten-4">settings</v-icon>
                </v-btn>
              </template>
              <v-list>
                <v-list-tile v-on:click="dialog = true">
                  <v-list-tile-action>
                    <span class="subheading pointer">Change pictures</span>
                  </v-list-tile-action>
                </v-list-tile>
                <v-divider></v-divider>
                <v-list-tile v-on:click="timelineFeed">
                  <v-list-tile-action>
                    <span class="subheading pointer">Timeline</span>
                  </v-list-tile-action>
                </v-list-tile>
                <v-divider></v-divider>
                <v-list-tile v-on:click="followFeed">
                  <v-list-tile-action>
                    <span class="subheading pointer">Following and followers</span>
                  </v-list-tile-action>
                </v-list-tile>
              </v-list>
            </v-menu>
          </v-flex>
          <v-dialog
            v-model="dialog"
            fullscreen
            hide-overlay
            transition="dialog-bottom-transition"
            scrollable
          >
            <v-card tile class="grey lighten-4">
              <v-toolbar card flat dark :color="color.header">
                <v-btn icon dark v-on:click="dialog = false">
                  <v-icon v-on:click="cancel">close</v-icon>
                </v-btn>
                <v-toolbar-title class="text-uppercase">cover &amp; avatar pictures</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-toolbar-items>
                  <v-btn dark flat v-on:click="save">Save</v-btn>
                </v-toolbar-items>
              </v-toolbar>
              <v-card-text class="py-0">
                <v-layout row wrap justify-center align-center>
                  <v-flex md12>
                    <v-card-title class="pa-2 pt-4">
                      <span class="text-uppercase font-weight-bold ml-5">cover gallery</span>
                      <v-spacer></v-spacer>
                      <v-tooltip top v-if="cover.hide">
                        <template v-slot:activator="{ on }">
                          <v-btn
                            flat
                            dark
                            :color="color.header"
                            class="mr-5"
                            v-on:click="cover.hide = false"
                            v-on="on"
                          >
                            <v-icon large>expand_less</v-icon>
                          </v-btn>
                        </template>
                        <span>Hide</span>
                      </v-tooltip>
                      <v-tooltip top v-else>
                        <template v-slot:activator="{ on }">
                          <v-btn
                            flat
                            dark
                            :color="color.header"
                            class="mr-5"
                            v-on:click="cover.hide = true"
                            v-on="on"
                          >
                            <v-icon large>expand_more</v-icon>
                          </v-btn>
                        </template>
                        <span>Show</span>
                      </v-tooltip>
                    </v-card-title>
                    <v-divider></v-divider>
                    <v-card-text v-show="cover.hide">
                      <v-layout row wrap justify-start align-center>
                        <v-flex md2 class="pa-2">
                          <v-card flat tile color="teal" class="pl-3">
                            <v-tooltip top>
                              <template v-slot:activator="{ on }">
                                <v-btn
                                  large
                                  depressed
                                  fab
                                  icon
                                  flat
                                  color="black"
                                  class="ml-5"
                                  v-on="on"
                                >
                                  <v-icon medium color="white">add_photo_alternate</v-icon>
                                </v-btn>
                              </template>
                              <span>Upload</span>
                            </v-tooltip>
                          </v-card>
                        </v-flex>
                        <v-flex md3 class="pa-2" v-for="(img,i) in covers" :key="i">
                          <v-hover>
                            <v-card slot-scope="{ hover }">
                              <v-img :aspect-ratio="16/9" :src="img.link">
                                <v-expand-transition>
                                  <div
                                    v-if="hover"
                                    class="v-card--reveal teal transition-fast-in-fast-out"
                                    style="height: 100%;"
                                  >
                                    <v-btn large depressed fab icon flat color="black">
                                      <v-icon
                                        medium
                                        :color="color.check"
                                        v-if="cover.temp===img.link"
                                      >check</v-icon>
                                      <v-icon
                                        medium
                                        color="white"
                                        v-else
                                        v-on:click="cover.temp=img.link"
                                      >check</v-icon>
                                    </v-btn>
                                  </div>
                                </v-expand-transition>
                              </v-img>
                            </v-card>
                          </v-hover>
                        </v-flex>
                      </v-layout>
                    </v-card-text>
                  </v-flex>
                  <v-flex md12>
                    <v-card-title class="pa-2 pt-4">
                      <span class="text-uppercase font-weight-bold ml-5">avatar gallery</span>
                      <v-spacer></v-spacer>
                      <v-tooltip top v-if="avatar.hide">
                        <template v-slot:activator="{ on }">
                          <v-btn
                            flat
                            dark
                            :color="color.header"
                            class="mr-5"
                            v-on:click="avatar.hide = false"
                            v-on="on"
                          >
                            <v-icon large>expand_less</v-icon>
                          </v-btn>
                        </template>
                        <span>Hide</span>
                      </v-tooltip>
                      <v-tooltip top v-else>
                        <template v-slot:activator="{ on }">
                          <v-btn
                            flat
                            dark
                            :color="color.header"
                            class="mr-5"
                            v-on:click="avatar.hide = true"
                            v-on="on"
                          >
                            <v-icon large>expand_more</v-icon>
                          </v-btn>
                        </template>
                        <span>Show</span>
                      </v-tooltip>
                    </v-card-title>
                    <v-divider></v-divider>
                    <v-card-text v-show="avatar.hide">
                      <v-layout row wrap justify-start align-center>
                        <v-flex md2 class="pa-2">
                          <v-card flat tile color="teal" class="pl-3">
                            <v-tooltip top>
                              <template v-slot:activator="{ on }">
                                <v-btn
                                  large
                                  depressed
                                  fab
                                  icon
                                  flat
                                  color="black"
                                  class="ml-5"
                                  v-on="on"
                                >
                                  <v-icon medium color="white">add_photo_alternate</v-icon>
                                </v-btn>
                              </template>
                              <span>Upload</span>
                            </v-tooltip>
                          </v-card>
                        </v-flex>
                        <v-flex md2 class="pa-2" v-for="(img,i) in avatars" :key="i">
                          <v-hover>
                            <v-card slot-scope="{ hover }">
                              <v-img :aspect-ratio="1" :src="img.link">
                                <v-expand-transition>
                                  <div
                                    v-if="hover"
                                    class="v-card--reveal1 teal transition-fast-in-fast-out"
                                    style="height: 100%;"
                                  >
                                    <v-btn large depressed fab icon flat color="black">
                                      <v-icon
                                        medium
                                        :color="color.check"
                                        v-if="avatar.temp===img.link"
                                      >check</v-icon>
                                      <v-icon
                                        medium
                                        color="white"
                                        v-else
                                        v-on:click="avatar.temp=img.link"
                                      >check</v-icon>
                                    </v-btn>
                                  </div>
                                </v-expand-transition>
                              </v-img>
                            </v-card>
                          </v-hover>
                        </v-flex>
                      </v-layout>
                    </v-card-text>
                  </v-flex>
                </v-layout>
              </v-card-text>
            </v-card>
          </v-dialog>
        </v-layout>
      </v-img>
      <v-layout class="row wrap mx-3 mb-3 mt-2" v-for="(item,index) in 3" :key="index" v-show="feeds.timeline">
        <v-badge left overlap :color="color.badge">
          <template v-slot:badge>
            <v-tooltip top v-if="comment">
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
              <v-spacer></v-spacer>
              <v-tooltip top>
                <template v-slot:activator="{ on }">
                  <v-icon medium :color="color.grey" v-on="on">close</v-icon>
                </template>
                <span>Hide</span>
              </v-tooltip>
            </v-card-title>
            <v-card-text>
              <span class="headline white--text">" Lorem is the worst! "</span>
              <v-layout>
                <v-card flat tile tag="div" class="radius">
                  <v-card-text
                    class="font-weight-bold font-italic"
                  >Lorem, ipsum dolor sit amet consectetur adipisicing elit. Alias praesentium dolorum rem temporibus fuga ad eos mollitia quidem natus veritatis, perspiciatis culpa distinctio consequuntur voluptatibus quaerat fugit? Rem, excepturi aperiam!</v-card-text>
                </v-card>
              </v-layout>
              <span class="grey--text">&nbsp;21/4/2019</span>
            </v-card-text>
            <v-card-actions>
              <v-tooltip top>
                <template v-slot:activator="{ on }">
                  <v-icon
                    v-on="on"
                    class="ml-3 mr-1"
                    large
                    :color="color.heart"
                    v-on:click="like =!like"
                    v-if="!like"
                  >favorite_border</v-icon>
                  <v-icon
                    v-on="on"
                    class="ml-3 mr-1"
                    large
                    :color="color.heart"
                    v-on:click="like =!like"
                    v-else
                  >favorite</v-icon>
                </template>
                <span>like</span>
              </v-tooltip>
              <span class="white--text subheading">6</span>
              <v-tooltip top>
                <template v-slot:activator="{ on }">
                  <v-icon
                    v-on="on"
                    class="ml-3 mr-1"
                    large
                    :color="color.comment"
                    v-on:click="model = !model"
                    v-if="!model"
                  >chat_bubble_outline</v-icon>
                  <v-icon
                    v-on="on"
                    class="ml-3 mr-1"
                    large
                    :color="color.comment"
                    v-on:click="model = !model"
                    v-else
                  >chat_bubble</v-icon>
                </template>
                <span>comment</span>
              </v-tooltip>
              <span class="white--text subheading">2</span>
            </v-card-actions>
            <v-layout class="row wrap" justify-center v-if="model">
              <v-card flat tile width="790px" class="mb-1" v-for="(value,i) in 2" :key="i">
                <v-card-title>
                  <v-avatar size="40px" flat color="white">
                    <img :src="avatar.link">
                  </v-avatar>
                  <span class="pl-3">Henry Catly</span>
                </v-card-title>
                <v-card-text>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam libero rerum nam, enim praesentium labore eum beatae quasi in nemo commodi aperiam. Iure nemo a, quis eos consequuntur veritatis dolorum!</v-card-text>
              </v-card>
              <v-card flat tile width="790px" v-show="comment">
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
      <v-layout class="row wrap mx-3 mb-3 mt-2" v-show="feeds.follow">
        follow
      </v-layout>
    </v-flex>
    <v-flex shrink md4>
      <v-expansion-panel dark class="elevation-0" expand v-model="expand">
        <v-expansion-panel-content class="mb-3">
          <template v-slot:actions>
            <v-icon>expand_more</v-icon>
          </template>
          <template v-slot:header>
            <div class="title my-3 text-uppercase">
              <v-icon>assignment_ind</v-icon>&nbsp;profile
            </div>
          </template>
          <v-btn class="caption" v-on:click.stop="openFormUserInfo">
            <v-icon small>create</v-icon>&nbsp;Change
          </v-btn>
          <v-card>
            <v-card-text>
              <v-layout row wrap justify-left>
                <v-card flat tile class="mb-1" width="100%">
                  <v-divider class="ma-0"></v-divider>
                  <v-card-text>
                    <v-icon color="red">looks_one</v-icon>USERNAME:&nbsp;
                    <span class="headline">{{user.username}}</span>
                    <v-spacer></v-spacer>
                    <v-icon color="orange">looks_two</v-icon>
                    NAME:&nbsp;{{user.name}}
                    <v-spacer></v-spacer>
                    <v-icon color="yellow">looks_3</v-icon>
                    EMAIL:&nbsp;{{user.email}}
                    <v-spacer></v-spacer>
                    <v-icon color="green">looks_4</v-icon>
                    PHONE:&nbsp;{{user.phone_number}}
                    <v-spacer></v-spacer>
                    <v-icon color="blue">looks_5</v-icon>
                    COIN:&nbsp;{{customer.coin}}
                    <v-spacer></v-spacer>
                    <v-icon color="indigo">looks_6</v-icon>
                    ADDRESS:&nbsp;{{customer.address}}
                  </v-card-text>
                </v-card>
              </v-layout>
            </v-card-text>
          </v-card>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-flex>
    <v-dialog v-model="formgDialog" width="700px">
      <v-card color="grey lighten-4" flat tile width="100%" class="pa-5">
        <v-form ref="form">
          <v-layout row wrap align-top justify-center>
            <v-flex md4 pa-2>
              <v-text-field
                outline
                :error-messages="errors.collect('username')"
                data-vv-name="username"
                name="username"
                color="teal"
                v-model="form.username"
                label="Username"
                v-validate="'required|min:3'"
              ></v-text-field>
              <v-text-field
                outline
                :error-messages="errors.collect('email')"
                data-vv-name="email"
                name="email"
                color="teal"
                v-model="form.email"
                label="Email"
                v-validate="'required|email'"
              ></v-text-field>
            </v-flex>
            <v-flex md8 pa-2>
              <v-text-field outline name="name" color="teal" v-model="form.name" label="Name"></v-text-field>
              <v-text-field outline name="phone" color="teal" v-model="form.phone" label="Phone"></v-text-field>
            </v-flex>
            <v-flex md12 px-2>  
              <v-textarea
                outline
                name="address"
                auto-grow
                rows="1"
                color="teal"
                v-model="form.address"
                label="Address"
              ></v-textarea>
              <v-btn color="teal" v-on:click="submit" dark depressed>Submit</v-btn>
              <v-btn color="grey" v-on:click="clear" dark depressed>Clear</v-btn>
              <v-btn color="red" v-on:click="formgDialog=false" dark depressed>Cancel</v-btn>
            </v-flex>
            <v-flex></v-flex>
          </v-layout>
        </v-form>
      </v-card>
    </v-dialog>
    
  </v-layout>
</template>

<script>
export default {
  $_veeValidate: {
    validator: "new"
  },
  props: ["hello"],
  data() {
    return {      
      feeds:{
        timeline: true,
        follow: false,
      },
      user: [],
      customer: [],
      userFollowing: 0,
      hotelFollowing: 0,
      followers: 0,
      form: {
        username: "",
        email: "",
        name: "",
        phone: "",
        address: ""
      },
      dictionary: {
        attributes: {
          email: "Email Address"
        },
        custom: {
          username: {
            required: () => "Username can not be empty",
            min: "The username field may be tiner than 3 characters"
          },
          email: {
            required: () => "Email can not be empty"
          }
        }
      },
      comment: true,
      like: false,
      model: false,
      expand: [true, true, false],
      color: {
        header: "#2c3e50",
        badge: "#1cc3b2",
        heart: "#ff6348",
        fullHeart: "#f8a5c2",
        comment: "#1cc3b2",
        fullComment: "#f5f6fa",
        check: "#fa8231"
      },
      avatars: [
        { link: "http://localhost:8000/img/dog3.png" },
        { link: "http://localhost:8000/img/spider-man.png" },
        { link: "http://localhost:8000/img/poop.png" },
        { link: "http://localhost:8000/img/avatar1.png" },
        { link: "http://localhost:8000/img/rocket.png" },
        { link: "http://localhost:8000/img/snake.png" },
        { link: "http://localhost:8000/img/fish.png" },
        { link: "http://localhost:8000/img/face2.png" },
        { link: "http://localhost:8000/img/dinosaur.png" }
      ],
      covers: [
        {
          id: 1,
          link: "http://localhost:8000/img/cover/1.jpg"
        },
        {
          id: 2,
          link: "http://localhost:8000/img/cover/2.jpg"
        },
        {
          id: 3,
          link: "http://localhost:8000/img/cover/3.jpg"
        },
        {
          id: 4,
          link: "http://localhost:8000/img/cover/4.jpg"
        },
        {
          id: 5,
          link: "http://localhost:8000/img/cover/5.jpg"
        },
        {
          id: 6,
          link: "http://localhost:8000/img/cover/6.jpg"
        }
      ],
      dialog: false,
      formgDialog: false,
      id: 4,
      avatar: {
        hide: true,
        item: null,
        link: null,
        temp: null
      },
      cover: {
        hide: true,
        link: "http://localhost:8000/img/cover/5.jpg",
        temp: "http://localhost:8000/img/cover/5.jpg"
      },
      album: {
        hide: false
      }
    };
  },
  mounted() {
    this.$validator.localize("en", this.dictionary);
  },
  created() {
    this.getInfo();
  },
  methods: {
    timelineFeed: function(){
      this.feeds.timeline = true;
      this.feeds.follow = false;
    },
    followFeed: function(){
      this.feeds.timeline = false;
      this.feeds.follow = true;
    },
    openFormUserInfo: function(){
      this.formgDialog =true;
      this.form.username = this.user.username;
      this.form.name = this.user.name;
      this.form.email = this.user.email;
      this.form.address = this.customer.address;
      this.form.phone = this.user.phone_number;
    },
    clear: function() {
      this.$refs.form.reset();
      this.$validator.reset();
    },
    submit: function() {
      this.$validator.validateAll().then(valid => {
        if (valid) {
          axios({
            method: "get",
            url: "http://localhost:8000/api/check-user/",
            params: {
              id: this.id,
              username: this.form.username,
              email: this.form.email
            }
          }).then(res => {
            if (!res.data.status.flag) {
              if (res.data.status.username) alert("Username is exist!");
              if (res.data.status.email) alert("Email is exist!");
              return;
            }
            axios({
              method: "put",
              url: "http://localhost:8000/api/user/" + this.id,
              params: {
                id: this.id,
                username: this.form.username,
                email: this.form.email,
                phone_number: this.form.phone,
                address: this.form.address,
                name: this.form.name
              }
            }).then(res => {
              console.log(res.data.status);
              this.getInfo();
              this.$emit("loadUser", true);
              this.$emit("loadSnackbar", "Updated!");              
              this.formgDialog = false;
              return;
            });
          });
        }
      });
    },
    getInfo: function() {
      axios({
        method: "get",
        url: "http://localhost:8000/api/user/" + this.id,
        params: {
          id: this.id
        }
      }).then(res => {
        console.log(res.data.avatar.image_link);
        if (!res.data.status) {
          this.$router.push({ name: "login" });
          return;
        }
        this.user = res.data.user;
        this.customer = res.data.customer;
        this.userFollowing = res.data.userFollowing;
        this.hotelFollowing = res.data.hotelFollowing;
        this.followers = res.data.followers;
        this.avatar.item = res.data.avatar;
        this.avatar.temp = this.avatar.link = res.data.avatar.image_link;
        return;
      });
    },
    cancel: function() {
      this.dialog = false;
      this.cover.temp = this.cover.link;
      this.avatar.temp = this.avatar.link;
    },
    save: function() {
      axios({
        method: "put",
        url: "http://localhost:8000/api/image/" + this.avatar.item.id,
        params: {
          id: this.avatar.item.id,
          link: this.avatar.temp
        }
      }).then(res => {
        console.log(res.data.mess);
        if (res.data.mess) {
          this.dialog = false;
          this.cover.link = this.cover.temp;
          this.avatar.link = this.avatar.temp;
          this.$emit("loadUser", true);
          return;
        }
        return;
      });
      mfnzbzs3atgn;
    },
    hello2: function() {
      this.hello = "new 2";
      this.$emit("helloEdited", this.hello);
      alert(this.hello);
    }
  }
};
</script>
<style scoped>
.v-card--reveal,
.v-card--reveal1 {
  align-items: center;

  bottom: 0;
  justify-content: center;
  opacity: 0.7;
  position: absolute;
  width: 100%;
}
.v-card--reveal {
  padding-left: 30%;
  padding-top: 15%;
}
.v-card--reveal1 {
  padding-left: 30%;
  padding-top: 20%;
}
.radius {
  border-bottom-left-radius: 20%;
}
.pointer {
  cursor: pointer;
}
.enterButton {
  width: 90px;
  height: 60px;
  background-color: #1cc3b2;
  cursor: pointer;
}
</style>

