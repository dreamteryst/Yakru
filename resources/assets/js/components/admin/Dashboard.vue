<template>
    <section>
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:;">Dashboard</a></li>
        </ol>
        <!-- end breadcrumb -->

        <!-- begin page-header -->
        <h1 class="page-header">ภาพรวมของระบบ</h1>
        <!-- end page-header -->

        <!-- begin row -->
        <div class="row">
            <!-- begin col-3 -->
            <div class="col-lg-3 col-md-6">
                <div class="widget widget-stats bg-gradient-green">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
                    <div class="stats-content">
                        <div class="stats-title">สมาชิกทั้งหมด</div>
                        <div class="stats-number" v-if="this.stats.total_member">{{ numberWithCommas(this.stats.total_member) }}</div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 80%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-lg-3 col-md-6">
                <div class="widget widget-stats bg-gradient-blue">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
                    <div class="stats-content">
                        <div class="stats-title">คอร์สทั้งหมด</div>
                        <div class="stats-number">{{ this.stats.total_course ? numberWithCommas(this.stats.total_course) : 0 }}</div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 80%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-lg-3 col-md-6">
                <div class="widget widget-stats bg-gradient-purple">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
                    <div class="stats-content">
                        <div class="stats-title">ยอดขายคอร์ส (บาท)</div>
                        <div class="stats-number" v-if="this.stats.course_sell">{{ numberWithCommas(this.stats.course_sell) }}</div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 80%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-lg-3 col-md-6">
                <div class="widget widget-stats bg-gradient-black">
                    <div class="stats-icon stats-icon-lg"><i class="fa fa-comment-alt fa-fw"></i></div>
                    <div class="stats-content">
                        <div class="stats-title">ผู้สอนทั้งหมด</div>
                        <div class="stats-number" v-if="this.stats.total_teacher">{{ numberWithCommas(this.stats.total_teacher) }}</div>
                        <div class="stats-progress progress">
                            <div class="progress-bar" style="width: 80%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
        </div>
        <!-- end row -->
        <div class="vertical-box">
            <div id="calendar" class="vertical-box-column calendar"></div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            schedules: [],
            stats: {}
        }
    },
    mounted() {
        $(function () {
            DashboardV2.init();
        })
        axios
            .get(`/admin/api/setting/stats`)
            .then(({ data }) => {
                this.stats = data
            });
        axios
            .get(`/admin/api/schedule`)
            .then(({ data }) => {
                data.map(course => {
                    course.schedule.map(item => {
                        this.schedules.push({
                            title: item.title,
                            start: item.start,
                            end: item.end
                        });
                    });
                })
                const self = this
                $(function () {
                    $("#calendar").fullCalendar({
                        header: {
                            left: "month,agendaWeek,agendaDay",
                            center: "title",
                            right: "prev,today,next "
                        },
                        droppable: false,
                        selectable: false,
                        selectHelper: false,
                        editable: false,
                        eventLimit: true, // allow "more" link when too many events
                        events: self.schedules
                    });
                });
            });
    }
}
</script>

<style>
</style>
