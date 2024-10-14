$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

var calendar = $("#calendar").fullCalendar({
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'agendaWeek,month'
    },
    locale: 'vi',
    buttonText: {
        today:    'Hôm nay',
        month:    'Tháng',
        week:     'Tuần'
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

            if (event.status == "35" || event.status == "36" || event.status == "37" || event.status == "51") {
                popover.content = popover.content + '<br>' + "Trạng thái: đã duyệt"
                element.css({'background-color': '#1cc88a', 'border': '1px solid #1cc88a'});
            }else if (event.status == "19" || event.status == "50") {
                popover.content = popover.content + '<br>' + "Trạng thái: chờ duyệt"
                element.css({'background-color': '#f6c23e', 'border': '1px solid #f6c23e'});
            }else if(event.status == "9") {
                popover.content = popover.content + '<br>' + "Trạng thái: hủy duyệt"
                element.css({'background-color': '#e74a3b', 'border': '1px solid #e74a3b'});
            }

            element.find('.fc-time').remove();
            popover.title = event.type;
        }else{
            element.css({'background-color': '#4e73df', 'border': '1px solid #4e73df'});
            element.find('.fc-title').remove();
        }
        element.popover(popover);
    },

    eventAfterAllRender: function(view) {
        let dateCount = {};
        $('#calendar').fullCalendar('clientEvents').forEach(function(event) {
            if (event.title && event.status == "35" || event.status == "36" || event.status == "37" || event.status == "51") {
                if (event.start && event.end) {
                    for (let index = parseInt(event.start.format('DD')); index <= parseInt(event.end.format('DD')); index++) {
                        day = index.toString();
                        if (day.length == oneConst) {
                            day = '0' + day;
                        }
                        if (dateCount[event.start.format('YYYY-MM-' + day)]) {
                            dateCount[event.start.format('YYYY-MM-' + day)] = dateCount[event.start.format('YYYY-MM-' + day)] + parseFloat(event.workday);
                        } else {
                            dateCount[event.start.format('YYYY-MM-' + day)] = parseFloat(event.workday);
                        } 
                    }
                }else{
                    if (dateCount[event.start.format('YYYY-MM-DD')]) {
                        dateCount[event.start.format('YYYY-MM-DD')] = dateCount[event.start.format('YYYY-MM-DD')] + parseFloat(event.workday);
                    } else {
                        dateCount[event.start.format('YYYY-MM-DD')] = parseFloat(event.workday);
                    } 
                }
            } else {
                if (event.start && event.end) {
                    if (moment(event.start).format('HH:mm:ss') > clockIn || moment(event.end).format('HH:mm:ss') < clockOut) {
                        if (!dateCount[event.start.format('YYYY-MM-DD')]) {
                            dateCount[event.start.format('YYYY-MM-DD')] = zeroConst;
                        }
                    } else {
                        dateCount[event.start.format('YYYY-MM-DD')] = oneConst;
                    } 
                } else {
                    if (!dateCount[event.start.format('YYYY-MM-DD')]) {
                        dateCount[event.start.format('YYYY-MM-DD')] = zeroConst;
                    }
                } 
            }
        });
        Object.keys(dateCount).forEach(function(date) {
            let cell = $('.fc-day[data-date="' + date + '"]');
            if (cell.length) {
                if (dateCount[date] == zeroConst) {
                    cell.append('<div class="event-count" style="padding: 2px; color: red;">Công: ' + dateCount[date] + '</div>');
                } else {
                    cell.append('<div class="event-count" style="padding: 2px;">Công: ' + dateCount[date] + '</div>');   
                }
            }
        });
    },
    eventClick:  function(arg) {
        if (arg.status === "19" || arg.status === "50") {
            const RowId = arg.RowId;
            const BranchCode = arg.BranchCode;
            Swal.fire({
                showCancelButton: trueValue,
                showLoaderOnConfirm: trueValue,
                buttonsStyling: falseValue,
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy',
                width: "327px",
                html: 'Huỷ bỏ nghỉ phép/bổ sung công ?',
                customClass: {
                    confirmButton: 'btn btn-primary shadow-sm m-2',
                    cancelButton: 'btn btn-danger shadow-sm m-2',
                },
                preConfirm: async () => {
                    $.ajax({
                        url: linkTimekeeping + "cancel",
                        type: "PUT",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        data: {
                            RowId: RowId,
                            BranchCode: BranchCode
                        },
                        success: function (success) {
                            ToastTopRight.fire({
                                icon: success.status,
                                title: success.msg,
                            });
                            calendar.fullCalendar("refetchEvents");
                        },
                        error: function (error) {
                            let errors = error.responseJSON.errors;
                            ToastTopRight.fire({
                                icon: errors.status,
                                title: errors.msg,
                            });
                        },
                    });
                },
            });
        }
    },
    select: function(start, end, jsEvent, view) {
        $('#additionalWork').modal('toggle');
        $('#validate-type-error, #validate-start-error, #validate-end-error, #validate-description-error').text('');
        $('#type').removeClass().addClass('custom-select');
        $('#start, #end, #description').removeClass().addClass('form-control');
        $('#col-type-timekeeping option:first').removeAttr('disabled').removeAttr('selected').attr('selected','selected').attr('disabled','disabled');
        if ($('#period').length) {
            $('#period').remove();
            $('#col-type-timekeeping').removeClass('col-md-8').addClass('col-md-12');
        }
        $('#start').val(moment(start).format('YYYY-MM-DD'));
        $('#end').val(moment(end).subtract(oneConst, 'days').format('YYYY-MM-DD'));
        $('#description').val(nullValue);
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