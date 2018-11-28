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
            <a href="#">{{ course.category.category_name }}</a>
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
            <div class="m-b-10" v-if="user.type == 'teacher' || user.type == 'admin'">
              <button
                type="button"
                class="btn btn-primary btn-block"
                ref="share-screen"
                @click="openRoom"
              >
                <span class="f-s-20">เริ่มการสอน</span>
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
            <div class="chatbox">
              <div class="message">
                <span class="user-name-teacher">DreaMTeryST :&nbsp;</span>
                <span class="text">สวัสดีครับ</span>
                <span class="time">1:40</span>
              </div>
              <div class="message">
                <span class="user-name-teacher">DreaMTeryST :&nbsp;</span>
                <span class="text">ท่านผู้ชม</span>
                <span class="time">1:41</span>
              </div>
              <div class="message">
                <span class="user-name">Moojy :&nbsp;</span>
                <span class="text">สงสัยค่ะ</span>
                <span class="time">2:30</span>
              </div>
              <div class="input">
                <input type="text" class="form-control" placeholder="พิมพ์ข้อความที่นี่">
              </div>
            </div>
          </div>
        </div>
        <h4 class="m-t-15">{{ course.course_name }} (Live)</h4>
        <div class="row row-space-10">
          <!-- BEGIN col-2 -->
          <div class="col-md-2 col-sm-4" style="margin-bottom: 8px;" v-for="(user, i) in course.users" :key="i">
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
                <img :src="like.course_picture" alt>
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

export default {
    data: () => ({
        course: "",
        likes: "",
        connection: "",
        roomId: ""
    }),
    computed: {
        ...mapState(["user"])
    },
    mounted() {
        const self = this;
        axios
            .get(`/api/course/user/${this.$route.params.id}`)
            .then(({ data }) => {
                this.course = data;
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
        this.connection = new RTCMultiConnection();
        this.roomId = this.connection.token();
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
        this.connection.socketURL = "http://localhost:9001/";

        this.connection.socketMessageEvent = "audio-video-screen-demo";

        this.connection.session = {
            audio: true,
            video: true
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
    methods: {
        openRoom() {
            this.connection.open(this.roomId, function() {
                console.log("fn");
                //showRoomURL(connection.sessionid);
            });
        },
        screenShare() {
            this.connection.addStream({
                screen: true,
                oneway: true
            });
        }
    }
};
</script>

<style>
</style>
