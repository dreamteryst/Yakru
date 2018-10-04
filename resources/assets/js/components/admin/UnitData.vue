<template>
    <section>
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="/">หน้าแรก</a></li>
            <li class="breadcrumb-item active">จัดการคอร์ส</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">จัดการคอร์ส <small></small></h1>
        <!-- end page-header -->

        <!-- begin panel -->
        <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">รายการบทเรียน</h4>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <div class="m-b-20">
                    <button type="button" class="btn btn-primary">เพิ่มบท</button>
                    <button type="button" class="btn btn-info">เพิ่มวิดีโอ </button>
                </div>
                <table id="manage-course-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="1%" data-priority="1">ID</th>
                            <th class="text-nowrap">ชื่อบทเรียน</th>
                            <th class="text-nowrap">วิดีโอ</th>
                            <th class="text-nowrap">ชื่อบท</th>
                            <th width="1%" class="text-nowrap" data-priority="1">Actions</th>
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
        var groupColumn = 3;
        $(function () {
            self.table = $("#manage-course-table").DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: `/admin/api/lecture/data/1`,
                order: [[3, "desc"],[0, "desc"]],
                columnDefs: [
                    { "visible": false, "targets": groupColumn }
                ],
                rowCallback: function (row, data, index) {
                    if (data["deleted_at"] != null) {
                        $(row).addClass("danger");
                    }
                },
                columns: [
                    { data: "id", name: "id" },
                    { data: "lecture_name", name: "lecture_name" },
                    {                        data: "video_name",
                        render: (data, type, row, meta) => {
                            return `<a href="">${data}</a>`
                        }
                    },
                    { data: "unit_name", name: "unit_name" },
                    {
                        data: null,
                        render: (data, type, row, meta) => {
                            return (
                                `
                          <div class="actions" data='` +
                                JSON.stringify(row) +
                                `'>
                          <i class="fa fa-edit new-user-edit"></i>
                          ` +
                                (row["deleted_at"] == null
                                    ? '<i class="fa fa-trash-alt"></i>'
                                    : '<i class="fa fa-undo"></i>') +
                                `
                          </div>`
                            );
                        },
                        searchable: false,
                        sortable: false
                    }
                ],
                drawCallback: function (settings) {
                    $(".fa-edit").on("click", function () {
                        self.data = JSON.parse(
                            $(this)
                                .closest("div")
                                .attr("data")
                        );
                        self.modalEdit = true;
                    });

                    $(".fa-trash-alt").on("click", function () {
                        self.data = JSON.parse(
                            $(this)
                                .closest("div")
                                .attr("data")
                        );
                        self.modalDelete = true;
                    });
                    $(".fa-undo").on("click", function () {
                        self.data = JSON.parse(
                            $(this)
                                .closest("div")
                                .attr("data")
                        );
                        self.deleteData();
                    });

                    var api = this.api();
                    var rows = api.rows({ page: 'current' }).nodes();
                    var last = null;

                    api.column(groupColumn, { page: 'current' }).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                `<tr class="group">
                                    <td colspan="4">${group}</td>
                                </tr>`
                            );

                            last = group;
                        }
                    });
                }
            });

            $('#manage-course-table tbody').on('click', 'tr.group', function () {
                var currentOrder = self.table.order()[0];
                if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                    self.table.order([groupColumn, 'desc']).draw();
                }
                else {
                    self.table.order([groupColumn, 'asc']).draw();
                }
            });
        });
    }
}
</script>

<style>
</style>
