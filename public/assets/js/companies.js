$(document).ready(function () {
    var approvalVote = $("#dataTable").DataTable({
        ajax: {
            type: "get",
            url: "get-data",
        },
        responsive: true,
        rowReorder: true,
        scrollX: true,
        columns: [
            { data: "BranchCode", name: "BranchCode" },
            { data: "DocDate", name: "DocDate" },
            { data: "CustomerName", name: "CustomerName" },
            { data: "TotalAmount", name: "TotalAmount" },
            { data: "CurrencyCode", name: "CurrencyCode" },
            { data: "EmployeeName", name: "EmployeeName" },
            { data: "action", name: "action" },
            { data: "_StatusTT", name: "_StatusTT" },
            { data: "DocNo", name: "DocNo" },
        ],
        language: {
            paginate: {
                previous: '<i class="fas fa-caret-left"></i>',
                next: '<i class="fas fa-caret-right"></i>',
            },
            emptyTable: "Danh sách hiện tại đang trống",
            info: "Đang hiển thị trang _PAGE_ trên tổng _PAGES_ trang, _PAGES_ trang này có tổng _TOTAL_ phiếu",
            lengthMenu:
                '<select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">' +
                '<option value="10">10 phiếu trên trang</option>' +
                '<option value="20">20 phiếu trên trang</option>' +
                '<option value="30">30 phiếu trên trang</option>' +
                '<option value="40">40 phiếu trên trang</option>' +
                '<option value="50">50 phiếu trên trang</option>' +
                '<option value="-1">tất cả phiếu trên trang</option>' +
                "</select>",
            search: "_INPUT_",
            searchPlaceholder: "Tìm kiếm",
            zeroRecords: "Dữ liệu tìm kiếm không tồn tại",
            loadingRecords: "Đang tải dữ liệu...",
            info: "Đang hiển thị trang _PAGE_ trên tổng _PAGES_ trang, _PAGES_ trang này có tổng _TOTAL_ phiếu",
        },
    });

    $(document).on("click", ".approve-payment-request", function () {
        const Stt = $(this).attr("stt");
        const BranchCode = $(this).attr("branch_code");
        Swal.fire({
            title: "Nội dung duyệt phiếu",
            input: "textarea",
            inputAttributes: {
                autocapitalize: "off",
            },
            showCancelButton: true,
            confirmButtonText: "Gửi",
            cancelButtonText: "Hủy",
            showLoaderOnConfirm: true,
            preConfirm: async (description) => {
                $.ajax({
                    url: "approve-payment-request",
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
                    success: function (notification) {
                        ToastTopRight.fire({
                            icon: "success",
                            title: notification.error_correct,
                        });
                        approvalVote.ajax.reload();
                    },
                    error: function (notification) {
                        ToastErrorCenter.fire({
                            text: notification.error_incorrect,
                        });
                    },
                });
            },
        });
    });

    $(document).on("click", ".cancel-payment-request", function () {
        const Stt = $(this).attr("stt");
        const BranchCode = $(this).attr("branch_code");
        Swal.fire({
            title: "Nội dung từ chối duyệt phiếu",
            input: "textarea",
            inputAttributes: {
                autocapitalize: "off",
            },
            showCancelButton: true,
            confirmButtonText: "Gửi",
            cancelButtonText: "Hủy",
            showLoaderOnConfirm: true,
            preConfirm: async (description) => {
                if (!description || description.length === 0) {
                    return Swal.showValidationMessage('Chưa điền lý do');
                }
                $.ajax({
                    url: "cancel-payment-request",
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
                    success: function (notification) {
                        ToastTopRight.fire({
                            icon: "success",
                            title: notification.error_correct,
                        });
                        approvalVote.ajax.reload();
                    },
                    error: function (notification) {
                        ToastErrorCenter.fire({
                            text: notification.error_incorrect !== undefined ? notification.error_incorrect : notification.responseJSON?.errors.description
                        });
                    },
                });
            },
        });
    });
});
