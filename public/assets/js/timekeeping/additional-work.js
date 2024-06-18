$(document).ready(function () {
    $(document).on("click", "#additional_work", function () {
        const type = $('#type').val();
        const start = $('#start').val();
        const end = $('#end').val();
        const reason = $('#reason').val();
        $.ajax({
            url: linkTimekeeping + "additional-work",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
            data: {
                type: type,
                start: start,
                end: end,
                reason: reason
            },
            success: function (success) {
                ToastTopRight.fire({
                    icon: success.status,
                    title: success.msg,
                });
            },
            error: function (error) {
                if (error.responseJSON.status || error.responseJSON.msg) {
                    ToastTopRight.fire({
                        icon: error.responseJSON.status,
                        title: error.responseJSON.msg,
                    });
                }
                let errors = error.responseJSON.errors;
                errors.type ? $('#validate-type-error').text(errors.type[zeroConst]) : $('#validate-type-error').text('');
                errors.start ? $('#validate-start-error').text(errors.start[zeroConst]) : $('#validate-start-error').text('');
                errors.end ? $('#validate-end-error').text(errors.end[zeroConst]) : $('#validate-end-error').text('');
                // errors.reason ? $('#validate-reason-error').text(errors.reason[zeroConst]) : $('#validate-reason-error').text('');
            },
        });
    });
});