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

    var removeCheckTimekeeping = checkTimekeeping($('#timekeeping-in').text(), $('#timekeeping-out').text());

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
                    clearInterval(runRealtimeFunc);
                });
                $("#timekeeping-in").text(success.clockIn);
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
        
        Swal.fire({
            showCancelButton: trueValue,
            showLoaderOnConfirm: trueValue,
            buttonsStyling: falseValue,
            confirmButtonText: 'Kết thúc',
            cancelButtonText: 'Hủy',
            width: "27%",
            html: 'Kết thúc chấm công ?',
            customClass: {
                confirmButton: 'btn btn-primary shadow-sm m-2',
                cancelButton: 'btn btn-danger shadow-sm m-2',
            },
            preConfirm: async () => {
                changeButtonTimekeeping($(this).attr("id"));

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
                        clearInterval(removeCheckTimekeeping);
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
    });
});