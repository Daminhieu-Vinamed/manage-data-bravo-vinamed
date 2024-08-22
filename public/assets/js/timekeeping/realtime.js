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

    $.ajax({
        url: linkTimekeeping + "get-data-timekeeping",
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (success) {
            var removeCheckTimekeeping = checkTimekeeping(success.data.start, success.data.end, success.data.now);
            $(document).on("click", "#clock_out", function () {
                clockOutApi(removeCheckTimekeeping, $(this).attr("id"))
            });
        },
        error: function (error) {
            checkTimekeeping(undefinedValue, undefinedValue, undefinedValue);
        },
    });

    $(document).on("click", "#clock_in", function () {

        changeButtonTimekeeping('clock_out');
    
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
                var runRealtimeFunc = runRealtime(zeroConst, zeroConst, zeroConst);
                
                $(document).on("click", "#clock_out", function () {
                    clockOutApi(runRealtimeFunc, $(this).attr("id"))
                });
                $("#timekeeping-in").text(success.data);
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