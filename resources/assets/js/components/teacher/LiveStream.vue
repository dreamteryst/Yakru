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
            <!-- <div
              id="videos-container"
              class="embed-responsive embed-responsive-16by9"
              ref="videos-container"
            ></div>-->
            <div id="videos-container" ref="videos-container"></div>
          </div>
          <div class="col-md-4">
            <div class="m-b-10" v-if="!isLive">
              <button
                type="button"
                class="btn btn-primary btn-block"
                ref="start-screen"
                @click="openRoom"
              >
                <span class="f-s-20">เริ่มการสอน</span>
              </button>
            </div>
            <div class="m-b-10" v-if="isLive">
              <button
                type="button"
                class="btn btn-danger btn-block"
                ref="stop-screen"
                @click="stop"
              >
                <span class="f-s-20">หยุดการสอน</span>
              </button>
            </div>
            <div class="m-b-10" v-if="!isLive">
              <button
                type="button"
                class="btn btn-warning btn-block"
                ref="stop-student-screen"
                @click="stopStudent"
              >
                <span class="f-s-20">หยุดการแชร์หน้าจอผู้เรียน</span>
              </button>
            </div>
            <div class="m-b-20" v-if="user.type == 'teacher' || user.type == 'admin'">
              <button
                type="button"
                class="btn btn-success btn-block"
                ref="share-screen"
                @click="screenShare"
              >
                <span class="f-s-20">แชร์หน้าจอ</span>
              </button>
            </div>
            <Chat
              :courseId="$route.params.id"
              :user="profile"
              :roomId="roomId"
              :course="course"
              :socket="socket"
            />
          </div>
        </div>
        <b-row>
          <b-col>
            <h4 class="m-t-15">{{ course.course_name }} (Live)</h4>
          </b-col>
        </b-row>
        <Exam :socket="socket" :roomId="roomId" :courseId="this.$route.params.id"/>
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
              <span class="clickable item-image" @click="request(user.id)">
                <img src="/assets_admin/img/user/personal.png" alt>
              </span>
              <div class="item-info">
                <h4 class="item-title">
                  <span
                    class="clickable f-s-20"
                    @click="request(user.id)"
                  >{{ user.firstname }} {{ user.lastname }}</span>
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
import Exam from "./Exam";

export default {
    components: { Exam },
    data: () => ({
        course: "",
        likes: "",
        connection: "",
        roomId: "",
        oldRoomId: "",
        socket: "",
        profile: {},
        isLive: false
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
    },
    beforeDestroy() {
        console.log("des");
        this.socket.emit("stop stream", this.roomId);
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

            this.connection.session = {
                audio: true,
                video: true,
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
            };
            this.connection.onstreamended = function(event) {
                var mediaElement = document.getElementById(event.streamid);
                if (mediaElement) {
                    mediaElement.parentNode.removeChild(mediaElement);
                }
            };
        },
        listening(roomId) {
            const self = this;
            this.socket.emit("initialize", this.roomId);

            this.socket.on(roomId + "/user response", data => {
                console.log(data);
                if (data.accept) {
                    this.stop();
                    this.roomId = data.roomId;
                    this.join();
                }
            });
        },
        openRoom() {
            this.socket.emit("start stream");
            this.connection.open(this.roomId);
            this.isLive = true;
            axios.get("/api/course/notify/" + this.$route.params.id);
        },
        join() {
            const self = this;
            this.connection.checkPresence(this.roomId, function(isRoomExists) {
                if (isRoomExists) {
                    self.connection.join(self.roomId);
                }
            });
        },
        screenShare() {
            this.connection.addStream({
                screen: true,
                oneway: true
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

            this.isLive = false;
        },
        stopStudent() {
            this.socket.emit(
                this.course.secret + "/stop student screen",
                this.roomId
            );
            this.stop();
            this.roomId = this.course.secret;
            this.openRoom();
        },
        request(userId) {
            swal({
                title: "ส่งคำขอถึงผู้เรียน",
                text: "คุณต้องการแชร์หน้าจอของผู้เรียนใช่หรือไม่?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "OK",
                reverseButtons: true
            }).then(result => {
                if (result.value) {
                    this.socket.emit(
                        this.roomId + "/request share screen",
                        userId
                    );
                }
            });
        }
    }
};
</script>

<style>
</style>
