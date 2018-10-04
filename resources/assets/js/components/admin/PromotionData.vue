<template>
    <section>
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">จัดการโปรโมชัน</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">จัดการโปรโมชัน <small></small></h1>
        <!-- end page-header -->
        
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">รายการโปรโมชัน</h4>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <table id="promotion-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="1%" data-priority="1">ID</th>
                            <th class="text-nowrap">ชื่อโปรโมชัน</th>
                            <th class="text-nowrap">รายละเอียด</th>
                            <th class="text-nowrap">ส่วนลด (%)</th>
                            <th class="text-nowrap">เริ่มต้น</th>
                            <th class="text-nowrap">สิ้นสุด</th>
                            <th class="text-nowrap">คอร์สที่ร่วม</th>
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
                        <th>คำอธิบาย</th>
                        <th>รายละเอียด</th>
                        <th>ราคา</th>
                        <th>เหลือ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(course, i) in courses" :key="i">
                        <td>{{ course.course_name }}</td>
                        <td>{{ course.course_subtitle }}</td>
                        <td>{{ course.course_description }}</td>
                        <td>{{ numberWithCommas(course.course_price) }}</td>
                        <td>{{ numberWithCommas(getPrice(data.discount, course.course_price)) }}</td>
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
            self.table = $("#promotion-table").DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: `/admin/api/promotion/data`,
                order: [[0, "desc"]],
                rowCallback: function (row, data, index) {
                    if (data["deleted_at"] != null) {
                        $(row).addClass("danger");
                    }
                },
                columns: [
                    { data: "id", name: "id" },
                    { data: "promotion_name", name: "promotion_name" },
                    { data: "promotion_description", name: "promotion_description" },
                    { data: "discount", name: "discount" },
                    { data: "started_at", name: "started_at" },
                    { data: "ended_at", name: "ended_at" },
                    { 
                        data: null,
                        searchable: false,
                        sortable: false,
                        render: (data, type, row, meta) => {
                            const course = row['course'];
                            delete row['course']
                            return `<a href="javascript:;" class="view-course" data-promotion="${escape(JSON.stringify(row))}" data-course="${escape(JSON.stringify(course))}">ดูรายการ</a>`
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
                            unescape($(this).attr("data-promotion"))
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
