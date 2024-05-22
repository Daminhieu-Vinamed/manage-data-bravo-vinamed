$(document).on("click", ".cancel-payment-request", function () {
    const Stt = $(this).attr("stt");
    const BranchCode = $(this).attr("branch_code");
    Swal.fire({
        title: "Nội dung từ chối duyệt đề nghị thanh toán (bắt buộc nhập)",
        input: "textarea",
        inputAttributes: {
            autocapitalize: "off",
        },
        showCancelButton: trueValue,
        confirmButtonText: 'Gửi',
        cancelButtonText: 'Hủy',
        showLoaderOnConfirm: trueValue,
        buttonsStyling: falseValue,
        customClass: {
            confirmButton: 'btn btn-primary shadow-sm m-2',
            cancelButton: 'btn btn-danger shadow-sm m-2',
        },
        preConfirm: async (description) => {
            if (!description || description.length === zero) {
                return Swal.showValidationMessage("Chưa điền nội dung");
            }
            $.ajax({
                url: linkPaymentOrder + "cancel-payment-request",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
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
                    let notification = error.responseJSON;
                    ToastErrorCenter.fire({
                        icon: notification.status,
                        text:
                            notification.msg !== undefinedValue
                                ? notification.msg
                                : notification.responseJSON?.errors.description,
                    });
                },
            });
        },
    });
});
