<template>
  <section>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item">
        <a href="/">Home</a>
      </li>
      <li class="breadcrumb-item active">ข้อมูลผู้สมัครเป็นผู้สอน</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">
      ข้อมูลผู้สมัครเป็นผู้สอน
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
        <h4 class="panel-title">รายข้อมูลผู้สมัครเป็นผู้สอน</h4>
      </div>
      <!-- end panel-heading -->
      <!-- begin panel-body -->
      <div class="panel-body">
        <table id="teacherRegister-table" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th width="1%" data-priority="1">ID</th>
              <th class="text-nowrap">ชื่อ นามสกุล</th>
              <th class="text-nowrap">เลขบัตรประชาชน</th>
              <th class="text-nowrap">อีเมล</th>
              <th class="text-nowrap">วันเกิด</th>
              <th class="text-nowrap">คำแนะนำตัว</th>
              <th class="text-nowrap">ทักษะ</th>
              <th width="1%" class="text-nowrap" data-priority="1">Actions</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </section>
</template>

<script>
import swal from "sweetalert2";
export default {
    data() {
        return {
            data: ""
        };
    },
    mounted() {
        var self = this;
        $(function() {
            self.table = $("#teacherRegister-table").DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: `/admin/api/teacherRegister/data`,
                order: [[0, "desc"]],
                rowCallback: function(row, data, index) {
                    if (data["deleted_at"] != null) {
                        $(row).addClass("danger");
                    }
                },
                columns: [
                    { data: "id", name: "id" },
                    { data: "name", name: "name" },
                    { data: "citizen_id", name: "citizen_id" },
                    { data: "email", name: "email" },
                    { data: "date_of_birth", name: "date_of_birth" },
                    { data: "bio", name: "bio" },
                    { data: "skill", name: "skill" },
                    {
                        data: null,
                        render: (data, type, row, meta) => {
                            if (row["status"] === "unaccept") {
                                return (
                                    `
                          <div class="actions" data='` +
                                    JSON.stringify(row) +
                                    `'>
                            <button type="button" class="btn btn-info btn-confirm">ยืนยัน</button>
                          </div>`
                                );
                            } else {
                                return (
                                    `
                          <div class="actions" data='` +
                                    JSON.stringify(row) +
                                    `'>
                            <button type="button" class="btn btn-danger btn-unconfirm">ยกเลิก</button>
                          </div>`
                                );
                            }
                        },
                        searchable: false,
                        sortable: false
                    }
                ],
                drawCallback: function(settings) {
                    $(".btn-confirm").on("click", function() {
                        swal({
                            title: "ยืนยันการดำเนินการ",
                            text: "คุณต้องการยืนยันผู้สอนใช่หรือไม่?",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes",
                            reverseButtons: true
                        }).then(result => {
                            if (result.value) {
                                self.data = JSON.parse(
                                    $(this)
                                        .closest("div")
                                        .attr("data")
                                );
                                self.confirm();
                            }
                        });
                    });
                    $(".btn-unconfirm").on("click", function() {
                        swal({
                            title: "ยืนยันการดำเนินการ",
                            text: "คุณต้องการยกเลิกการยืนยันผู้สอนใช่หรือไม่?",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes",
                            reverseButtons: true
                        }).then(result => {
                            if (result.value) {
                                self.data = JSON.parse(
                                    $(this)
                                        .closest("div")
                                        .attr("data")
                                );
                                self.confirm();
                            }
                        });
                    });
                }
            });
        });
    },
    methods: {
        confirm() {
            axios
                .post("/admin/api/teacherRegister/confirm", {
                    id: this.data.id
                })
                .then(({ data }) => {
                    this.table.ajax.reload()
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
