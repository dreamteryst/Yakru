<template>
  <section>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item">
        <a href="/">Home</a>
      </li>
      <li class="breadcrumb-item active">การแจ้งชำระเงิน</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">
      การแจ้งชำระเงิน
      <small></small>
    </h1>
    <!-- end page-header -->
    <!-- begin panel -->
    <div class="panel panel-inverse">
      <!-- begin panel-heading -->
      <div class="panel-heading">
        <div class="panel-heading-btn">
          <a
            href="javascript:;"
            class="btn btn-xs btn-icon btn-circle btn-warning"
            data-click="panel-collapse"
          >
            <i class="fa fa-minus"></i>
          </a>
        </div>
        <h4 class="panel-title">รายการแจ้งชำระเงิน</h4>
      </div>
      <!-- end panel-heading -->
      <!-- begin panel-body -->
      <div class="panel-body">
        <table id="payment-table" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th width="1%" data-priority="2">ID</th>
              <th class="text-nowrap" data-priority="1">ชื่อ นามสกุล</th>
              <th class="text-nowrap" data-priority="1">เลขที่บัญชีโอนเข้า</th>
              <th class="text-nowrap" data-priority="1">ธนาคาร</th>
              <th class="text-nowrap" data-priority="1">จำนวน</th>
              <th class="text-nowrap" data-priority="1">เวลา</th>
              <th class="text-nowrap" data-priority="1">หลักฐาน</th>
              <th class="text-nowrap" data-priority="1">สถานะ</th>
              <th class="text-nowrap" data-priority="1">เหตุผล</th>
              <th width="1%" class="text-nowrap" data-priority="2">Actions</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <Reverse ref="reverse"/>
  </section>
</template>

<script>
import swal from "sweetalert2";
import Reverse from "./Reverse";
export default {
    components: { Reverse },
    data() {
        return {
            data: ""
        };
    },
    mounted() {
        var self = this;
        $(function() {
            self.table = $("#payment-table").DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: `/admin/api/payment/data`,
                order: [[0, "desc"]],
                rowCallback: function(row, data, index) {
                    if (data["deleted_at"] != null) {
                        $(row).addClass("danger");
                    }
                },
                columns: [
                    { data: "id", name: "id" },
                    { data: "fullname", name: "fullname" },
                    { data: "account_no", name: "account_no" },
                    { data: "bank_name", name: "bank_name" },
                    { data: "amount", name: "amount" },
                    { data: "transferred_at", name: "transferred_at" },
                    {
                        data: "slip",
                        render: (data, type, row, meta) => {
                            return `<a href="${self.renderPicture(
                                data
                            )}" target="_blank">View</a>`;
                        }
                    },
                    {
                        data: "status",
                        render: (data, type, row, meta) => {
                            return `<p class='${
                                data == "unpaid"
                                    ? "text-danger"
                                    : data == "paid"
                                    ? "text-success"
                                    : "text-warning"
                            }'>
                        ${
                            data == "unpaid"
                                ? "ปฏิเสธ"
                                : data == "paid"
                                ? "อนุมัติ"
                                : data == 'reverse'
                                ? "คืนเงิน"
                                : "รอดำเนินการ"
                        }</p>`;
                        }
                    },
                    { data: "reason", name: "reason" },
                    {
                        data: null,
                        render: (data, type, row, meta) => {
                            if (row["status"] === "prepare") {
                                return (
                                    `
                          <div class="actions" data='` +
                                    JSON.stringify(row) +
                                    `'>
                            <button type="button" class="btn btn-info btn-confirm">อนุมัติ</button>
                            <button type="button" class="btn btn-danger btn-reject">ปฏิเสธ</button>
                          </div>`
                                );
                            } else if (row["status"] != "reverse") {
                                return (
                                    `
                                <div class="actions" data='` +
                                    JSON.stringify(row) +
                                    `'>
                                    <button type="button" class="btn btn-danger btn-reverse">คืนเงิน</button>
                                </div>
                                `
                                );
                            }
                            return "";
                        },
                        searchable: false,
                        sortable: false
                    }
                ],
                drawCallback: function(settings) {
                    $(".btn-confirm").on("click", function() {
                        self.alertConfirm(
                            "ยืนยันการดำเนินการ",
                            "คุณต้องการยืนยันการแจ้งชำระเงินใช่หรือไม่"
                        ).then(result => {
                            if (result.value) {
                                self.data = JSON.parse(
                                    $(this)
                                        .closest("div")
                                        .attr("data")
                                );
                                self.confirm(1);
                            }
                        });
                    });
                    $(".btn-reject").on("click", function() {
                        self.alertConfirm(
                            "ยืนยันการดำเนินการ",
                            "คุณต้องการปฏิเสธการแจ้งชำระเงินใช่หรือไม่"
                        ).then(result => {
                            if (result.value) {
                                self.data = JSON.parse(
                                    $(this)
                                        .closest("div")
                                        .attr("data")
                                );
                                self.confirm(2);
                            }
                        });
                    });
                    $(".btn-reverse").on("click", function() {
                        self.data = JSON.parse(
                            $(this)
                                .closest("div")
                                .attr("data")
                        );
                        self.reverse();
                    });
                }
            });
        });
    },
    methods: {
        confirm(mode) {
            axios
                .post("/admin/api/payment/confirm/" + mode, {
                    payment_id: this.data.id
                })
                .then(({ data }) => {
                    this.table.ajax.reload();
                    swal({
                        type: "success",
                        title: "ดำเนินการสำเร็จ"
                    });
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
        },
        reverse() {
            this.$refs.reverse.open(this.data);
        }
    }
};
</script>

<style>
</style>
