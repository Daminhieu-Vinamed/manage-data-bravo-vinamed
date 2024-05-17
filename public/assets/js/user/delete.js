$(document).on("click", ".delete_user", function () {
    const id = $(this).attr("id");
    $.ajax({
        url: linkUser + "delete",
        type: "DELETE",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        data: {
            id: id
        },
        success: function (success) {
            ToastTopRight.fire({
                icon: success.status,
                title: success.msg,
            });
            listUser.ajax.reload();
        },
        error: function (error) {
            let errors = error.responseJSON.errors;
            ToastTopRight.fire({
                icon: errors.status,
                title: errors.msg,
            });
        },
    });
})