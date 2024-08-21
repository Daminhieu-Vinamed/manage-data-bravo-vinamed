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
            $('#timekeeping-in').text(moment(success.data.start).format('HH:mm:ss'));
            if (success.data.end) {
                $('#timekeeping-out').text(moment(success.data.end).format('HH:mm:ss'));
            }else{
                $('#timekeeping-out').text(minTime);
            }
            changeButtonTimekeeping($('#clock_in').attr("id"));
            var removeCheckTimekeeping = checkTimekeeping($('#timekeeping-in').text(), $('#timekeeping-out').text(), success.data.now);
            $(document).on("click", "#clock_out", function () {
                clockOutApi(removeCheckTimekeeping, $(this).attr("id"))
            });
        },
        error: function (error) {
            $('#timekeeping-in').text(minTime);
            $('#timekeeping-out').text(minTime);
            $(".run-second").text('00');
            $(".run-minute").text('00');
            $(".run-hour").text('00');
        },
    });

    $(document).on("click", "#clock_in", function () {

        changeButtonTimekeeping($(this).attr("id"));
    
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