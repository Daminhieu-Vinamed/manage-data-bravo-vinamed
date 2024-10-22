function login(username, password) {
    $.ajax({
        url: linkOrigin + "/login",
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: {
            username: username,
            password: password,
        },
        success: function (success) {
            location.href = linkOrigin + success.url;
        },
        error: function (error) {
            let notification = error.responseJSON;
            if (notification.status !== undefinedValue && notification.msg !== undefinedValue) {
                ToastTopRight.fire({
                    icon: notification.status,
                    title: notification.msg,
                });   
            }
            notification.errors.username ? $('.username-notification').text(notification.errors.username[zero]) : $('.username-notification').text('');
            notification.errors.password ? $('.password-notification').text(notification.errors.password[zero]) : $('.password-notification').text('');
        },
    });
}
$(document).on("click", "#login", function () {
    const username = $("#username").val();
    const password = $("#password").val();
    login(username, password);
});

$(document).keypress(function (e) {
    if (e.which === 13) {
        const username = $("#username").val();
        const password = $("#password").val();
        login(username, password);
    }
});