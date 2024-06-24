$(document).ready(function () {
    $(document).on("click", "#supplements_and_leave", function () {
        const type = $('#type').val();
        const start = $('#start').val();
        const end = $('#end').val();
        const reason = $('#reason').val();
        $.ajax({
            url: linkTimekeeping + "supplements-and-leave",
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

                $('#additionalWork').modal('hide');
                $('#validate-type-error, #validate-start-error, #validate-end-error').text('');
                $('#type').removeClass().addClass('custom-select');
                $('#start, #end').removeClass().addClass('form-control');
                $('#col-type-timekeeping option:first').removeAttr('disabled').removeAttr('selected').attr('selected','selected').attr('disabled','disabled');
                if ($('#period').length) {
                    $('#period').remove();
                    $('#col-type-timekeeping').removeClass('col-md-8').addClass('col-md-12');
                }
            },
            error: function (error) {
                if (error.responseJSON.status || error.responseJSON.msg) {
                    ToastTopRight.fire({
                        icon: error.responseJSON.status,
                        title: error.responseJSON.msg,
                    });
                }

                let errors = error.responseJSON.errors;

                if (errors.type) {
                    $('#validate-type-error').text(errors.type[zeroConst]);
                    $('#type').addClass('is-invalid');
                } else {
                    $('#validate-type-error').text('');
                    $('#type').addClass('is-valid');
                }

                if (errors.start) {
                    $('#validate-start-error').text(errors.start[zeroConst]);
                    $('#start').addClass('is-invalid');
                } else {
                    $('#validate-start-error').text('');
                    $('#start').addClass('is-valid');
                }

                if (errors.end) {
                    $('#validate-end-error').text(errors.end[zeroConst]);
                    $('#end').addClass('is-invalid');
                } else {
                    $('#validate-end-error').text('');
                    $('#end').addClass('is-valid');
                }
                // errors.reason ? $('#validate-reason-error').text(errors.reason[zeroConst]) : $('#validate-reason-error').text('');
            },
        });
    });
});