$(document).ready(function () {
    const d = new Date();
    $(".date-today").text(
    "Ngày " +
        d.getDate() +
        " tháng " +
        (d.getMonth() + oneConst) +
        " năm " +
        d.getFullYear()
    );

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