<template>
  <v-layout row wrap class="mx-3">
    <v-flex shrink md8>
      <v-img :aspect-ratio="16/4" src="/blog/img/slider/default.png" class="mr-2 radius mb-3">
        <v-layout row wrap fill-height class="lightbox white--text mt-5 mb-1 pl-5">
          <!-- <v-spacer></v-spacer> -->
          <v-flex md9 shrink class="pl-5">
            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-avatar size="90px" tile flat color="white" v-on="on">
                  <img :src="user.avatar.image_link" alt />
                </v-avatar>
              </template>
              <span>{{user.name}}</span>
            </v-tooltip>
            <div class="subheading font-weight-black mt-2">{{user.name}}</div>
            <div class="body-1">{{user.email}}</div>
          </v-flex>
          <v-spacer></v-spacer>
          <!-- <v-flex md3>
            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-btn dark large icon v-on:click="dialog = true" v-on="on">
                  <v-icon medium color="blue darken-4">insert_photo</v-icon>
                </v-btn>
              </template>
              <span>Change pictures</span>
            </v-tooltip>
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
                <v-btn icon dark v-on:click="cancel">
                  <v-icon>close</v-icon>
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
          </v-dialog>-->
        </v-layout>
      </v-img>
      <div v-if="user.review.length !=0">
        <v-layout class="row wrap mx-3 mb-5" v-for="(item,index) in user.review" :key="index">
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
                      <v-card-text class="font-weight-bold font-italic">{{item.content}}</v-card-text>
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
              <v-divider v-show="item.comments>0 && item.model"></v-divider>
              <v-layout class="row wrap" justify-center v-if="item.model">
                <v-card
                  light
                  flat
                  tile
                  width="790px"
                  class="mb-1"
                  v-for="(value,i) in item.comment"
                  :key="i"
                >
                  <v-card-title>
                    <v-avatar size="42px" color="black" flat>
                      <v-avatar size="40px" flat color="white">
                        <img :src="value.customer.avatar.image_link" />
                      </v-avatar>
                    </v-avatar>
                    <span class="pl-3">{{value.customer.name}}</span>
                  </v-card-title>
                  <v-card-text>
                    <v-layout>
                      <v-card
                        flat
                        tile
                        tag="div"
                        color="grey lighten-2"
                        width="100%"
                        class="radius"
                      >
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
                        <v-btn round large depressed dark color="teal" @click="sendComment">
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
      </div>
      <div v-else class="mx-3 pa-4 text-md-center border">
        <span class="text-uppercase">no reviews yet</span>
      </div>
    </v-flex>
    <v-flex shrink md4>
      <v-expansion-panel light class="elevation-0" v-model="expand">
        <v-expansion-panel-content class="mb-3">
          <template v-slot:actions>
            <v-icon>expand_more</v-icon>
          </template>
          <template v-slot:header>
            <div class="title my-3 text-uppercase font-weight-black">
              <v-icon color="black">assignment_ind</v-icon>&nbsp;profile
            </div>
          </template>
          <v-btn round depressed color="grey lighten-2" v-on:click.stop="openFormUserInfo">
            <v-icon small>create</v-icon>&nbsp;update
          </v-btn>
          <v-btn
            round
            depressed
            color="grey lighten-2"
            v-on:click.stop="passDialog.check = true; form.pass=''"
          >
            <v-icon small>create</v-icon>&nbsp;change password
          </v-btn>
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
                <span class="font-weight-black subheading">{{user.username}}</span>
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
                <span class="font-weight-black">{{user.name}}</span>
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
                <span class="font-weight-black">{{user.email}}</span>
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
                <span class="font-weight-black">{{user.phone_number}}</span>
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
                <span class="font-weight-black">{{user.customer.coin}}</span>
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
                <span class="font-weight-black">{{user.customer.address}}</span>
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
              <i class="fas fa-list-ol black--text"></i>&nbsp;booking list
            </div>
          </template>
          <v-btn round depressed color="grey lighten-2" @click.stop="openBookingListDialog">
            <v-icon small>notes</v-icon>&nbsp;see all
          </v-btn>
          <v-divider class="ma-0 pa-0"></v-divider>
          <v-container class="pa-1 ma-0">
            <v-layout
              row
              wrap
              align-center
              class="pa-3 ma-3 border"
              v-for="(b,i) in user.booking"
              :key="i"
              v-show="i<3"
            >
              <v-flex md6>
                <div>
                  <div>
                    ID:&nbsp;
                    <span class="font-weight-black">{{b.id}}</span>
                  </div>
                  <div>
                    Total:&nbsp;
                    <span
                      class="font-weight-black"
                    >{{ (b.room_amount*b.room_price).toLocaleString('en-US', {style: 'currency',currency: 'USD',})}}</span>
                  </div>
                </div>
              </v-flex>
              <v-flex md6>
                <div>
                  <div>
                    Status:&nbsp;
                    <span class="orange--text">{{b.status.name}}</span>
                  </div>
                  <div>
                    Method:&nbsp;
                    <span class="teal--text">{{b.payment_method.name}}</span>
                  </div>
                </div>
              </v-flex>
              <v-flex md12>
                <v-divider class="pa-0 ma-0"></v-divider>
              </v-flex>
              <v-flex md12 class="mt-2">
                <div class="pl-3 body-2 font-italic" v-if="b.can_review == true">
                  No review yet.&nbsp;
                  <span class="pointer purple--text" @click="openReviewForm(b)">Review?</span>
                </div>
                <div class="pl-3 body-2 font-italic">
                  <span class="pointer teal--text" @click="bookingAction(b,1)">More...</span>
                </div>
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
              <i class="fas fa-question black--text"></i>&nbsp;question list
            </div>
          </template>
          <v-btn
            round
            depressed
            color="grey lighten-2"
            @click.stop="openQuestionListDialog"
            v-if="user.question.length!=0"
          >
            <v-icon small>notes</v-icon>&nbsp;see all
          </v-btn>
          <v-divider class="ma-0 pa-0"></v-divider>
          <v-container class="pa-1 ma-0">
            <v-layout
              row
              wrap
              align-center
              class="pa-3 ma-3 border"
              v-for="(q,i) in user.question"
              :key="i"
              v-show="i<3"
            >
              <v-flex md12>
                <div>
                  <div>
                    Title:&nbsp;
                    <span class="font-weight-black">{{q.title}}</span>
                  </div>
                  <div>
                    Content:&nbsp;
                    <span class="font-weight-black">"{{q.content}}"</span>
                  </div>
                </div>
              </v-flex>
              <v-flex md12 v-if="q.reply!=null">
                <v-divider class="pa-0 ma-0"></v-divider>
              </v-flex>
              <v-flex md12 v-if="q.reply !=null">
                <div>
                  <span>{{q.hotel.name}}:&nbsp;"{{q.reply.content}}"</span>
                </div>
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
          <v-btn round depressed color="grey lighten-2" v-on:click="followDialog = true">
            <v-icon small>notes</v-icon>&nbsp;see all
          </v-btn>
          <v-tabs centered grow color="grey lighten-2" light class="ma-1">
            <v-tabs-slider color="black"></v-tabs-slider>
            <v-tab href="#tab-1">followers</v-tab>
            <v-tab href="#tab-2">following</v-tab>
            <v-tab-item value="tab-1">
              <v-card light flat v-for="(item,i) in user.followers" :key="i" v-show="i<4">
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
                <v-divider class="pa-0 ma-0" v-show="i<3 && i<(user.followers.length-1)"></v-divider>
              </v-card>
            </v-tab-item>
            <v-tab-item value="tab-2">
              <v-card light flat v-for="(item,i) in user.customerFollowings" :key="i" v-show="i<4">
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
                <v-divider class="pa-0 ma-0" v-show="i<3 && i<(user.customerFollowings.length-1)"></v-divider>
              </v-card>
            </v-tab-item>
          </v-tabs>
        </v-expansion-panel-content>
      </v-expansion-panel>
    </v-flex>
    <v-dialog v-model="formDialog" width="700px" persistent>
      <v-card color="grey lighten-4" flat tile width="100%" class="pa-5">
        <v-form ref="form" data-vv-scope="form1">
          <v-layout row wrap align-top justify-center>
            <v-card-title class="title text-uppercase font-weight-bold">infomation</v-card-title>
            <v-flex md12 pa-2>
              <v-text-field outline name="name" color="teal" v-model="form.name" label="Name"></v-text-field>
            </v-flex>
            <v-flex md12 pa-2>
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
              <v-btn color="red" v-on:click="formDialog=false" dark depressed>Cancel</v-btn>
            </v-flex>
            <v-flex></v-flex>
          </v-layout>
        </v-form>
      </v-card>
    </v-dialog>
    <v-dialog v-model="passDialog.check" width="700px" persistent>
      <v-card color="grey lighten-4" flat tile width="100%" class="pa-5">
        <v-form ref="form">
          <v-layout row wrap align-top justify-center>
            <v-card-title
              class="title text-uppercase font-weight-bold"
            >your present password, again!</v-card-title>
            <v-flex md12 px-2>
              <v-text-field
                outline
                color="teal"
                v-model="form.pass"
                label="Password"
                type="password"
                append-icon="visibility"
                v-on:click:append="value = true"
                v-if="!value"
              ></v-text-field>
              <v-text-field
                outline
                color="teal"
                v-model="form.pass"
                label="Password"
                type="text"
                append-icon="visibility_off"
                v-on:click:append="value = false"
                v-else
              ></v-text-field>
              <v-btn color="teal" v-on:click="checkPass" dark depressed>Submit</v-btn>
              <v-btn color="grey" v-on:click="clear" dark depressed>Clear</v-btn>
              <v-btn color="red" v-on:click="passDialog.check=false" dark depressed>Cancel</v-btn>
            </v-flex>
            <v-flex></v-flex>
          </v-layout>
        </v-form>
      </v-card>
    </v-dialog>
    <v-dialog v-model="passDialog.main" width="700px" persistent>
      <v-card color="grey lighten-4" flat tile width="100%" class="pa-5">
        <v-form ref="form" data-vv-scope="form2">
          <v-layout row wrap align-top justify-center>
            <v-card-title class="title text-uppercase font-weight-bold">new password</v-card-title>
            <v-flex md12 px-2>
              <v-text-field
                :error-messages="errors.collect('form2.password')"
                data-vv-name="password"
                ref="password"
                v-validate="'required|min:4'"
                type="password"
                outline
                color="teal"
                v-model="form.newPass"
                label="New password"
                append-icon="visibility"
                v-on:click:append="value=true"
                v-if="!value"
              ></v-text-field>
              <v-text-field
                :error-messages="errors.collect('form2.password')"
                data-vv-name="password"
                ref="password"
                v-validate="'required|min:4'"
                type="text"
                outline
                color="teal"
                v-model="form.newPass"
                label="New password"
                append-icon="visibility_off"
                v-on:click:append="value=false"
                v-else
              ></v-text-field>
              <v-text-field
                :error-messages="errors.collect('form2.password_confirmation')"
                data-vv-as="password"
                data-vv-name="password_confirmation"
                v-validate="'required|confirmed:password'"
                type="password"
                outline
                color="teal"
                v-model="form.rePass"
                label="Value, again!"
                append-icon="visibility"
                v-on:click:append="value1=true"
                v-if="!value1"
              ></v-text-field>
              <v-text-field
                :error-messages="errors.collect('form2.password_confirmation')"
                data-vv-as="password"
                data-vv-name="password_confirmation"
                v-validate="'required|confirmed:password'"
                type="text"
                outline
                color="teal"
                v-model="form.rePass"
                label="Value, again!"
                append-icon="visibility_off"
                v-on:click:append="value1=false"
                v-else
              ></v-text-field>
              <v-btn color="teal" v-on:click="submitPass" dark depressed>Submit</v-btn>
              <v-btn color="grey" v-on:click="clear" dark depressed>Clear</v-btn>
              <v-btn color="red" v-on:click="passDialog.main=false" dark depressed>Cancel</v-btn>
            </v-flex>
            <v-flex></v-flex>
          </v-layout>
        </v-form>
      </v-card>
    </v-dialog>
    <v-dialog v-model="followDialog" persistent width="400px">
      <v-card flat tile light height="400px">
        <v-card-text>
          <v-btn depressed color="red" dark v-on:click="followDialog = false">
            <span class="text-uppercase">cancel</span>
          </v-btn>
          <v-tabs grow color="grey lighten-2" light class="ma-1">
            <v-tabs-slider color="black"></v-tabs-slider>
            <v-tab href="#tab-1">followers</v-tab>
            <v-tab href="#tab-2">following</v-tab>
            <v-tab-item value="tab-1">
              <v-card light flat width="100%" height="260px" style="overflow:auto">
                <v-layout v-for="(item,i) in user.followers" :key="i">
                  <v-card-title style="width:100%">
                    <router-link :to="{name:'user',params:{id:item.follower.id}}">
                      <v-avatar size="52px" flat color="black">
                        <v-avatar size="50px" flat color="white">
                          <img :src="item.avatar.image_link" :alt="item.follower.name" />
                        </v-avatar>
                      </v-avatar>
                    </router-link>
                    <v-spacer></v-spacer>
                    <v-tooltip top>
                      <template v-slot:activator="{ on }">
                        <v-btn small depressed color="grey lighten-2" fab v-on="on">
                          <i class="fas fa-user-slash"></i>
                        </v-btn>
                      </template>
                      <span>unfollowing</span>
                    </v-tooltip>
                    <v-card-text class="pa-0 ma-0 mt-2">
                      <router-link :to="{name:'user',params:{id:item.follower.id}}">
                        <span class="font-weight-bold">{{user.name}}</span>
                      </router-link>
                      <v-divider class="pa-0 ma-0 mt-3" v-show="i<(user.followers.length-1)"></v-divider>
                    </v-card-text>
                  </v-card-title>
                </v-layout>
              </v-card>
            </v-tab-item>
            <v-tab-item value="tab-2">
              <v-card light flat width="100%" height="260px" style="overflow:auto">
                <v-layout v-for="(item,i) in user.customerFollowings" :key="i">
                  <v-card-title style="width:100%">
                    <router-link :to="{name:'user',params:{id:item.followed.id}}">
                      <v-avatar size="52px" flat color="black">
                        <v-avatar size="50px" flat color="white">
                          <img :src="item.avatar.image_link" :alt="item.followed.name" />
                        </v-avatar>
                      </v-avatar>
                    </router-link>
                    <v-spacer></v-spacer>
                    <v-tooltip top>
                      <template v-slot:activator="{ on }">
                        <v-btn small depressed color="grey lighten-2" fab v-on="on">
                          <i class="fas fa-user-slash"></i>
                        </v-btn>
                      </template>
                      <span>unfollowing</span>
                    </v-tooltip>
                    <v-card-text class="pa-0 ma-0 mt-2">
                      <router-link :to="{name:'user',params:{id:item.followed.id}}">
                        <span class="font-weight-bold">{{item.followed.name}}</span>
                      </router-link>
                      <v-divider
                        class="pa-0 ma-0 mt-3"
                        v-show="i<(user.customerFollowings.length-1)"
                      ></v-divider>
                    </v-card-text>
                  </v-card-title>
                </v-layout>
              </v-card>
            </v-tab-item>
          </v-tabs>
        </v-card-text>
      </v-card>
    </v-dialog>
    <v-dialog v-model="bookingList.dialog" width="700px" persistent>
      <v-card flat tile light height="470px">
        <v-card-text>
          <v-btn depressed color="red" dark v-on:click="bookingList.dialog = false">
            <span class="text-uppercase">close</span>
          </v-btn>
          <v-card light flat width="100%" height="370px" style="overflow:auto">
            <v-data-table
              :rows-per-page-items='[5,10,15,{"text":"$vuetify.dataIterator.rowsPerPageAll","value":-1}]'
              :headers="tblHeaders.booking"
              :items="user.booking"
              class="elevation-0 border"
            >
              <template v-slot:items="b">
                <td>
                  <a href="#">
                    <span style="word-wrap: break-word;">{{ b.item.id }}</span>
                  </a>
                </td>
                <td class="border-left">
                  <a href="#">
                    <span
                      style="word-wrap: break-word;"
                    >{{ (b.item.room_amount*b.item.room_price).toLocaleString('en-US', {style: 'currency',currency: 'USD',})}}</span>
                  </a>
                </td>
                <td class="border-left">
                  <a href="#">
                    <span style="word-wrap: break-word;">{{ b.item.status.name}}</span>
                  </a>
                </td>
                <td class="border-left">
                  <v-btn depressed color="teal" dark small @click="bookingAction(b.item,1)">detail</v-btn>
                  <v-btn
                    :disabled="!b.item.cancel_status"
                    depressed
                    color="orange"
                    small
                    @click="confirmAction(b.item)"
                  >cancel</v-btn>
                </td>
              </template>
            </v-data-table>
          </v-card>
        </v-card-text>
      </v-card>
    </v-dialog>
    <v-dialog v-model="questionList.dialog" width="700px" persistent>
      <v-card flat tile light height="470px">
        <v-card-text>
          <v-btn depressed color="red" dark v-on:click="questionList.dialog = false">
            <span class="text-uppercase">close</span>
          </v-btn>
          <v-card light flat width="100%" height="370px" style="overflow:auto">
            <v-data-table
              :rows-per-page-items='[2,4,6,{"text":"$vuetify.dataIterator.rowsPerPageAll","value":-1}]'
              :headers="tblHeaders.question"
              hide-headers
              :items="user.question"
              class="elevation-0 border"
            >
              <template v-slot:items="q">
                <td>
                  <div class="ma-2">
                    <div>
                      <span
                        class="font-weight-black"
                        style="word-wrap: break-word;"
                      >{{q.item.title}}</span>
                      <span class="caption grey--text">-&nbsp;12/07/2019</span>
                    </div>
                    <div>
                      <span class="font-italic" style="word-wrap: break-word;">"{{q.item.content}}"</span>
                    </div>
                  </div>
                  <v-divider class="pa-0 ma-0"></v-divider>
                  <div class="ma-2" v-if="q.item.reply !=null">
                    <div>
                      <span class="font-weight-black" style="word-wrap: break-word;">
                        <router-link
                          :to="{name:'hotel', params:{id:q.item.hotel.id}}"
                          target="_blank"
                        >{{q.item.hotel.name}}</router-link>
                      </span>
                    </div>
                    <div>
                      <span
                        class="font-italic"
                        style="word-wrap: break-word;"
                      >"{{q.item.reply.content}}"</span>
                    </div>
                    <div class="pl-3">
                      <span class="caption grey--text">-&nbsp;12/07/2019</span>
                    </div>
                  </div>
                  <div class="ma-2" v-else>
                    <div>
                      <span class="font-weight-black" style="word-wrap: break-word;">
                        <router-link
                          :to="{name:'hotel', params:{id:q.item.hotel.id}}"
                          target="_blank"
                        >{{q.item.hotel.name}}</router-link>
                      </span>
                    </div>
                    <div>
                      <span class="font-italic" style="word-wrap: break-word;">No answer yet...</span>
                    </div>
                  </div>
                </td>
              </template>
            </v-data-table>
          </v-card>
        </v-card-text>
      </v-card>
    </v-dialog>
    <v-dialog v-model="bookingList.detail.dialog" width="750px">
      <v-card flat tile light>
        <v-layout class="pa-5 ma-0" row wrap>
          <v-flex md12>
            <div>
              <span
                class="font-weight-black title text-uppercase"
              >booking code:&nbsp;{{bookingList.detail.booking.id}}</span>
            </div>
            <v-divider></v-divider>
            <div>
              <span class="font-weight-black title">Your Information</span>
            </div>
            <v-layout row wrap class="pa-0 pl-3 ma-0 booking-content-info-item">
              <v-flex md3>
                <v-img :aspect-ratio="1" src="/blog/img/slider/default.png"></v-img>
              </v-flex>
              <v-flex md9>
                <v-layout row wrap class="pa-0 pl-4 ma-0">
                  <v-flex md12>
                    <h2>{{bookingList.detail.booking.hotel_name}}</h2>
                  </v-flex>
                  <v-flex md12>
                    <v-divider class="pa-0 ma-0"></v-divider>
                  </v-flex>
                  <v-flex md12>
                    <v-layout row wrap class="pa-0 ma-0">
                      <v-flex md6 class="pa-2">
                        <div>
                          <div>
                            <span class="font-weight-bold">Check-In:</span>
                          </div>
                          <div>
                            <span>{{formatDate(bookingList.detail.booking.check_in)}}</span>
                          </div>
                        </div>
                      </v-flex>
                      <v-flex md6 class="pa-2">
                        <div>
                          <div>
                            <span class="font-weight-bold">Check-Out:</span>
                          </div>
                          <div>
                            <span>{{formatDate(bookingList.detail.booking.check_out)}}</span>
                          </div>
                        </div>
                      </v-flex>
                      <v-flex md12 class="pl-2">
                        <span class="font-weight-bold">Guess Information</span>
                      </v-flex>
                      <v-flex md12 class="pl-2">
                        <v-layout row wrap class="pa-0 ma-0">
                          <v-flex md3>Name</v-flex>
                          <v-flex md9>{{bookingList.detail.booking.contact_name}}</v-flex>
                          <v-flex md3>Email</v-flex>
                          <v-flex md9>{{bookingList.detail.booking.contact_email}}</v-flex>
                          <v-flex md3>Mobile-number</v-flex>
                          <v-flex md9>{{bookingList.detail.booking.contact_phone}}</v-flex>
                          <v-flex md3>Address</v-flex>
                          <v-flex md9>{{bookingList.detail.booking.contact_address}}</v-flex>
                        </v-layout>
                      </v-flex>
                      <v-spacer></v-spacer>
                    </v-layout>
                  </v-flex>
                  <v-flex md12>
                    <v-divider></v-divider>
                  </v-flex>
                  <v-flex md12>
                    <span class="font-weight-bold">Room Details:</span>
                  </v-flex>
                  <v-flex md12>
                    <v-layout row wrap class="pa-0 ma-0">
                      <v-flex md3>Room Type:</v-flex>
                      <v-flex
                        md9
                      >{{bookingList.detail.booking.room.room_mode.name}}&nbsp;{{bookingList.detail.booking.room.room_type.name}}</v-flex>
                      <v-flex md3>No. Of Rooms:</v-flex>
                      <v-flex md9>{{bookingList.detail.booking.room_amount}}</v-flex>
                      <v-flex md3>Special Request:</v-flex>
                      <v-flex md9>{{bookingList.detail.booking.special_request}}</v-flex>
                    </v-layout>
                  </v-flex>
                </v-layout>
              </v-flex>
            </v-layout>
            <div>
              <v-divider dark></v-divider>
              <span class="font-weight-black title">Status</span>
            </div>
            <v-layout row wrap class="pa-0 pl-3 ma-0 booking-content-info-item">
              <div>
                <div>
                  <span
                    class="font-weight-black red--text font-italic"
                  >{{bookingList.detail.booking.status.name}}</span>
                </div>
                <div>
                  <v-btn
                    :disabled="!bookingList.detail.booking.cancel_status"
                    @click="bookingAction(bookingList.detail.booking,0)"
                    small
                    depressed
                    color="orange"
                  >cancel</v-btn>
                </div>
              </div>
            </v-layout>
            <div>
              <v-divider dark></v-divider>
              <span class="font-weight-black title">Cancellation Policy</span>
            </div>
            <v-layout row wrap class="pa-0 pl-3 ma-0 booking-content-info-item">
              <span>Id soluta temporibus sint molestias sapiente dolore beatae ratione velit blanditiis maxime sunt.</span>
            </v-layout>
            <div>
              <v-divider dark></v-divider>
              <span class="font-weight-black title">Price Details</span>
            </div>
            <v-layout row wrap class="pa-0 pl-3 ma-0 booking-content-info-item">
              <v-flex md12>
                <v-divider></v-divider>
              </v-flex>
              <v-flex md8>
                <span>{{bookingList.detail.booking.room.room_type.name}}&nbsp;{{bookingList.detail.booking.room.room_mode.name}}</span>
              </v-flex>
              <v-flex
                md4
              >{{bookingList.detail.booking.room.price.toLocaleString('en-US', {style: 'currency',currency: 'USD',})}}</v-flex>
              <v-flex md8>
                <span>Amount</span>
              </v-flex>
              <v-flex md4>{{bookingList.detail.booking.room_amount}}</v-flex>
              <v-flex md12>
                <v-divider></v-divider>
              </v-flex>
              <v-flex md8>
                <span>Total price</span>
              </v-flex>
              <v-flex
                md4
              >{{(bookingList.detail.booking.room_amount*bookingList.detail.booking.room_price).toLocaleString('en-US', {style: 'currency',currency: 'USD',})}}</v-flex>
            </v-layout>
          </v-flex>
        </v-layout>
      </v-card>
    </v-dialog>
    <v-dialog persistent v-model="confirm.dialog" max-width="290">
      <v-card>
        <v-card-title class="headline">{{confirm.title}}</v-card-title>

        <v-card-text>{{confirm.content}}</v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn color="green darken-1" flat="flat" @click="confirm.dialog = false">Cancel</v-btn>

          <v-btn color="green darken-1" flat="flat" @click="bookingAction(confirm.booking,0)">Sure</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog scrollable v-model="reviewForm.dialog" width="500px" persistent>
      <v-card flat tile light height="470px">
        <v-card-actions>
          <span class="ml-5 font-weight-bold title">Review form</span>
          <v-spacer></v-spacer>
          <div class="mr-3">
            <v-btn color="teal" depressed class="white--text" @click="sendReview">send</v-btn>
            <v-btn
              color="red"
              depressed
              class="white--text"
              @click="reviewForm.dialog = false"
            >close</v-btn>
          </div>
        </v-card-actions>
        <v-divider class="pa-0 ma-0"></v-divider>
        <v-card-title class="pa-0 ma-0">
          <v-card flat width="100%" style="overflow:auto;" height="380px" class="pa-0 ma-0">
            <v-card-title>
              <v-form ref="form" data-vv-scope="formReview">
                <v-layout row wrap class="pa-0 ma-0">
                  <v-flex md12>
                    <v-layout row wrap class="pa-0 ma-0" align-center>
                      <v-flex md8>
                        <v-rating
                          length ="10"
                          v-model="reviewForm.star"
                          class="pa-0 ma-0"
                          color="#B53471"
                          background-color="#636e72"
                          empty-icon="$vuetify.icons.ratingFull"
                          half-incrementss
                          small
                        ></v-rating>
                      </v-flex>
                      <v-flex md2>({{reviewForm.star}}/10)</v-flex>
                      <v-flex md6>
                        <v-checkbox
                          v-model="reviewForm.can_comment"
                          label="Public for comment"
                          color="#B53471"
                        ></v-checkbox>
                      </v-flex>
                      <v-flex md6>
                        <v-checkbox
                          v-model="reviewForm.notification"
                          label="Get comment' notifications"
                          color="#B53471"
                        ></v-checkbox>
                      </v-flex>
                    </v-layout>
                  </v-flex>
                  <v-flex md12>
                    <v-text-field
                      :error-messages="errors.collect('formReview.title')"
                      data-vv-name="title"
                      v-validate="'required'"
                      v-model="reviewForm.title"
                      color="#B53471"
                      type="text"
                      outline
                      clearable
                      clear-icon="cancel"
                      label="Title"
                    ></v-text-field>
                  </v-flex>
                  <v-flex md12>
                    <v-textarea
                      :error-messages="errors.collect('formReview.content')"
                      data-vv-name="content"
                      v-validate="'required'"
                      v-model="reviewForm.content"
                      color="#B53471"
                      outline
                      clearable
                      clear-icon="cancel"
                      auto-grow
                      rows="4"
                      label="Content"
                    ></v-textarea>
                  </v-flex>
                </v-layout>
              </v-form>
            </v-card-title>
          </v-card>
        </v-card-title>
      </v-card>
    </v-dialog>
  </v-layout>
