<template>
  <section>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item">
        <a href="/">หน้าแรก</a>
      </li>
      <li class="breadcrumb-item active">จัดการหลักสูตร</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <!-- <h1 class="page-header">จัดการหลักสูตร<router-link to="/admin/course/unit/add" class="btn btn-info ml-3">เพิ่มหลักสูตร</router-link> -->
    <h1 class="page-header">จัดการหลักสูตร
      <router-link
        :to="`/admin/course/unit/${$route.params.id}/add`"
        class="btn btn-info ml-3"
      >เพิ่มหลักสูตร</router-link>
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
        <h4 class="panel-title">รายการหลักสูตร</h4>
      </div>
      <!-- end panel-heading -->
      <!-- begin panel-body -->
      <div class="panel-body">
        <table id="unit-table" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th width="1%" data-priority="1">ID</th>
              <th class="text-nowrap">ชื่อบทเรียน</th>
              <th class="text-nowrap">จำนวนเลคเชอร์</th>
              <th class="text-nowrap">รายการเลคเชอร์</th>
              <th width="1%" class="text-nowrap" data-priority="1">Actions</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <b-modal ref="modalLectureList" size="lg" title="รายชื่อคอร์ส">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>ชื่อเลคเชอร์</th>
            <th>ที่อยู่วิดีโอ</th>
            <th>การเข้าถึง</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(lecture, i) in lectures" :key="i">
            <td>{{ lecture.lecture_name }}</td>
            <td>{{ lecture.video_name }}</td>
            <td>{{ lecture.guest ? 'Public' : 'Private' }}</td>
          </tr>
        </tbody>
      </table>
    </b-modal>
    <b-modal ref="modalEdit" size="lg" title="แก้ไข" hide-footer>
      <form @submit="submit">
        <div class="form-group">
          <label for="unit_name">ชื่อหลักสูตร</label>
          <input
            type="text"
            class="form-control"
            id="unit_name"
            placeholder="ชื่อหลักสูตร"
            v-model="data.unit_name"
          >
        </div>
        <div class="form-group text-right">
          <button type="submit" class="btn btn-primary">บันทึก</button>
        </div>
      </form>
    </b-modal>
  </section>
</template>

<script>
import swal from "sweetalert2";
export default {
    data() {
        return {
            lectures: [],
            data: {},
            unit_name: ""
        };
    },
    mounted() {
        var self = this;
        $(function() {
            self.table = $("#unit-table").DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: `/admin/api/unit/data/` + self.$route.params.id,
                order: [[0, "desc"]],
                rowCallback: function(row, data, index) {
                    if (data["deleted_at"] != null) {
                        $(row).addClass("danger");
                    }
                },
                columns: [
                    { data: "id", name: "id" },
                    { data: "unit_name", name: "unit_name" },
                    { data: "lecture_count", name: "lecture_count" },
                    {
                        data: null,
                        searchable: false,
                        sortable: false,
                        render: (data, type, row, meta) => {
                            const lectures = row["lectures"];
                            delete row["lectures"];
                            return `<a href="javascript:;" class="view-course" data-unit="${escape(
                                JSON.stringify(row)
                            )}" data-lectures="${escape(
                                JSON.stringify(lectures)
                            )}">ดูรายการ</a>`;
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row, meta) => {
                            return (
                                `
                          <div class="actions" data='` +
                                JSON.stringify(row) +
                                `'>
                            <i class="fa fa-edit unit-edit"></i>
                            <i class="fa fa-trash-alt unit-delete"></i>
                          </div>`
                            );
                        },
                        searchable: false,
                        sortable: false
                    }
                ],
                drawCallback: function(settings) {
                    $(".view-course").on("click", function() {
                        self.lectures = JSON.parse(
                            unescape($(this).attr("data-lectures"))
                        );
                        self.data = JSON.parse(
                            unescape($(this).attr("data-unit"))
                        );
                        self.$refs.modalLectureList.show();
                    });
                    $(".unit-edit").on("click", function() {
                        self.data = JSON.parse(
                            $(this)
                                .closest("div")
                                .attr("data")
                        );
                        self.$refs.modalEdit.show();
                    });
                    $(".unit-delete").on("click", function() {
                        swal({
                            title: "ยืนยันการดำเนินการ",
                            text: "คุณต้องการยืนยันการลบข้อมูลใช่หรือไม่?",
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
                                self.remove();
                            }
                        });
                    });
                }
            });
        });
    },
    methods: {
        openAdd() {
            this.$refs.modalAddUnit.show();
        },
        submit(event) {
            event.preventDefault();
            const payload = new FormData();
            payload.append("unit_name", this.data.unit_name);
            payload.append("_method", "PUT");

            axios
                .post(`/admin/api/unit/${this.data.id}`, payload)
                .then(({ data }) => {
                    this.table.ajax.reload();
                    swal({
                        type: "success",
                        title: "ดำเนินการสำเร็จ"
                    });
                    this.$refs.modalEdit.hide();
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
        remove() {
            const payload = new FormData();
            payload.append("_method", "DELETE");

            axios
                .post(`/admin/api/unit/${this.data.id}`, payload)
                .then(({ data }) => {
                    this.table.ajax.reload();
                    swal({
                        type: "success",
                        title: "ดำเนินการสำเร็จ"
                    });
                    this.$refs.modalEdit.hide();
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
