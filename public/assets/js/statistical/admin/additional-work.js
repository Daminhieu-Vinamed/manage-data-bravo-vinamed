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
        events: linkStatisticalAdmin + 'additional-work',
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
                title: 'CHI TIẾT BỔ XUNG CÔNG',
                trigger: 'hover',
                placement: 'top',
                container: 'body',
                html: trueValue
            }
            element.css({'background-color': '#4e73df', 'border': '1px solid #4e73df'});
            if (event.end) {
                popover.content = 'Phòng ban: ' + event.department + '<br>Mã nhân viên: ' + event.code + '<br>Họ và tên: ' + event.title + '<br>Bắt đầu: ' + moment(event.start).format('dddd, D MMMM [năm] YYYY') + '<br>Kết thúc: ' + moment(event.end).format('dddd, D MMMM [năm] YYYY');
            }else{
                popover.content = 'Phòng ban: ' + event.department + '<br>Mã nhân viên: ' + event.code + '<br>Họ và tên: ' + event.title + '<br>' + moment(event.start).format('dddd, D MMMM [năm] YYYY');
            }
            element.popover(popover);
        },
        select: function(start, end, jsEvent, view) {
        },
    });
})