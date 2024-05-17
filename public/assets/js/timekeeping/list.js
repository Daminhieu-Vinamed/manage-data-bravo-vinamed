$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    if ($('#timekeeping-in').text() !== minTime && $('#timekeeping-out').text() === minTime) {
        const start = moment($('#timekeeping-in').text(), 'H:mm:ss');
        var now = moment();
        var calculationTimeFunc = calculationTime(start, now);
        var runRealtimeFunc = runRealtime(calculationTimeFunc.hour, calculationTimeFunc.minute, calculationTimeFunc.second);
    }else if ($('#timekeeping-in').text() !== minTime && $('#timekeeping-out').text() !== minTime) {
        const start = moment($('#timekeeping-in').text(), 'H:mm:ss');
        const end = moment($('#timekeeping-out').text(), 'H:mm:ss');
        var calculationTimeFunc = calculationTime(start, end);
        displayRunRealtime(calculationTimeFunc.hour, calculationTimeFunc.minute, calculationTimeFunc.second)
    }

    checkButtonRealtime();

    var calendar = $("#calendar").fullCalendar({
        editable: true,
        events: linkTimekeeping,
        displayEventTime: true,
        displayEventEnd: true,
        editable: true,
        selectable: true,
        selectHelper: true,
        eventRender: function (event, element, view) {
            var startTime = event.start.format('h:mm A');
            if (event.end) {
                element.find('.fc-time').text(startTime + ' - ' + event.end.format('h:mm A'));
            }else{
                element.find('.fc-time').text(startTime);
                element.css({'background-color': '#e74a3b', 'border': '1px solid #e74a3b'});
            }
            element.find('.fc-event-container').remove();
            element.find('.fc-title').remove();
        },
        eventClick: function (info) {
            Swal.fire({
                html: info.title,
                width: "21%",
                customClass: {
                    confirmButton: "btn btn-primary shadow-sm",
                },
            });
        },
    });

    const d = new Date();
    $(".date-today").text(
        "Ngày " +
            d.getDate() +
            " tháng " +
            (d.getMonth() + oneConst) +
            " năm " +
            d.getFullYear()
    );

    $(document).on("click", "#clock_in", function () {
        $(this).text("Kết thúc").attr({
            class: "btn btn-danger shadow-sm clock_out",
            disabled: "disabled",
        }).removeAttr('id');

        var runRealtimeFunc = runRealtime(zeroConst, zeroConst, zeroConst);

        $.ajax({
            url: linkTimekeeping + "clock-in",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (success) {
                ToastTopRight.fire({
                    icon: success.status,
                    title: success.msg,
                });
                $(document).on("click", "#clock_out", function () {
                    clearInterval(runRealtimeFunc);
                });
                $("#timekeeping-in").text(success.clockIn);
                checkButtonRealtime();
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
    });

    $(document).on("click", "#clock_out", function () {
        $(this).text("Chấm công").attr({
            class: "btn btn-primary shadow-sm",
            disabled: "disabled",
        }).removeAttr('id');
        $.ajax({
            url: linkTimekeeping + "clock-out",
            type: "PUT",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (success) {
                ToastTopRight.fire({
                    icon: success.status,
                    title: success.msg,
                });
                $("#timekeeping-out").text(success.clockOut);
                clearInterval(runRealtimeFunc);
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
    });
});
