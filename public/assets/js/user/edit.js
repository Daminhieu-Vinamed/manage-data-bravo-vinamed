$(document).on("click", ".edit_user", function () {
    const id = $(this).attr("id");
    $.ajax({
        url: linkUser + "edit",
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        data: {
            id: id
        },
        success: function (success) {
            console.log(success);
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