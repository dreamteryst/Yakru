<template>
  <section>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item">
        <a href="/">หน้าแรก</a>
      </li>
      <li class="breadcrumb-item active">จัดการคำขอคืนเงิน</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">
      จัดการคำขอคืนเงิน
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
        <h4 class="panel-title">รายการคำขอคืนเงิน</h4>
      </div>
      <!-- end panel-heading -->
      <!-- begin panel-body -->
      <div class="panel-body">
        <table id="table-refund-course" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>วันที่</th>
              <th>ชื่อ สกุล</th>
              <th>ชื่อคอร์ส</th>
              <th>จำนวน (บาท)</th>
              <th>สถานะ</th>
              <th width="1%" data-priority="1">Actions</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
</template>

<script>
export default {
    mounted() {
        var self = this;
        $(function() {
            self.table = $("#table-refund-course").DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: `/admin/api/refund`,
                order: [[0, "desc"]],
                rowCallback: function(row, data, index) {
                    if (data["deleted_at"] != null) {
                        $(row).addClass("danger");
                    }
                },
                columns: [
                    { data: "updated_at", name: "updated_at" },
                    { data: "user_name", name: "user_name" },
                    { data: "course_name", name: "course_name" },
                    { data: "amount", name: "amount" },
                    {
                        data: "status",
                        render: (data, type, row, meta) => {
                            return `<p class='${
                                data == "reject"
                                    ? "text-danger"
                                    : data == "approve"
                                    ? "text-success"
                                    : "text-warning"
                            }'>
                        ${
                            data == "reject"
                                ? "ปฏิเสธ"
                                : data == "approve"
                                ? "อนุมัติ"
                                : "รอดำเนินการ"
                        }</p>`;
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row, meta) => {
                            if (row["status"] === "prepare") {
                                return (
                                    `
                          <div class="actions" data='` +
                                    JSON.stringify(row) +
                                    `'>
                            <button type="button" class="btn btn-info btn-confirm">ยืนยัน</button>
                            <button type="button" class="btn btn-danger btn-unconfirm">ยกเลิก</button>
                          </div>`
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
                            "คุณต้องการยืนยันการคืนเงินใช่หรือไม่?"
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
                    $(".btn-unconfirm").on("click", function() {
                        self.alertConfirm(
                            "ยืนยันการดำเนินการ",
                            "คุณต้องการยกเลิกการยืนยันการคืนเงินใช่หรือไม่?"
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
                }
            });
        });
    },
    methods: {
        confirm(mode) {
            axios
                .post("/admin/api/refund/confirm/" + this.data.id, {
                    mode
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
        }
    }
};
</script>

<style>
</style>
