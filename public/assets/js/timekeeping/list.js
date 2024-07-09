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
    weekends: falseValue,
    eventRender: function (event, element, view) {
        var popover = {
            trigger: 'hover',
            placement: 'top',
            container: 'body',
            html: trueValue
        }
        if (event.title) {
            if (event.end) {
                popover.content = 'Bắt đầu: ' + moment(event.start).format('dddd, D MMMM [năm] YYYY') + '<br>' + 'Kết thúc: ' + moment(event.end).format('dddd, D MMMM [năm] YYYY');
            }else{
                popover.content = moment(event.start).format('dddd, D MMMM [năm] YYYY');
            }

            if (event.status === "35" || event.status === "36" || event.status === "37" || event.status === "51") {
                popover.content = popover.content + '<br>' + "Trạng thái: đã duyệt"
                element.css({'background-color': '#1cc88a', 'border': '1px solid #1cc88a'});
            }else if (event.status === "19" || event.status === "50") {
                popover.content = popover.content + '<br>' + "Trạng thái: chờ duyệt"
                element.css({'background-color': '#f6c23e', 'border': '1px solid #f6c23e'});
            }else if(event.status === "9") {
                popover.content = popover.content + '<br>' + "Trạng thái: hủy duyệt"
                element.css({'background-color': '#e74a3b', 'border': '1px solid #e74a3b'});
            }

            element.find('.fc-time').remove();
            popover.title = event.type;
        }else{
            element.css({'background-color': '#4e73df', 'border': '1px solid #4e73df'});
            popover.content = moment(event.start).format('dddd, D MMMM [năm] YYYY HH:mm');
            popover.title = 'Chi tiết thời gian';
            element.find('.fc-title').remove();
        }
        element.popover(popover);
    },
    select: function(start, end, jsEvent, view) {
        $('#additionalWork').modal('toggle');
        $('#validate-type-error, #validate-start-error, #validate-end-error').text('');
        $('#type').removeClass().addClass('custom-select');
        $('#start, #end').removeClass().addClass('form-control');
        $('#col-type-timekeeping option:first').removeAttr('disabled').removeAttr('selected').attr('selected','selected').attr('disabled','disabled');
        if ($('#period').length) {
            $('#period').remove();
            $('#col-type-timekeeping').removeClass('col-md-8').addClass('col-md-12');
        }
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