</template>

<script>
export default {
  $_veeValidate: {
    validator: "new"
  },
  props: {},
  data() {
    return {
      tblHeaders: {
        booking: [
          {
            text: "ID",
            value: 0,
            align: "center",
            class: "red--text",
            sortable: false
          },
          {
            text: "Total",
            value: 0,
            align: "center",
            class: "red--text border-left",
            sortable: false
          },
          {
            text: "Status",
            value: "",
            align: "center",
            class: "red--text border-left",
            sortable: false
          },
          {
            text: "Action",
            value: 0,
            align: "center",
            class: "red--text border-left",
            sortable: false
          }
        ],
        question: [
          {
            text: "Question",
            value: 0,
            align: "center",
            class: "red--text",
            sortable: false
          }
        ]
      },
      confirm: {
        dialog: false,
        booking: {},
        title: "Are you sure?",
        content:
          "By clicking this button, you acknowledge that you have read and agree to Hotel's Terms & Conditions and Privacy Policy."
      },
      bookingList: {
        dialog: false,
        detail: {
          dialog: false,
          booking: {
            cancel_status: [],
            status: {},
            payment_method: {},
            room: {
              price: 0,
              room_mode: {},
              room_type: {},
              hotel: {}
            }
          }
        }
      },
      questionList: {
        dialog: false
      },
      bookingList: {
        dialog: false,
        detail: {
          dialog: false,
          booking: {
            cancel_status: [],
            status: {},
            payment_method: {},
            room: {
              price: 0,
              room_mode: {},
              room_type: {},
              hotel: {}
            }
          }
        }
      },
      followDialog: false,
      value: false,
      value1: false,
      user: {
        customer: {},
        avatar: {},
        booking: [],
        customerFollowings: [],
        hotelFollowings: [],
        followers: [],
        question: [],
        review: []
      },
      form: {
        email: "",
        pass: "",
        newPass: "",
        rePass: "",
        name: "",
        phone: "",
        address: ""
      },
      dictionary: {
        attributes: {
          email: "Email Address"
        },
        custom: {
          email: {
            required: () => "Email can not be empty"
          },
          password: {
            required: () => "Password can not be empty",
            min: "Password can not be under 4 characters"
          },
          password_confirmation: {
            required: () => "Can not be empty",
            confirmed: "Not match"
          },
          title: {
            required: () => "Title can not be empty"
          },
          content: {
            required: () => "Content can not be empty"
          }
        }
      },
      reviewForm: {
        dialog: false,
        title: "",
        content: "",
        star: 0,
        hotel_id: 0,
        can_comment: true,
        notification: true
      },
      comment: true,
      like: false,
      model: false,
      expand: [true, true],
      color: {
        header: "#2c3e50",
        badge: "#1cc3b2",
        heart: "#ff6348",
        fullHeart: "#f8a5c2",
        comment: "#1cc3b2",
        fullComment: "#f5f6fa",
        check: "#fa8231"
      },
      dialog: false,
      formDialog: false,
      passDialog: {
        check: false,
        main: false
      }
    };
  },
  mounted() {
    this.$validator.localize("en", this.dictionary);
  },
  created() {
    this.getInfo();
  },
  watch: {},
  methods: {
    bookingAction: function(booking, cmd) {
      console.log(booking);
      if (cmd == 1) {
        this.bookingList.detail.booking = booking;
        this.bookingList.detail.dialog = true;
      } else {
        if (this.confirm.dialog === true) this.confirm.dialog = false;
        axios({
          method: "put",
          url: "http://localhost:8000/api/booking/" + booking.id,
          params: {
            action: "cancel"
          },
          headers: {
            Authorization: "Bearer " + localStorage.getItem("login_token")
          }
        })
          .then(res => {
            console.log(res.data.status);
            if (res.data.status) {
              this.$emit("loadSnackbar", "Updated Successfully!!");
              this.getInfo();
            } else {
              this.$emit("loadSnackbar", "Updated Fail!!");
            }
          })
          .catch(error => {
            console.log(error.response);
            if (error.response.status == 401) {
              localStorage.removeItem("login_token");
              this.$emit("loadLogin");
            }
          });
      }
    },
    openBookingListDialog: function() {
      this.getInfo();
      if (localStorage.getItem("login_token") != null) {
        this.bookingList.dialog = true;
      }
    },
    openQuestionListDialog: function() {
      this.getInfo();
      if (localStorage.getItem("login_token") != null) {
        this.questionList.dialog = true;
      }
    },
    confirmAction: function(booking) {
      this.confirm.dialog = true;
      this.confirm.booking = booking;
      this.confirm.title = "Are you sure?";
      if (booking.status.id == 4)
        this.confirm.content =
          "By clicking this button, you acknowledge that you have read the Refund Policy of this Hotel.";
    },
    openFormUserInfo: function() {
      this.formDialog = true;
      this.form.username = this.user.username;
      this.form.name = this.user.name;
      this.form.email = this.user.email;
      this.form.address = this.user.customer.address;
      this.form.phone = this.user.phone_number;
    },
    sendComment: function(){
      alert('comment');
    },
    clear: function() {
      this.$refs.form.reset();
      this.$validator.reset();
    },
    submit: function() {
      this.$validator.validateAll("form1").then(valid => {
        if (valid) {
          axios({
            method: "put",
            url: "http://localhost:8000/api/user/" + this.user.id,
            params: {
              id: this.user.id,
              phone_number: this.form.phone,
              address: this.form.address,
              name: this.form.name
            }
          }).then(res => {
            console.log(res.data.status);
            if (res.data.status == true) {
              this.getInfo();
              this.$emit("loadLogin");
              this.$emit("loadSnackbar", "Updated!");
              this.formDialog = false;
              return;
            } else {
              this.$emit("loadSnackbar", "Something wrong!");
              this.$validator.reset();
            }
          });
        }
      });
    },
    getInfo: function() {
      if (localStorage.getItem("login_token") != null) {
        axios({
          method: "get",
          url: "http://localhost:8000/api/getUser",
          headers: {
            Authorization: "Bearer " + localStorage.getItem("login_token")
          }
        })
          .then(res => {
            this.user = res.data.user;
            console.log(this.user);
          })
          .catch(error => {
            console.log(error.response);
            if (error.response.status == 401) {
              localStorage.removeItem("login_token");
              this.$router.push({ name: "login" });
            }
          });
      } else {
        this.$router.push({ name: "login" });
      }
    },
    openReviewForm: function(booking) {
      if (localStorage.getItem("login_token") != null) {
        this.reviewForm.title = "";
        this.reviewForm.content = "";
        this.reviewForm.star = 0;
        this.reviewForm.booking = booking;
        this.reviewForm.can_comment = true;
        this.reviewForm.notification = true;
        this.reviewForm.dialog = true;
        this.$validator.reset();
      } else this.$router.push({ name: "login" });
    },
    sendReview: function() {
      this.$validator.validateAll("formReview").then(valid => {
        if (valid) {
          axios({
            method: "get",
            url: "http://localhost:8000/api/review/create",
            params: {
              title: this.reviewForm.title,
              content: this.reviewForm.content,
              star: this.reviewForm.star,
              hotel_id: this.reviewForm.booking.room.hotel.id,
              booking_id: this.reviewForm.booking.id,
              can_comment: this.reviewForm.can_comment,
              notification: this.reviewForm.notification
            },
            headers: {
              Authorization: "Bearer " + localStorage.getItem("login_token")
            }
          })
            .then(res => {
              if (res.data.status == true) {
                this.getInfo();
                this.$emit("loadLogin");
                this.reviewForm.dialog = false;
                this.$validator.reset();
              } else {
                this.$emit("loadSnackbar", "Something wrong!");
              }
            })
            .catch(error => {
              console.log(error.response);
              if (error.response.status == 401) {
                localStorage.removeItem("login_token");
                this.$router.push({ name: "login" });
              }
            });
        }
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
    },
    checkPass: function() {
      axios({
        method: "get",
        url: "http://localhost:8000/api/check-password",
        params: {
          id: this.user.id,
          password: this.form.pass
        }
      }).then(res => {
        console.log(res.data.mess);
        if (res.data.mess) {
          this.passDialog.check = false;
          this.passDialog.main = true;
          this.value = false;
          this.form.newPass = this.form.rePass = "";
          this.$validator.reset();
          return;
        }
        this.$emit("loadSnackbar", "Wrong password!");
        return;
      });
    },
    submitPass: function() {
      this.$validator.validateAll("form2").then(valid => {
        if (valid) {
          axios({
            method: "get",
            url: "http://localhost:8000/api/update-password",
            params: {
              id: this.user.id,
              password: this.form.pass,
              newPassword: this.form.newPass
            }
          }).then(res => {
            console.log(res.data.status);
            if (res.data.status == false) {
              this.$emit("loadSnackbar", "Something wrong!");
              this.form.pass = this.form.rePass = "";
              return;
            }
            this.getInfo();
            this.$emit("loadLogin");
            this.$emit("loadSnackbar", "Updated new password!");
            this.passDialog.main = false;
            return;
          });
        }
      });
    },
    hello2: function() {
      this.hello = "new 2";
      this.$emit("helloEdited", this.hello);
      alert(this.hello);
    },
    formatDate: function(date) {
      if (!date) return null;
      const [year, month, day] = date.split("-");
      return `${day}/${month}/${year}`;
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

.pointer {
  cursor: pointer;
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

