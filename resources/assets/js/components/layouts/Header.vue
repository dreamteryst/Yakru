<template>
  <section>
    <!-- BEGIN #header -->
    <div id="header" class="header">
      <!-- BEGIN container -->
      <div class="container">
        <!-- BEGIN header-container -->
        <div class="header-container">
          <!-- BEGIN navbar-header -->
          <div class="navbar-header">
            <button
              type="button"
              class="navbar-toggle collapsed"
              data-toggle="collapse"
              data-target="#navbar-collapse"
            >
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <div class="header-logo">
              <router-link to="/">
                <span class="brand-logo" style="border: 0px;">
                  <img src="/assets/img/logo-small.png" width="30" height="30">
                </span>
                <span>Yak</span>ru
                <small>MOOC Via Live Streaming</small>
              </router-link>
            </div>
          </div>
          <!-- END navbar-header -->
          <!-- BEGIN header-nav -->
          <div class="header-nav">
            <div class="collapse navbar-collapse" id="navbar-collapse">
              <ul class="nav">
                <li class="active">
                  <router-link to="/">หน้าแรก</router-link>
                </li>
                <li>
                  <router-link to="/payment">แจ้งชำระเงิน</router-link>
                </li>
                <li>
                  <router-link to="/refund">ขอคืนเงิน</router-link>
                </li>
                <li v-if="profile.type === 'student'">
                  <router-link to="/teacher/register">สมัครเป็นผู้สอน</router-link>
                </li>
                <li>
                  <router-link to="/contact">ติดต่อเรา</router-link>
                </li>
              </ul>
            </div>
          </div>
          <!-- END header-nav -->
          <!-- BEGIN header-nav -->
          <div class="header-nav">
            <ul class="nav pull-right">
              <li>
                <router-link to="/profile" v-if="isAuth">
                  <img src="/assets_admin/img/user/personal.png" class="user-img" alt>
                  <span
                  >{{ profile.firstname }} {{ profile.lastname }}</span>
                </router-link>
                <a href="/auth" v-if="!isAuth">
                  <span class="hidden-md hidden-sm hidden-xs">เข้าสู่ระบบ / สมัครสมาชิก</span>
                </a>
              </li>
              <li class="divider" v-if="isAuth"></li>
              <li v-if="isAuth">
                <a class="balance" v-if="profile.money != undefined">
                  <i class="fas fa-coins"></i>
                  &nbsp;{{ numberWithCommas(profile.money) }}
                </a>
              </li>
            </ul>
          </div>
          <!-- END header-nav -->
        </div>
        <!-- END header-container -->
      </div>
      <!-- END container -->
    </div>
    <!-- END #header -->
  </section>
</template>

<script>
import { mapState } from "vuex";
export default {
    data() {
        return {
            profile: {}
        };
    },
    computed: {
        ...mapState(["user"]),
        ...mapState("auth", ["isAuth"])
    },
    watch: {
        user() {
            this.profile = {...this.user};
        }
    }
};
</script>
