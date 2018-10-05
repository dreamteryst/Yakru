<template>
    <section>
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">จัดการข้อมูลผู้เรียน</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">จัดการข้อมูลผู้เรียน <small></small></h1>
        <!-- end page-header -->

        <!-- begin panel -->
        <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">รายชื่อผู้เรียน</h4>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <table id="student-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="1%" data-priority="1">ID</th>
                            <th class="text-nowrap">ชื่อ สกุล</th>
                            <th class="text-nowrap">อีเมล</th>
                            <th class="text-nowrap">เบอร์โทร</th>
                            <th class="text-nowrap">ยอดเงิน</th>
                            <th class="text-nowrap">จำนวนคอร์สเรียน</th>
                            <th width="1%" class="text-nowrap" data-priority="1">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <b-modal ref="modalCourseList" size="lg" title="รายชื่อคอร์ส">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ชื่อคอร์ส</th>
                        <th>ราคา</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(course, i) in courses" :key="i">
                        <td>{{ course.course_name }}</td>
                        <td>{{ numberWithCommas(course.course_price) }}</td>
                    </tr>
                </tbody>
            </table>
        </b-modal>
    </section>
</template>

<script>
export default {
    data() {
        return {
            courses: [],
            data: {}
        }
    },
    mounted() {
        var self = this;
        $(function () {
            self.table = $("#student-table").DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: `/admin/api/student/data`,
                order: [[0, "desc"]],
                rowCallback: function (row, data, index) {
                    if (data["deleted_at"] != null) {
                        $(row).addClass("danger");
                    }
                },
                columns: [
                    { data: "id", name: "id" },
                    { data: "fullname", name: "fullname" },
                    { data: "email", name: "email" },
                    { data: "phone_number", name: "phone_number" },
                    {
                        data: "money",
                        render: (data, type, row, meta) => {
                            return self.numberWithCommas(data)
                        }
                    },
                    { 
                        data: "course_count",
                        render: (data, type, row, meta) => {
                            const courses = row['courses'];
                            delete row['courses']
                            return `<a href="javascript:;" class="view-course" data-student="${escape(JSON.stringify(row))}" data-course="${escape(JSON.stringify(courses))}">${data}</a>`
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
                            <i class="fa fa-edit new-user-edit"></i>
                            <i class="fa fa-trash-alt"></i>
                          </div>`
                            );
                        },
                        searchable: false,
                        sortable: false
                    }
                ],
                drawCallback: function (settings) {
                    $(".view-course").on("click", function () {
                        self.courses = JSON.parse(
                            unescape($(this).attr("data-course"))
                        );
                        self.data = JSON.parse(
                            unescape($(this).attr("data-student"))
                        );
                        self.$refs.modalCourseList.show();
                    });
                }
            });
        });
    }
}
</script>

<style>
</style>
