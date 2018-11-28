<template>
  <section>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item">
        <a href="/">Home</a>
      </li>
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
          <a
            href="javascript:;"
            class="btn btn-xs btn-icon btn-circle btn-warning"
            data-click="panel-collapse"
          >
            <i class="fa fa-minus"></i>
          </a>
        </div>
        <h4 class="panel-title">ตารางสอน</h4>
      </div>
      <!-- end panel-heading -->
      <!-- begin panel-body -->
      <div class="panel-body">
        <table id="schedule-table" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>หัวข้อ</th>
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
    <div class="vertical-box">
      <div id="calendar" class="vertical-box-column calendar"></div>
    </div>
    <b-modal ref="modalScheduleList" size="lg" title="รายชื่อหลักสูตร">
      <ol>
        <li v-for="(unit, i) in units" :key="i">{{ unit.unit_name }}</li>
      </ol>
    </b-modal>
    <b-modal ref="modalAddSchedule" title="เพิ่มตารางสอน" hide-footer>
      <form @submit="submit">
        <div class="form-group">
          <label for="title">หัวข้อ</label>
          <input type="text" id="title" class="form-control" v-model="addData.title" required>
        </div>
        <div class="form-group">
          <label>เลือกบท</label>
          <div class="col-md-3 offset-md-10 col-4 offset-9">
            <i class="fa fa-plus fa-2x m-t-5" @click="addUnit"></i>
            <i class="fa fa-minus fa-2x m-t-5 m-l-5" @click="removeUnit"></i>
          </div>
          <div class="row m-b-15" v-for="(u, j) in addData.units" :key="j">
            <div class="col-md-10">
              <select :id="`unit${j}`" class="form-control" v-model="addData.units[j]">
                <option
                  v-for="(unit, k) in courseUnits"
                  :key="k"
                  :value="unit.id"
                >{{ unit.unit_name }}</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="dateStart">เวลาเริ่ม</label>
          <input type="text" id="dateStart" class="form-control" v-model="addData.start" required>
        </div>
        <div class="form-group">
          <label for="dateEnd">เวลาสิ้นสุด</label>
          <input type="text" id="dateEnd" class="form-control" v-model="addData.end" required>
        </div>
        <div class="form-group text-right">
          <button type="submit" class="btn btn-primary">บันทึก</button>
        </div>
      </form>
    </b-modal>
  </section>
</template>

<script>
import moment from "moment";
import swal from "sweetalert2";
export default {
    data() {
        return {
            units: [],
            data: {},
            addData: {
                title: "",
                units: [""],
                start: "",
                end: ""
            },
            courseUnits: [],
            schedules: []
        };
    },
    mounted() {
        var self = this;
        var date = new Date();
        var currentYear = date.getFullYear();
        var currentMonth = date.getMonth() + 1;
        currentMonth = currentMonth < 10 ? "0" + currentMonth : currentMonth;
        axios
            .get(`/admin/api/course/${self.$route.params.id}/unit`)
            .then(({ data }) => {
                this.courseUnits = data;
            });
        axios
            .get(`/admin/api/schedule/data/${self.$route.params.id}`)
            .then(({ data }) => {
                data.data.map(item => {
                    this.schedules.push({
                        title: item.title,
                        start: item.start,
                        end: item.end
                    });
                });
                $("#calendar").fullCalendar({
                    header: {
                        left: "month,agendaWeek,agendaDay",
                        center: "title",
                        right: "prev,today,next "
                    },
                    droppable: true, // this allows things to be dropped onto the calendar
                    drop: function() {
                        $(this).remove();
                    },
                    selectable: true,
                    selectHelper: true,
                    select: function(start, end) {
                        self.$refs.modalAddSchedule.show();
                        self.addData.start = moment
                            .utc(start)
                            .format("YYYY-MM-DD HH:mm");
                        self.addData.end = moment
                            .utc(end)
                            .format("YYYY-MM-DD HH:mm");
                    },
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    events: self.schedules
                });
            });
        $(function() {
            self.table = $("#schedule-table").DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: `/admin/api/schedule/data/${self.$route.params.id}`,
                order: [[0, "asc"]],
                rowCallback: function(row, data, index) {
                    if (data["deleted_at"] != null) {
                        $(row).addClass("danger");
                    }
                },
                columns: [
                    { data: "title", name: "title" },
                    { data: "start", name: "start" },
                    { data: "end", name: "end" },
                    { data: "unit_count", name: "discount" },
                    {
                        data: null,
                        searchable: false,
                        sortable: false,
                        render: (data, type, row, meta) => {
                            const unit = row["unit"];
                            delete row["unit"];
                            return `<a href="javascript:;" class="view-course" data-schedule="${escape(
                                JSON.stringify(row)
                            )}" data-unit="${escape(
                                JSON.stringify(unit)
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
                            <i class="fa fa-trash-alt"></i>
                          </div>`
                            );
                        },
                        searchable: false,
                        sortable: false
                    }
                ],
                drawCallback: function(settings) {
                    $(".view-course").on("click", function() {
                        self.units = JSON.parse(
                            unescape($(this).attr("data-unit"))
                        );
                        self.data = JSON.parse(
                            unescape($(this).attr("data-schedule"))
                        );
                        self.$refs.modalScheduleList.show();
                    });
                    $(".fa-trash-alt").on("click", function() {
                        swal({
                            title: "ยืนยันการดำเนินการ",
                            text: "คุณต้องการลบข้อมูลตารางสอนใช่หรือไม่?",
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
                                self.delete();
                            }
                        });
                    });
                }
            });
        });
    },
    methods: {
        addUnit() {
            this.addData.units.push("");
        },
        removeUnit() {
            this.addData.units.pop();
        },
        delete() {
            const payload = new FormData()
            payload.append('_method', 'DELETE')
            axios
                .post(`/admin/api/schedule/${this.data.id}`, payload)
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
        },
        submit(event) {
            event.preventDefault();
            const payload = new FormData();
            this.addData.units.map(item => {
                console.log(item);
                payload.append("unit[]", item);
            });
            payload.append("title", this.addData.title);
            payload.append("start", this.addData.start);
            payload.append("end", this.addData.end);
            payload.append("course_id", this.$route.params.id);
            axios
                .post(`/admin/api/schedule`, payload)
                .then(({ data }) => {
                    this.$refs.modalAddSchedule.hide();
                    $("#calendar").fullCalendar("renderEvent", data, true); // stick? = true
                    $("#calendar").fullCalendar("unselect");
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
