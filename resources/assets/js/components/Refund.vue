<template>
  <section>
    <div id="page-header" class="section-container page-header-container bg-black">
      <!-- BEGIN page-header-cover -->
      <div class="page-header-cover">
        <img src="/assets/img/cover/cover-15.jpg" alt>
      </div>
      <!-- END page-header-cover -->
      <!-- BEGIN container -->
      <div class="container">
        <h1 class="page-header">ขอคืนเงิน</h1>
      </div>
      <!-- END container -->
    </div>
    <div id="product" class="section-container p-t-20 bg-white">
      <!-- BEGIN container -->
      <div class="container">
        <!-- BEGIN breadcrumb -->
        <ul class="breadcrumb m-b-10 f-s-18">
          <li>
            <a href="#">Home</a>
          </li>
          <li>
            <a href="#">User</a>
          </li>
          <li class="active">ขอคืนเงิน</li>
        </ul>
        <!-- END breadcrumb -->
        <!-- BEGIN row -->
        <div class="row row-space-30">
          <!-- BEGIN col-8 -->
          <div class="col-md-8">
            <h4 class="m-t-0">ฟอร์มขอคืนเงิน</h4>
            <form
              class="form-horizontal"
              name="contact_us_form"
              action="contact_us.html"
              method="POST"
              @submit="submit"
            >
              <b-form-group label="คอร์ส" label-for="course_id" horizontal>
                <b-form-select
                  id="course_id"
                  v-model="course_id"
                  :options="courseOptions"
                  required
                />
              </b-form-group>
              <b-form-group label="ราคา" label-for="course_price" horizontal>
                <b-form-input id="course_price" v-model="course_price" readonly/>
              </b-form-group>
              <b-form-group label="เงินที่ได้คืน" label-for="refund_amount" horizontal>
                <b-form-input id="refund_amount" v-model="refund_amount" readonly/>
              </b-form-group>
              <b-form-group label="เหตุผล" label-for="reason" horizontal>
                <b-form-textarea id="reason" rows="10" v-model="reason" required></b-form-textarea>
              </b-form-group>
              <div class="form-group">
                <label class="control-label col-md-3"></label>
                <div class="col-md-7">
                  <button type="submit" class="btn btn-inverse btn-lg">ส่งคำขอ</button>
                </div>
              </div>
            </form>
          </div>
          <!-- END col-8 -->
          <!-- BEGIN col-4 -->
          <div class="col-md-4"></div>
          <!-- END col-4 -->
        </div>
        <!-- END row -->
      </div>
      <!-- END row -->
    </div>
  </section>
</template>

<script>
export default {
    data() {
        return {
            course_id: "",
            courseOptions: {},
            courses: [],
            reason: "",
            course_price: "",
            refund_amount: ""
        };
    },
    watch: {
        course_id(val) {
            const course = this.courses.find(item => item.course_id == val);
            this.course_price = course.course.order[0].course_price;
            this.refund_amount =
                (course.course.refund_percentage *
                    course.course.order[0].course_price) /
                    100 +
                ` (${course.course.refund_percentage}%)`;
        }
    },
    mounted() {
        axios
            .get("/api/course/me")
            .then(({ data }) => {
                this.courses = data;
                this.courseOptions = data.map(item => {
                    return {
                        value: item.course.id,
                        text: item.course.course_name
                    };
                });
            })
            .catch(error => {
                console.log(error);
                if (error.response) console.log(error.response);
            });
    },
    methods: {
        submit(e) {
            e.preventDefault();
            const payload = new FormData();
            payload.append('course_id', this.course_id);
            payload.append('reason', this.reason);
            axios.post('/api/course/refund', payload).then(({ data }) => {
                this.alertSuccess();
            }).catch(error => {
                console.log(error)
                if (error.response.data.errors) {
                    this.alertWarning(errro.response.data.errors.message)
                }
            })
        }
    }
};
</script>

<style>
</style>
