$(document).ready(function () {
    $(document).on("click", "#supplements_and_leave", function () {
        const type = $('#type').val();
        const start = $('#start').val();
        const end = $('#end').val();
        const description = $('#description').val();
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
                description: description
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

                calendar.fullCalendar("refetchEvents");
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
                    $('#type').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#validate-type-error').text('');
                    $('#type').removeClass('is-invalid').addClass('is-valid');
                }

                if (errors.start) {
                    $('#validate-start-error').text(errors.start[zeroConst]);
                    $('#start').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#validate-start-error').text('');
                    $('#start').removeClass('is-invalid').addClass('is-valid');
                }

                if (errors.end) {
                    $('#validate-end-error').text(errors.end[zeroConst]);
                    $('#end').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#validate-end-error').text('');
                    $('#end').removeClass('is-invalid').addClass('is-valid');
                }

                if (errors.description) {
                    $('#validate-description-error').text(errors.description[zeroConst]);
                    $('#description').removeClass('is-valid').addClass('is-invalid');
                } else {
                    $('#validate-description-error').text('');
                    $('#description').removeClass('is-invalid').addClass('is-valid');
                }
            },
        });
    });
});