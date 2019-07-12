<template>
  <v-layout row wrap class="mx-3">
    <v-flex shrink md8>
      <v-img :aspect-ratio="16/4" src="/blog/img/slider/default.png" class="mr-2 radius mb-3">
        <v-layout row wrap fill-height class="lightbox white--text mt-5 mb-1 pl-5">
          <v-spacer></v-spacer>
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
          <v-flex md3>
            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-btn dark large icon v-on:click="dialog = true" v-on="on">
                  <v-icon medium color="blue darken-4">insert_photo</v-icon>
                </v-btn>
              </template>
              <span>Change pictures</span>
            </v-tooltip>
          </v-flex>
          <!-- <v-dialog
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
                      <img :src="value.customer.avatar.image_link" />
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
          <v-btn depressed color="grey lighten-2" v-on:click.stop="openFormUserInfo">
            <v-icon small>create</v-icon>&nbsp;update
          </v-btn>
          <v-btn
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
              <v-icon color="black">group</v-icon>&nbsp;following &amp; followers
            </div>
          </template>
          <v-btn depressed color="grey lighten-2" v-on:click="followDialog = true">
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
                        <img :src="item.avatar.image_link" :alt="item.follower.name">
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
                      <router-link :to="{name:'user',params:{id:item.follower.id}}"><span class="font-weight-bold">{{user.name}}</span></router-link>
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
                        <img :src="item.avatar.image_link" :alt="item.followed.name">
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
                      <v-divider class="pa-0 ma-0 mt-3" v-show="i<(user.customerFollowings.length-1)"></v-divider>
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
  $_veeValidate: {
    validator: "new"
  },
  props: {},
  data() {
    return {
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
        review: [],
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
          }
        }
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
    openFormUserInfo: function() {
      this.formDialog = true;
      this.form.username = this.user.username;
      this.form.name = this.user.name;
      this.form.email = this.user.email;
      this.form.address = this.user.customer.address;
      this.form.phone = this.user.phone_number;
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
            if(res.data.status == true){
              this.getInfo();
              this.$emit("loadLogin");
              this.$emit("loadSnackbar", "Updated!");
              this.formDialog = false;
              return;
            }else{
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

