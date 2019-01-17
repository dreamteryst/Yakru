<template>
  <section>
    <!-- BEGIN #my-account -->
    <div
      id="about-us-cover"
      class="section-container"
    >
      <!-- BEGIN container -->
      <div class="container">
        <!-- BEGIN account-container -->
        <div class="account-container">
          <!-- BEGIN account-sidebar -->
          <div class="account-sidebar">
            <div class="account-sidebar-cover">
              <img
                src="/assets/img/cover/cover-14.jpg"
                alt
              >
            </div>
            <div class="account-sidebar-content">
              <h4>บัญชีของคุณ</h4>
              <p>คุณสามารถแก้ไขข้อมูลส่วนตัว และเปลี่ยนรหัสผ่านได้ที่นี้</p>
              <p>คอร์สของคุณทั้งหมด สามารถเข้าถึงได้อย่างง่ายดาย</p>
            </div>
          </div>
          <!-- END account-sidebar -->
          <!-- BEGIN account-body -->
          <div class="account-body">
            <!-- BEGIN row -->
            <div class="row">
              <!-- BEGIN col-6 -->
              <div class="col-md-6">
                <h4>
                  <i class="fas fa-graduation-cap"></i> ประวัติการเรียน
                </h4>
                <ul class="nav nav-list">
                  <li
                    v-for="(course, i) in courses"
                    :key="i"
                  >
                    <router-link
                      :to="`/learning/${course.course.id}`"
                      v-if="course.course && course.course.type === 'video'"
                    >{{ course.course.course_name }}</router-link>
                    <router-link
                      :to="`/live-stream/${course.course.id}`"
                      v-else-if="course.course"
                    >{{ course.course.course_name }}</router-link>
                  </li>
                </ul>
                <h4>
                  <i class="fa fa-universal-access fa-fw text-muted"></i> ตั้งค่าบัญชี
                </h4>
                <ul class="nav nav-list">
                  <li>
                    <a href="#">เปลี่ยนรหัสผ่าน</a>
                  </li>
                  <li>
                    <a href="#">แก้ไขข้อมูลส่วนตัว</a>
                  </li>
                  <li>
                    <a
                      href="/logout"
                      class="text-danger"
                    >
                      <i class="fas fa-lock"></i> ออกจากระบบ
                    </a>
                  </li>
                </ul>
              </div>
              <!-- END col-6 -->
              <!-- BEGIN col-6 -->
              <div class="col-md-6">
                <h4 v-if="user.type != 'student'">
                  <i class="fa fa-gitlab fa-fw text-muted"></i> คอร์สของฉัน
                </h4>
                <ul
                  class="nav nav-list"
                  v-if="user.type != 'student'"
                >
                  <li
                    v-for="(course, i) in myCourses"
                    :key="i"
                  >
                    <router-link
                      :to="`/learning/${course.id}`"
                      v-if="course.type === 'video'"
                    >{{ course.course_name }}</router-link>
                    <router-link
                      :to="`/teacher/live-stream/${course.id}`"
                      v-else
                    >{{ course.course_name }}</router-link>
                  </li>
                </ul>
                <h4>
                  <i class="fa fa-cc-visa fa-fw text-muted"></i> การเติมเงิน
                </h4>
                <ul class="nav nav-list">
                  <li>
                    <a
                      href="javascript:;"
                      @click="openVisa"
                    >ชำระด้วย บัตรเครดิต</a>
                  </li>
                  <li>
                    <a
                      href="javascript:;"
                      @click="openBank"
                    >ชำระด้วย โอนเงินผ่านธนาคาร</a>
                  </li>
                  <li>
                    <a href="javascript:;"
                    @click="openPaypal"
                    >ชำระด้วย Paypal</a>
                  </li>
                </ul>
              </div>
              <!-- END col-6 -->
            </div>
            <!-- END row -->
          </div>
          <!-- END account-body -->
        </div>
        <!-- END account-container -->
        <!-- BEGIN similar-product -->
        <h4 class="m-b-15 m-t-30">คอร์สใหม่ล่าสุด</h4>
        <div class="row row-space-10">
          <!-- BEGIN col-2 -->
          <div
            class="col-md-2 col-sm-4"
            v-for="(like, i) in likes"
            :key="i"
          >
            <!-- BEGIN item -->
            <div class="item item-thumbnail">
              <router-link
                :to="`/product-detail/${like.id}`"
                class="item-image"
              >
                <img
                  :src="like.course_picture"
                  alt
                >
                <div class="discount">{{ getPercent(like) }}% OFF</div>
              </router-link>
              <div class="item-info">
                <h4 class="item-title">
                  <router-link to="/product-detail">{{ like.course_name }}</router-link>
                </h4>
                <p class="item-desc">{{ like.course_description }}</p>
                <div
                  class="item-price"
                  v-if="like.course_discounted"
                >฿ {{ numberWithCommas(like.course_discounted) }}</div>
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
      <!-- END container -->
    </div>
    <!-- END #about-us-cover -->
    <b-modal
      ref="modalVisa"
      title="ชำระด้วย บัตรเครดิต"
      hide-footer
      no-fade
    >
      <Visa />
    </b-modal>
    <b-modal
      ref="modalPaypal"
      title="ชำระด้วย Paypal"
      hide-footer
      no-fade
    >
      <b-form
        action="/paypal"
        method="post"
      >
      <input type="hidden" name="_token" id="csrf-token" v-model="token" />
        <b-form-group
          label="จำนวนเงิน"
          label-for="amount"
        >
          <b-form-input
            id="amount"
            name="amount"
            type="number"
            step="0.1"
            min="100"
            v-model="amount"
            placeholder="ระบุจำนวนเงิน"
          />
        </b-form-group>
        <div class="form-group text-right">
          <button
            type="submit"
            class="btn btn-primary"
          >ยืนยัน</button>
        </div>
      </b-form>
    </b-modal>
    <b-modal
      ref="modalBank"
      title="ชำระด้วย โอนผ่านธนาคาร"
      hide-footer
      no-fade
    >
      <Bank />
    </b-modal>
  </section>
</template>

<script>
import { mapState } from "vuex";
import Visa from "./Visa";
import Bank from "./Transfer";
export default {
    components: { Visa, Bank },
    data() {
        return {
            likes: "",
            courses: "",
            myCourses: "",
            amount: 0,
            token: document.head.querySelector('meta[name="csrf-token"]').getAttribute("content")
        };
    },
    computed: {
        ...mapState(["user"])
    },
    mounted() {
        axios
            .get("/api/course/new")
            .then(({ data }) => {
                this.likes = data;
            })
            .catch(error => {
                console.log(error);
                if (error.response) console.log(error.response);
            });
        axios
            .get("/api/course/me")
            .then(({ data }) => {
                this.courses = data;
            })
            .catch(error => {
                console.log(error);
                if (error.response) console.log(error.response);
            });
        axios
            .get("/api/course/teacherCourse")
            .then(({ data }) => {
                this.myCourses = data;
            })
            .catch(error => {
                console.log(error);
                if (error.response) console.log(error.response);
            });
    },
    methods: {
        openVisa() {
            this.$refs.modalVisa.show();
        },
        openBank() {
            this.$refs.modalBank.show();
        },
        openPaypal() {
            this.$refs.modalPaypal.show();
        }
    }
};
</script>

<style>
</style>
