$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

var calendar = $("#calendar").fullCalendar({
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
    events: linkTimekeeping,
    nowIndicator: true,
    displayEventEnd: true,
    selectable: true,
    navLinks: true,
    weekNumbers: true,
    eventLimit: true,
    eventLimitClick: 'popover',
    eventRender: function (event, element, view) {
        var popover = {
            title: event.title,
            trigger: 'hover',
            placement: 'top',
            container: 'body',
            html: true
        }
        if (event.end) {
            popover.content = 'Thời gian vào: ' + moment(event.start).format('LLLL') + '<br> thời gian ra: ' + moment(event.end).format('LLLL');
            element.css({'background-color': '#1cc88a', 'border': '1px solid #1cc88a'});
        }else{
            popover.content = 'Thời gian vào: ' + moment(event.start).format('LLLL');
            element.css({'background-color': '#e74a3b', 'border': '1px solid #e74a3b'});
        }
        element.popover(popover);
        element.find('.fc-title').remove();
    },
    select: function(start, end, jsEvent, view) {
        console.log(jsEvent);
        Swal.fire({
            html: '1',
            width: "21%",
            customClass: {
                confirmButton: "btn btn-primary shadow-sm",
            },
        });
    },
});