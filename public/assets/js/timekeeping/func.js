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

function checkButtonRealtime() {
    const standardClockOut = moment($('#standard-clock-out').text(), 'H:mm:ss');
    const clockOut = moment($('#timekeeping-out').text(), 'H:mm:ss');
    const myInterval = setInterval(function () {
        var timeNow = moment();
        if (standardClockOut <= timeNow) {
            $('.clock_out').attr('id', 'clock_out').removeAttr('disabled').removeClass('clock_out');
            clearInterval(myInterval);
        }
    }, 1000);
    if (clockOut >= standardClockOut) {
        $('.clock_out').text("Chấm công").attr({
            class: "btn btn-primary shadow-sm",
            disabled: "disabled",
        }).removeAttr('id');
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
    let hour = Math.floor(duration.asHours());
    let minute = Math.floor(duration.asMinutes()) % sixtyConst;
    let second = Math.floor(duration.asSeconds()) % sixtyConst;
    return {
        hour: hour, 
        minute: minute, 
        second: second
    }
}