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
    nowIndicator: trueValue,
    displayEventEnd: trueValue,
    selectable: trueValue,
    navLinks: trueValue,
    weekNumbers: trueValue,
    eventLimit: trueValue,
    eventLimitClick: 'popover',
    editable: trueValue,
    eventRender: function (event, element, view) {
        var popover = {
            title: 'CHI TIẾT THỜI GIAN',
            trigger: 'hover',
            placement: 'top',
            container: 'body',
            html: trueValue
        }
        // if (event.start == 2) {
            // popover.content = 'Thời gian vào: ' + moment(event.start).format('LLLL');
        //     element.css({'background-color': '#1cc88a', 'border': '1px solid #1cc88a'});
        // }else{
            // popover.content = 'Thời gian vào: ' + moment(event.start).format('LLLL');
            // element.css({'background-color': '#e74a3b', 'border': '1px solid #e74a3b'});
        // }
        element.css({'background-color': '#4e73df', 'border': '1px solid #4e73df'});
        popover.content = moment(event.start).format('dddd, D MMMM [năm] YYYY HH:mm:ss');
        element.popover(popover);
        element.find('.fc-title').remove();
    },
    select: function(start, end, jsEvent, view) {
        $('#additionalWork').modal('toggle');
        $('#start').val(moment(start).format('YYYY-MM-DD'));
        $('#end').val(moment(end).subtract(oneConst, 'days').format('YYYY-MM-DD'));
        $('#type').on('change', function() {
            if ($(this).children('option:selected').attr('type') === '.50') {
                if (!$('#period').length) {
                    $('#type-timekeeping').append(`<div class="form-group col-md-4" id="period">
                    <label for="period" class="form-label small">Khoảng thời gian</label>
                    <select class="form-control" id="period">
                        <option>AM</option>
                        <option>PM</option>
                    </select>
                    </div>`)
                    $('#col-type-timekeeping').removeClass('col-md-12').addClass('col-md-8');
                }
            } else {
                $('#period').remove();
                $('#col-type-timekeeping').removeClass('col-md-8').addClass('col-md-12');
            }
        });
    },
});