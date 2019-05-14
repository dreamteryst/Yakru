<template>
  <section>
    <!-- BEGIN #product -->
    <div id="product" class="section-container p-t-20">
      <!-- BEGIN container -->
      <div class="container">
        <!-- BEGIN breadcrumb -->
        <ul class="breadcrumb m-b-10 f-s-20">
          <li>
            <a href="#">Home</a>
          </li>
          <li>
            <a href="#" v-if="course.category">{{ course.category.category_name }}</a>
          </li>
          <li class="active">{{ course.course_name }}</li>
        </ul>
        <!-- END breadcrumb -->
        <div class="row">
          <div class="col-md-8">
            <div
              id="videos-container"
              class="embed-responsive embed-responsive-16by9"
              ref="videos-container"
            ></div>
          </div>
          <div class="col-md-4">
            <div class="m-b-10" v-if="!isLive">
              <button
                type="button"
                class="btn btn-primary btn-block"
                ref="share-screen"
                @click="join"
              >
                <span class="f-s-20">เริ่ม</span>
              </button>
            </div>
            <div class="m-b-10" v-if="isLive">
              <button
                type="button"
                class="btn btn-danger btn-block"
                ref="share-screen"
                @click="stop"
              >
                <span class="f-s-20">หยุดการแชร์</span>
              </button>
            </div>
            <div class="chatbox">
              <div class="message" v-for="(item, i) in chats" :key="i">
                <span
                  :class="[item.user_id === course.user_id ? 'user-name-teacher' : 'user-name' ]"
                >{{ item.name }} :&nbsp;</span>
                <span class="text">{{ item.message }}</span>
                <span class="time">{{ item.time }}</span>
              </div>
              <div class="input">
                <input
                  type="text"
                  class="form-control"
                  placeholder="พิมพ์ข้อความที่นี่"
                  @keyup="handleMessage"
                >
              </div>
            </div>
          </div>
        </div>
        <b-row>
          <b-col>
            <h4 class="m-t-15">{{ course.course_name }} (Live)</h4>
          </b-col>
        </b-row>
        <LiveExam :socket="socket" :roomId="roomId" :user="profile"/>
        <hr>
        <div class="row row-space-10">
          <!-- BEGIN col-2 -->
          <div
            class="col-md-2 col-sm-4"
            style="margin-bottom: 8px;"
            v-for="(user, i) in course.users"
            :key="i"
          >
            <!-- BEGIN item -->
            <div class="item item-thumbnail">
              <router-link to class="item-image">
                <img src="https://fakeimg.pl/240x135/" alt>
              </router-link>
              <div class="item-info">
                <h4 class="item-title">
                  <router-link to class="f-s-20">{{ user.firstname }} {{ user.lastname }}</router-link>
                </h4>
              </div>
            </div>
            <!-- END item -->
          </div>
          <!-- END col-2 -->
        </div>
        <!-- END similar-product -->
        <hr>
        <!-- BEGIN similar-product -->
        <h4 class="m-b-15 m-t-30">คอร์สที่คุณอาจจะชอบ</h4>
        <div class="row row-space-10">
          <!-- BEGIN col-2 -->
          <div class="col-md-2 col-sm-4" v-for="(like, i) in likes" :key="i">
            <!-- BEGIN item -->
            <div class="item item-thumbnail">
              <router-link :to="`/product-detail/${like.id}`" class="item-image">
                <img :src="renderPicture(like.course_picture)" alt>
                <div class="discount">{{ getPercent(like) }}% OFF</div>
              </router-link>
              <div class="item-info">
                <h4 class="item-title">
                  <router-link to="/product-detail">{{ like.course_name }}</router-link>
                </h4>
                <p class="item-desc">{{ like.course_description }}</p>
                <div
                  class="item-price"
                  v-if="like.final_price"
                >฿ {{ numberWithCommas(like.final_price) }}</div>
                <div
                  class="item-discount-price"
                  v-if="like.course_price"
                >฿ {{ numberWithCommas(like.course_price) }}</div>
              </div>
            </div>
            <!-- END item -->
          </div>
          <!-- END col-2 -->
        </div>
        <!-- END similar-product -->
      </div>
    </div>
  </section>
</template>

<script>
import { mapState } from "vuex";
import swal from "sweetalert2";

