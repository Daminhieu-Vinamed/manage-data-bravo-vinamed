$(document).ready(function () {
    $("#calendar").fullCalendar({
        locale: 'vi',
        header: {
            left: 'prev, next today',
            center: 'title',
            right: 'agendaDay, agendaWeek, month, listMonth',
        },
        buttonText: {
            today:    'Hôm nay',
            month:    'Tháng',
            week:     'Tuần',
            day:      'Ngày',
            list:     'Lịch biểu'
        },
        noEventsMessage: "Không có sự kiện để hiển thị",
        timeFormat: 'H(:mm) A',
        events: linkStatisticalManage + 'on-leave',
        nowIndicator: trueValue,
        selectable: trueValue,
        navLinks: trueValue,
        weekNumbers: trueValue,
        eventLimit: trueValue,
        eventLimitClick: 'popover',
        editable: trueValue,
        displayEventTime: falseValue,
        eventRender: function (event, element, view) {
            var popover = {
                title: 'Nghỉ phép ' + event.title,
                trigger: 'hover',
                placement: 'top',
                container: 'body',
                html: trueValue
            }
            element.css({'background-color': '#4e73df', 'border': '1px solid #4e73df'});
            if (event.end) {
                popover.content = 'Bắt đầu: ' + moment(event.start).format('LLLL') + '<br>Kết thúc: ' + moment(event.end).format('LLLL');
            }else{
                popover.content = moment(event.start).format('LLLL');
            }
            element.popover(popover);
        },
        select: function(start, end, jsEvent, view) {
        },
    });
})