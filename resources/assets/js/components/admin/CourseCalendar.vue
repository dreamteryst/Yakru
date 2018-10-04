<template>
    <section>
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="javascript:;">หน้าแรก</a></li>
            <li class="breadcrumb-item active">ปฏิทินการสอน</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">ปฏิทินการสอน</h1>
        <!-- end page-header -->
        <hr class="bg-grey-lighter" />
        <!-- begin vertical-box -->
        <div class="vertical-box">
            <!-- begin event-list -->
            <div class="vertical-box-column p-r-30 d-none d-lg-table-cell" style="width: 215px">
                <div id="external-events" class="fc-event-list">
                    <h5 class="m-t-0 m-b-15">Draggable Events</h5>
                    <div class="fc-event" data-color="#00acac">
                        <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-success"></i></div>
                        Meeting with Client
                    </div>
                    <div class="fc-event" data-color="#348fe2">
                        <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-primary"></i></div>
                        IOS App Development
                    </div>
                    <div class="fc-event" data-color="#f59c1a">
                        <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-warning"></i></div>
                        Group Discussion
                    </div>
                    <div class="fc-event" data-color="#ff5b57">
                        <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-danger"></i></div>
                        New System Briefing
                    </div>
                    <div class="fc-event">
                        <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-inverse"></i></div>
                        Brainstorming
                    </div>
                    <hr class="bg-grey-lighter m-b-15" />
                    <h5 class="m-t-0 m-b-15">Other Events</h5>
                    <div class="fc-event" data-color="#b6c2c9">
                        <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-grey"></i></div>
                        Other Event 1
                    </div>
                    <div class="fc-event" data-color="#b6c2c9">
                        <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-grey"></i></div>
                        Other Event 2
                    </div>
                    <div class="fc-event" data-color="#b6c2c9">
                        <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-grey"></i></div>
                        Other Event 3
                    </div>
                    <div class="fc-event" data-color="#b6c2c9">
                        <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-grey"></i></div>
                        Other Event 4
                    </div>
                    <div class="fc-event" data-color="#b6c2c9">
                        <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-grey"></i></div>
                        Other Event 5
                    </div>
                </div>
            </div>
            <!-- end event-list -->
            <!-- begin calendar -->
            <div id="calendar" class="vertical-box-column calendar"></div>
            <!-- end calendar -->
        </div>
        <!-- end vertical-box -->
    </section>
</template>

<script>
export default {
    mounted() {
        $(function () {
            $('#external-events .fc-event').each(function () {
                $(this).data('event', {
                    title: $.trim($(this).text()), // use the element's text as the event title
                    stick: true, // maintain when user navigates (see docs on the renderEvent method)
                    color: ($(this).attr('data-color')) ? $(this).attr('data-color') : ''
                });
                $(this).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });
            });

            var date = new Date();
            var currentYear = date.getFullYear();
            var currentMonth = date.getMonth() + 1;
            currentMonth = (currentMonth < 10) ? '0' + currentMonth : currentMonth;

            $('#calendar').fullCalendar({
                header: {
                    left: 'month,agendaWeek,agendaDay',
                    center: 'title',
                    right: 'prev,today,next '
                },
                droppable: true, // this allows things to be dropped onto the calendar
                drop: function () {
                    $(this).remove();
                },
                selectable: true,
                selectHelper: true,
                select: function (start, end) {
                    var title = prompt('Event Title:');
                    var eventData;
                    if (title) {
                        eventData = {
                            title: title,
                            start: start,
                            end: end
                        };
                        $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                    }
                    $('#calendar').fullCalendar('unselect');
                },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [{
                    title: 'All Day Event',
                    start: currentYear + '-' + currentMonth + '-01',
                    color: COLOR_GREEN
                }, {
                    title: 'Long Event',
                    start: currentYear + '-' + currentMonth + '-07',
                    end: currentYear + '-' + currentMonth + '-10'
                }, {
                    id: 999,
                    title: 'Repeating Event',
                    start: currentYear + '-' + currentMonth + '-09T16:00:00',
                    color: COLOR_GREEN
                }, {
                    id: 999,
                    title: 'Repeating Event',
                    start: currentYear + '-' + currentMonth + '-16T16:00:00'
                }, {
                    title: 'Conference',
                    start: currentYear + '-' + currentMonth + '-11',
                    end: currentYear + '-' + currentMonth + '-13'
                }, {
                    title: 'Meeting',
                    start: currentYear + '-' + currentMonth + '-12T10:30:00',
                    end: currentYear + '-' + currentMonth + '-12T12:30:00',
                    color: COLOR_GREEN
                }, {
                    title: 'Lunch',
                    start: currentYear + '-' + currentMonth + '-12T12:00:00',
                    color: COLOR_BLUE
                }, {
                    title: 'Meeting',
                    start: currentYear + '-' + currentMonth + '-12T14:30:00'
                }, {
                    title: 'Happy Hour',
                    start: currentYear + '-' + currentMonth + '-12T17:30:00'
                }, {
                    title: 'Dinner',
                    start: currentYear + '-' + currentMonth + '-12T20:00:00'
                }, {
                    title: 'Birthday Party',
                    start: currentYear + '-' + currentMonth + '-13T07:00:00'
                }, {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: currentYear + '-' + currentMonth + '-28',
                    color: COLOR_RED
                }]
            });
        })
    }
}
</script>

<style>
</style>