export default {
    data: () => ({
        course: "",
        likes: "",
        connection: "",
        roomId: "",
        oldRoomId: "",
        socket: "",
        profile: {},
        chats: [],
        isLive: false,
        isExam: false
    }),
    computed: {
        ...mapState(["user"])
    },
    watch: {
        user() {
            this.profile = this.user;
        }
    },
    mounted() {
        if (this.user) this.profile = this.user;
        const self = this;
        this.socket = io("https://yakru-chat.herokuapp.com/");
        // this.socket = io("http://localhost:3000");
        axios
            .get(`/api/course/user/${this.$route.params.id}`)
            .then(({ data }) => {
                this.course = data;
                this.initialize(data.secret);
                this.listening(data.secret);
            })
            .catch(error => {
                console.log(error);
                if (error.response) console.log(error.response);
            });
        axios
            .get(`/api/course/like/${this.$route.params.id}`)
            .then(({ data }) => {
                this.likes = data;
            })
            .catch(error => {
                console.log(error);
                if (error.response) console.log(error.response);
            });
        axios
            .get(`/api/chat/${this.$route.params.id}`)
            .then(({ data }) => {
                data.map(item => {
                    const temp = {
                        user_id: item.user.id,
                        name: `${item.user.firstname} ${item.user.lastname}`,
                        message: item.message,
                        time: item.time
                    };
                    this.chats.push(temp);
                });
                setTimeout(() => {
                    $(".chatbox").animate(
                        { scrollTop: $(".chatbox").prop("scrollHeight") },
                        1000
                    );
                }, 500);
            })
            .catch(error => {
                console.log(error);
                if (error.response) console.log(error.response);
            });
    },
    methods: {
        initialize(roomId) {
            const self = this;
            this.connection = new RTCMultiConnection();
            this.roomId = roomId;
            this.oldRoomId = roomId;
            this.connection.getScreenConstraints = function(callback) {
                getScreenConstraints(function(error, screen_constraints) {
                    if (!error) {
                        screen_constraints = self.connection.modifyScreenConstraints(
                            screen_constraints
                        );
                        callback(error, screen_constraints);
                        return;
                    }
                    throw error;
                });
            };
            this.connection.socketURL =
                "https://rtcmulticonnection.herokuapp.com:443/";

            this.connection.socketMessageEvent = "audio-video-screen-demo";

            // this.connection.session = {
            //     audio: true,
            //     video: true,
            //     oneway: true
            // };

            this.connection.session = {
                screen: true,
                oneway: true
            };

            this.connection.sdpConstraints.mandatory = {
                OfferToReceiveAudio: true,
                OfferToReceiveVideo: true
            };

            this.connection.videosContainer = document.getElementById(
                "videos-container"
            );
            this.connection.onstream = function(event) {
                console.log(event);
                if (document.getElementById(event.streamid)) {
                    var existing = document.getElementById(event.streamid);
                    existing.parentNode.removeChild(existing);
                }

                var width =
                    parseInt(self.connection.videosContainer.clientWidth) - 20;

                if (event.stream.isScreen === true) {
                    width = self.connection.videosContainer.clientWidth - 20;
                }

                var mediaElement = getMediaElement(event.mediaElement, {
                    title: event.userid,
                    buttons: ["full-screen"],
                    width: width,
                    showOnMouseEnter: false
                });

                self.connection.videosContainer.appendChild(mediaElement);

                setTimeout(function() {
                    mediaElement.media.play();
                }, 5000);

                mediaElement.id = event.streamid;
                if (self.isLive) {
                    self.socket.emit(self.oldRoomId + "/user response", {
                        accept: true,
                        roomId: self.profile.firstname + self.profile.lastname
                    });
                }
            };
            this.connection.onstreamended = function(event) {
                var mediaElement = document.getElementById(event.streamid);
                if (mediaElement) {
                    mediaElement.parentNode.removeChild(mediaElement);
                }
            };
        },
        join() {
            const self = this;
            this.connection.checkPresence(this.roomId, function(isRoomExists) {
                if (isRoomExists) {
                    self.connection.join(self.roomId);
                }
            });
        },
        listening(roomId) {
            const self = this;
            this.socket.emit("initialize", roomId);

            this.socket.on(roomId + "/stop student screen", studentRoomId => {
                this.stop();
                this.roomId = roomId;
                if (
                    studentRoomId ==
                    this.profile.firstname + this.profile.lastname
                ) {
                    this.isLive = false;
                }
                this.roomId = roomId;
                setTimeout(() => {
                    this.join();
                }, 1000);
            });

            this.socket.on(roomId + "/user response", data => {
                console.log(data);
                if (data.accept) {
                    this.stop();
                    this.roomId = data.roomId;
                    this.join();
                }
            });

            this.socket.on(roomId + "/chat message", msg => {
                this.chats.push(msg);
                if (msg.user_id == self.profile.id) {
                    const data = {
                        user_id: self.profile.id,
                        course_id: self.course.id,
                        message: msg.message,
                        time: msg.time
                    };
                    axios.post("/api/chat", data).catch(error => {
                        console.log(error);
                        if (error.response) {
                            console.log(error.response);
                            swal({
                                type: "error",
                                title: "Oops...",
                                text: error.response.data.message
                            });
                        }
                    });
                }
                $(".chatbox").animate({ scrollTop: $(".chatbox").prop('scrollHeight') }, 1000);
            });

            this.socket.on(roomId + "/request share screen", userId => {
                if (userId === this.profile.id) {
                    swal({
                        title: "ผู้สอนต้องการให้คุณแชร์หน้าจอ",
                        text: "คุณต้องการแชร์หน้าจอหรือไม่?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Accept",
                        reverseButtons: true
                    }).then(result => {
                        if (result.value) {
                            this.stop();
                            this.roomId =
                                this.profile.firstname + this.profile.lastname;
                            this.live(true);
                        } else {
                            this.socket.emit(roomId + "/user response", {
                                accept: false
                            });
                        }
                    });
                }
            });
        },
        stop() {
            const self = this;
            this.connection.getAllParticipants().forEach(function(pid) {
                self.connection.disconnectWith(pid);
            });

            // stop all local cameras
            this.connection.attachStreams.forEach(function(localStream) {
                localStream.stop();
            });

            this.socket.emit(this.roomId + "/stop sharing");

            this.isLive = false;
        },
        live(isLive) {
            this.isLive = isLive;
            this.connection.open(this.roomId);
        },
        handleMessage(event) {
            if (event.key === "Enter" && event.target.value !== "") {
                const payload = {
                    user_id: this.profile.id,
                    name: this.profile.firstname + " " + this.profile.lastname,
                    message: event.target.value
                };
                this.socket.emit(this.roomId + "/chat message", payload);
                event.target.value = "";
            }
        }
    }
};
</script>

<style>
</style>
