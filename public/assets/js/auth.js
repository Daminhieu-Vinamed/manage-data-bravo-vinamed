$(document).on("click", "#login-admin", function () {
    const username = $("input[name='username']").val();
    const password = $("input[name='password']").val();
    $.ajax({
        url: "login",
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            username: username,
            password: password,
        },
        success: function (success) {
            ToastTopRight.fire({
                icon: success.status,
                title: success.msg,
            });
            location.href = window.location.origin + success.url
        },
        error: function (error) {
            let notification = error.responseJSON;
            ToastTopRight.fire({
                icon: notification.status,
                title: notification.msg,
            });
            notification.errors.username ? $('.username-notification').text(notification.errors.username[zero]) : $('.username-notification').text('');
            notification.errors.password ? $('.password-notification').text(notification.errors.password[zero]) : $('.password-notification').text('');
        },
    });
});