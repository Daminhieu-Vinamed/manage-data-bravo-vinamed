function displayRunRealtime(hour, minute, second) {
    var runSecond = $(".run-second").text(second < tenConst ? "0" + second : second);
    var runMinute = $(".run-minute").text(minute < tenConst ? "0" + minute : minute);
    var runHour = $(".run-hour").text(hour < tenConst ? "0" + hour : hour);
    return {
        runHour: runHour,
        runMinute: runMinute,
        runSecond: runSecond,
    }
}

function runRealtime(hour, minute, second) {
    return setInterval(function () {
        var displayTime = displayRunRealtime(hour, minute, second);
        second = second + oneConst;
        switch (trueValue) {
            case second < tenConst:
                displayTime.runSecond.text("0" + second);
                break;
            case second == sixtyConst:
                displayTime.runSecond.text("0" + second);
                minute = minute + oneConst;
                if (minute < tenConst) {
                    displayTime.runMinute.text("0" + minute);
                } else if (minute == sixtyConst) {
                    hour = hour + oneConst;
                    if (hour < tenConst) {
                        displayTime.runHour.text("0" + hour);
                    } else if (hour == 24) {
                        hour = zeroConst;
                        displayTime.runHour.text("00");
                    } else {
                        displayTime.runHour.text(hour);
                    }

                    minute = zeroConst;
                    displayTime.runMinute.text("00");
                } else {
                    displayTime.runMinute.text(minute);
                }
                second = zeroConst;
                displayTime.runSecond.text("00");
                break;
            default:
                displayTime.runSecond.text(second);
                break;
        }
    }, 1000);
}

function calculationTime(start, end) {
    var duration = moment.duration(end.diff(start));
    return {
        hour: duration.hours(), 
        minute: duration.minutes(), 
        second: duration.seconds()
    }
}

function changeButtonTimekeeping(id) {
    if (id === 'clock_out') {
        return $('#' + id).text("Chấm công").attr({
            class: "btn btn-primary shadow-sm",
            disabled: "disabled",
        }).removeAttr('id').removeAttr('time-now');
    }else if(id === 'clock_in'){
        return $('#' + id).text("Kết thúc").attr({
            class: "btn btn-danger shadow-sm",
            id: "clock_out"
        });
    }
}

function checkTimekeeping(start, end) {
    if (start !== minTime && end === minTime) {
        var getTimeNow = $('#clock_out');
        var now = moment(getTimeNow.attr('time-now'));
        getTimeNow.removeAttr('time-now');
        var calculationTimeFunc = calculationTime(moment(start, 'H:mm:ss'), now);
        var runRealtimeFunc = runRealtime(calculationTimeFunc.hour, calculationTimeFunc.minute, calculationTimeFunc.second);
        return runRealtimeFunc;
    }else if (start !== minTime && end !== minTime) {
        changeButtonTimekeeping('clock_out');
        var calculationTimeFunc = calculationTime(moment(start, 'H:mm:ss'), moment(end, 'H:mm:ss'));
        displayRunRealtime(calculationTimeFunc.hour, calculationTimeFunc.minute, calculationTimeFunc.second)
    }
}

function clockOutApi(realTime, id) {
    return Swal.fire({
        showCancelButton: trueValue,
        showLoaderOnConfirm: trueValue,
        buttonsStyling: falseValue,
        confirmButtonText: 'Kết thúc',
        cancelButtonText: 'Hủy',
        width: "16%",
        html: 'Kết thúc chấm công ?',
        customClass: {
            confirmButton: 'btn btn-primary shadow-sm m-2',
            cancelButton: 'btn btn-danger shadow-sm m-2',
        },
        preConfirm: async () => {
            changeButtonTimekeeping(id);

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
                    clearInterval(realTime);
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