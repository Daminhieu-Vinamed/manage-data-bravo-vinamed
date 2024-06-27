function refreshModal() {
    $('#old_password').val('');
        $('#new_password').val('');
        $('#re_new_password').val('');
        $('#validate-old-password-error').text('');
        $('#validate-new-password-error').text('');
        $('#validate-re-new-password-error').text('');
}

$(document).on("click", "#change_password", function () {
    const old_password = $("#old_password").val();
    const new_password = $("#new_password").val();
    const re_new_password = $("#re_new_password").val();
    $.ajax({
        url: linkOrigin + "/change-password",
        type: "PUT",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            old_password: old_password,
            new_password: new_password,
            re_new_password: re_new_password,
        },
        success: function (success) {
            $('#changePasswordModal').modal('hide');
            ToastTopRight.fire({
                icon: success.status,
                title: success.msg,
            });
            refreshModal();
        },
        error: function (error) {
            let notification = error.responseJSON;
            notification.errors.old_password ? $('#validate-old-password-error').text(notification.errors.old_password[zero]) : $('#validate-old-password-error').text('');
            notification.errors.new_password ? $('#validate-new-password-error').text(notification.errors.new_password[zero]) : $('#validate-new-password-error').text('');
            notification.errors.re_new_password ? $('#validate-re-new-password-error').text(notification.errors.re_new_password[zero]) : $('#validate-re-new-password-error').text('');
        },
    });
});

$(document).on("click", "#close-change-password", function () {
    refreshModal();
});