<template>
  <section>
    <!-- BEGIN #product -->
    <div id="product" class="section-container p-t-20">
      <!-- BEGIN container -->
      <div class="container">
        <!-- BEGIN product -->
        <div class="product">
          <!-- BEGIN product-detail -->
          <div class="product-detail">
            <!-- BEGIN product-image -->
            <div class="product-image">
              <h1 class="product-title">{{ course.course_name }}</h1>
              <br>
              <div v-if="lecture">
                <video id="player" playsinline controls v-if="lecture.mime_type !== 'youtube'">
                  <source :src="`/photo/${lecture.video_name}`" :type="lecture.mime_type">
                </video>
                <div class="plyr__video-embed" id="player" v-else>
                  <iframe
                    :src="`https://www.youtube.com/embed/${youtube_parser(lecture.video_name)}?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1`"
                    allowfullscreen
                    allowtransparency
                    allow="autoplay"
                  ></iframe>
                </div>
              </div>
              <div class="plyr__video-embed" id="player" v-else>
                <iframe
                  :src="`https://www.youtube.com/embed/${youtube_parser(course.course_video)}?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1`"
                  allowfullscreen
                  allowtransparency
                  allow="autoplay"
                ></iframe>
              </div>
            </div>
            <!-- END product-image -->
          </div>
          <!-- END product-detail -->
          <!-- BEGIN product-tab -->
          <div class="product-tab">
            <!-- BEGIN #product-tab -->
            <ul id="example" class="nav nav-tabs">
              <li class="active">
                <a href="#example" data-toggle="tab">Example</a>
              </li>
            </ul>
            <div id="product-tab-content" class="tab-content">
              <div class="tab-pane fade active in" id="example">
                <button
                  class="btn btn-primary"
                  @click="openExamp"
                  :disabled="checkIsDone('pretest')"
                >แบบทดสอบก่อนเรียน</button>
                <button
                  class="btn btn-success"
                  :disabled="checkIsDone('posttest') || !checkIsDone('posttest')"
                >แบบทดสอบหลังเรียน</button>
              </div>
            </div>
            <!-- BEGIN #product-tab -->
            <ul id="product-tab" class="nav nav-tabs">
              <li class="active">
                <a href="#curriculum" data-toggle="tab">Curriculum For This Course</a>
              </li>
            </ul>
            <!-- END #product-tab -->
            <!-- BEGIN #product-tab-content -->
            <div id="product-tab-content" class="tab-content">
              <!-- BEGIN #curriculum -->
              <div
                class="tab-pane fade active in"
                id="curriculum"
                v-for="(unit, i) in course.units"
                :key="i"
              >
                <b-card no-body class="mb-1">
                  <b-card-header header-tag="header" class="p-1" role="tab">
                    <b-btn
                      block
                      href="#"
                      v-b-toggle="'accordion-' + i"
                      variant="info"
                      class="btn-left"
                    >
                      <i class="fa fa-plus"></i>
                      {{ unit.unit_name }}
                    </b-btn>
                  </b-card-header>
                  <b-collapse :id="'accordion-' + i" accordion="my-accordion" role="tabpanel">
                    <b-card-body>
                      <ul class="curriculum" v-for="(lecture, j) in unit.lectures" :key="j">
                        <li>
                          <a
                            href="/learning"
                            v-if="lecture.guest  || course.is_bought"
                            @click="play($event, lecture)"
                          >
                            <i class="fa fa-play-circle"></i>
                            {{ lecture.lecture_name }}
                          </a>
                          <span v-else>{{ lecture.lecture_name }}</span>
                        </li>
                      </ul>
                    </b-card-body>
                  </b-collapse>
                </b-card>
              </div>
              <!-- END #curriculum -->
            </div>
            <!-- END #product-tab-content -->
          </div>
          <!-- END product-tab -->
        </div>
        <!-- END product -->
      </div>
      <!-- END container -->
    </div>
    <!-- END #product -->
    <Example
      ref="modalPreTest"
      title="แบบทดสอบก่อนเรียน"
      v-if="course.example"
      :time_limit="course.example.find(item => item.example_type === 'pretest').time_limit"
      :questions="course.example.find(item => item.example_type === 'pretest').question"
      @submit="submitExam"
      @timeOver="submitExam"
    />
    <b-modal ref="modalPostTest" ok-title="บันทึก"></b-modal>
  </section>
</template>

<script>
import moment from "moment";
export default {
    data() {
        return {
            course: {
                name: ""
            },
            player: null,
            lecture: null,
            started_at: ""
        };
    },
    mounted() {
        axios
            .get(`/api/course/${this.$route.params.id}`)
            .then(({ data }) => {
                this.course = data;
            })
            .catch(error => {
                console.log(error);
                if (error.response) console.log(error.response);
            });
        $(function() {
            new Plyr("#player");
        });
    },
    methods: {
        play(event, lecture) {
            event.preventDefault();
            this.lecture = null;
            setTimeout(() => {
                this.lecture = lecture;
                new Plyr("#player");
            }, 500);
        },
        checkIsDone(type) {
            if (!this.course.example) {
                return true;
            }
            if (!this.course.example.find(item => item.example_type === type)) {
                return true;
            }
            return this.course.example.find(item => item.example_type === type).isDone;
        },
        openExamp() {
            this.alertConfirm(
                "ยืนยันการดำเนินการ",
                "คุณต้องการเริ่มทำข้อสอบใช่หรือไม่"
            ).then(result => {
                if (result.value) {
                    this.started_at = moment().format("YYYY-MM-DD");
                    this.$refs.modalPreTest.show();
                }
            });
        },
        submitExam($answers) {
            const payload = new FormData();
            payload.append("example_id", this.$route.params.id);
            payload.append("started_at", this.started_at);
            $answers.forEach((item, i) => {
                payload.append(`answers[${i}]`, item);
            });

            axios.post("/api/example/done", payload).then(({ data }) => {
                this.alertSuccess();
            });
        }
    }
};
</script>

<style>
</style>
