<template>
    <section>
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">จัดการตารางสอน</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">จัดการตารางสอน</h1>
        <!-- end page-header -->

        <!-- begin panel -->
        <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">ตารางสอน</h4>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <table id="schedule-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-nowrap">วันเวลาเริ่ม</th>
                            <th class="text-nowrap">วันเวลาสิ้นสุด</th>
                            <th class="text-nowrap">จำนวนหลักสูตร</th>
                            <th class="text-nowrap"></th>
                            <th width="1%" class="text-nowrap" data-priority="1">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <b-modal ref="modalScheduleList" size="lg" title="รายชื่อหลักสูตร">
            <ol>
                <li v-for="(unit, i) in units" :key="i">
                    {{ unit.unit_name }}
                </li>
            </ol>
        </b-modal>
    </section>
</template>

<script>
export default {
    data() {
        return {
            units: [],
            data: {}
        }
    },
    mounted() {
        var self = this;
        $(function () {
            self.table = $("#schedule-table").DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: `/admin/api/schedule/data/17`,
                order: [[0, "asc"]],
                rowCallback: function (row, data, index) {
                    if (data["deleted_at"] != null) {
                        $(row).addClass("danger");
                    }
                },
                columns: [
                    { data: "start", name: "start" },
                    { data: "end", name: "end" },
                    { data: "unit_count", name: "discount" },
                    {
                        data: null,
                        searchable: false,
                        sortable: false,
                        render: (data, type, row, meta) => {
                            const unit = row['unit'];
                            delete row['unit']
                            return `<a href="javascript:;" class="view-course" data-schedule="${escape(JSON.stringify(row))}" data-unit="${escape(JSON.stringify(unit))}">ดูรายการ</a>`
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
                        self.units = JSON.parse(
                            unescape($(this).attr("data-unit"))
                        );
                        self.data = JSON.parse(
                            unescape($(this).attr("data-schedule"))
                        );
                        self.$refs.modalScheduleList.show();
                    });
                }
            });
        });
    }
}
</script>

<style>
</style>
