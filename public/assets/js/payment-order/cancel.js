$(document).on("click", ".cancel-payment-request", function () {
    const Stt = $(this).attr("stt");
    const BranchCode = $(this).attr("branch_code");
    Swal.fire({
        title: textContentCancelPaymentOrder,
        input: "textarea",
        inputAttributes: {
            autocapitalize: "off",
        },
        showCancelButton: trueValue,
        confirmButtonText: textSend,
        cancelButtonText: textCancel,
        showLoaderOnConfirm: trueValue,
        preConfirm: async (description) => {
            if (!description || description.length === zero) {
                return Swal.showValidationMessage(textRequiredContentCancelPaymentOrder);
            }
            $.ajax({
                url: linkPaymentAdmin + "cancel-payment-request",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: {
                    Stt: Stt,
                    description: description,
                    BranchCode: BranchCode,
                },
                success: function (success) {
                    ToastTopRight.fire({
                        icon: success.status,
                        title: success.msg,
                    });
                    listPaymentOrder.ajax.reload();
                },
                error: function (error) {
                    let notification = error.responseJSON
                    ToastErrorCenter.fire({
                        icon: notification.status,
                        text: notification.msg !== undefinedValue ? notification.msg : notification.responseJSON?.errors.description
                    });
                },
            });
        },
    });
});