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
        <h1 class="page-header">แจ้งชำระเงิน</h1>
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
            <a href="#">Support</a>
          </li>
          <li class="active">แจ้งชำระเงิน</li>
        </ul>
        <!-- END breadcrumb -->
        <!-- BEGIN row -->
        <div class="row row-space-30">
          <!-- BEGIN col-8 -->
          <div class="col-md-8">
            <h4 class="m-t-0">ฟอร์มแจ้งชำระเงิน</h4>
            <form
              class="form-horizontal"
              name="contact_us_form"
              action
              method="POST"
              @submit="submit"
            >
              <div class="form-group">
                <label class="control-label col-md-3">
                  เลือกบัญชีที่โอนเข้า
                  <span class="text-danger">*</span>
                </label>
                <div class="col-md-7">
                  <select class="form-control" name="name" v-model="bank_id">
                    <option
                      v-for="(bank, i) in banks"
                      :key="i"
                      :value="bank.id"
                    >{{ bank.bank_name }} ({{ bank.account_no }})</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">
                  วันเวลาที่โอน
                  <span class="text-danger">*</span>
                </label>
                <div class="col-md-7">
                  <input type="text" class="form-control datetimepicker" name="datetime">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">
                  จำนวนเงิน
                  <span class="text-danger">*</span>
                </label>
                <div class="col-md-7">
                  <input type="text" class="form-control" name="amount" v-model="amount">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">
                  แนบสลิป
                  <span class="text-danger">*</span>
                </label>
                <div class="col-md-7">
                  <input type="file" class="form-control" name="slip" @change="handleFile">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3"></label>
                <div class="col-md-7">
                  <button type="submit" class="btn btn-inverse btn-lg">แจ้งชำระเงิน</button>
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
import swal from "sweetalert2";
export default {
    data() {
        return {
            banks: "",
            bank_id: "",
            datetime: "",
            amount: "",
            slip: ""
        };
    },
    mounted() {
        const self = this;
        $(function() {
            $(".datetimepicker").datetimepicker({
                format: "DD/MM/YYYY HH:MM"
            });
            $(".datetimepicker").on("dp.change", function(e) {
                self.datetime = e.date.format("DD/MM/YYYY HH:MM");
            });
        });
        axios
            .get("/api/bank")
            .then(({ data }) => {
                this.banks = data;
            })
            .catch(error => {
                console.log(error);
                if (error.response) console.log(error.response);
            });
    },
    methods: {
        handleFile(event) {
            this.slip = event.target.files[0];
        },
        submit(event) {
            event.preventDefault();
            const payload = new FormData();
            payload.append("bank_id", this.bank_id);
            payload.append("transferred_at", this.datetime);
            payload.append("amount", this.amount);
            payload.append("slip", this.slip, this.slip.name);
            axios
                .post("/api/payment", payload)
                .then(({ data }) => {
                    swal({
                        type: "success",
                        title: "ดำเนินการสำเร็จ"
                    });
                    this.bank_id = "";
                    this.datetime = "";
                    this.amount = "";
                    this.slip = "";
                })
                .catch(error => {
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
    }
};
</script>

<style>
</style>
