<template>
  <section>
    <!-- BEGIN #my-account -->
    <div id="about-us-cover" class="section-container">
      <!-- BEGIN container -->
      <div class="container">
        <!-- BEGIN account-container -->
        <div class="account-container">
          <!-- BEGIN account-sidebar -->
          <div class="account-sidebar">
            <div class="account-sidebar-cover">
              <img src="/assets/img/cover/cover-14.jpg" alt>
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
                <ul class="nav nav-list" v-if="user.type == 'student'">
                  <li>
                    <router-link to="/learning">React Native สำหรับมือใหม่!!</router-link>
                  </li>
                  <li>
                    <router-link to="/live-stream">Core Angular: การใช้งาน Angular 4</router-link>
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
                    <a href="/logout" class="text-danger">
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
                <ul class="nav nav-list" v-if="user.type != 'student'">
                  <li>
                    <router-link to="/learning">React Native สำหรับมือใหม่!!</router-link>
                  </li>
                  <li>
                    <router-link to="/teacher/live-stream">Core Angular: การใช้งาน Angular 4</router-link>
                  </li>
                </ul>
                <h4>
                  <i class="fa fa-cc-visa fa-fw text-muted"></i> การเติมเงิน
                </h4>
                <ul class="nav nav-list">
                  <li>
                    <a href="javascript:;" @click="openVisa">ชำระด้วย บัตรเครดิต</a>
                  </li>
                  <li>
                    <a href="#">ชำระด้วย โอนเงินผ่านธนาคาร</a>
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
        <h4 class="m-b-15 m-t-30">คอร์สที่คุณอาจจะชอบ</h4>
        <div class="row row-space-10">
          <!-- BEGIN col-2 -->
          <div class="col-md-2 col-sm-4" v-for="(like, i) in links" :key="i">
            <!-- BEGIN item -->
            <div class="item item-thumbnail">
              <router-link to="/product-detail" class="item-image">
                <img :src="like.img" alt>
                <div class="discount">{{ getPercent(like) }}% OFF</div>
              </router-link>
              <div class="item-info">
                <h4 class="item-title">
                  <router-link to="/product-detail">{{ like.name }}</router-link>
                </h4>
                <p class="item-desc">{{ like.description }}</p>
                <div class="item-price">฿ {{ numberWithCommas(like.price) }}</div>
                <div class="item-discount-price">฿ {{ numberWithCommas(like.discount) }}</div>
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
    <b-modal ref="modalVisa" title="ชำระด้วย บัตรเครดิต" hide-footer no-fade>
      <Visa />
    </b-modal>
  </section>
</template>

<script>
import { mapState } from "vuex";
import Visa from './Visa'
export default {
    components: { Visa },
    data() {
        return {
            links: [
                {
                    img:
                        "https://udemy-images.udemy.com/course/240x135/764164_de03_2.jpg",
                    name: "The Complete Web Developer Course 2.0",
                    description:
                        "Learn Web Development by building 25 websites and mobile apps using HTML, CSS, Javascript, PHP, Python, MySQL & more!",
                    price: 330,
                    discount: 7800
                },
                {
                    img:
                        "https://udemy-images.udemy.com/course/240x135/959700_8bd2_9.jpg",
                    name: "The Complete React Native and Redux Course",
                    description:
                        "iOS and Android App Development from scratch - build full React Native mobile apps ridiculously fast!",
                    price: 330,
                    discount: 3600
                },
                {
                    img:
                        "https://udemy-images.udemy.com/course/240x135/1212244_825c.jpg",
                    name:
                        "Android O & Java - Mobile App Development | Beginning to End",
                    description:
                        "The complete Android course with Android Studio & Java. Go from beginner to professional app developer.",
                    price: 330,
                    discount: 7800
                },
                {
                    img:
                        "https://udemy-images.udemy.com/course/240x135/529438_f64b_4.jpg",
                    name:
                        "Running a Mobile App Dev Business: The Complete Guide",
                    description:
                        "Learn how to start and grow a mobile app development business. Get up & running in less than 1 week.",
                    price: 330,
                    discount: 5600
                },
                {
                    img:
                        "https://udemy-images.udemy.com/course/240x135/1512578_b4eb_2.jpg",
                    name:
                        "Android App Development: Mobile App Development & Java",
                    description:
                        "Android App Development & Java Programming: Mobile App Development & Design, Build Android Apps, Android 5 & Lollipop",
                    price: 330,
                    discount: 7200
                },
                {
                    img:
                        "https://udemy-images.udemy.com/course/240x135/1017096_0e3f_3.jpg",
                    name:
                        "Mobile App Development for Beginners (Swift 3, iPhone iOS10)",
                    description:
                        "iPhone (iOS 10) app development. The complete development course. Use Swift 3 & Xcode 8 to design 10 iPhone apps.",
                    price: 330,
                    discount: 1800
                }
            ]
        };
    },
    computed: {
        ...mapState(["user"])
    },
    methods: {
        openVisa() {
            this.$refs.modalVisa.show();
        }
    }
};
</script>

<style>
</style>
