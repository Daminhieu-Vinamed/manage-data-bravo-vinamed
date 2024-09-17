let id = new URLSearchParams(window.location.search).get('user_id')
var listAdditionalWorkAndOnLeave = $("#additional_work_and_on_leave").DataTable({
    ajax: {
        type: "get",
        url: linkNotification + "get-data-additional-work-and-on-leave?id=" + id,
    },
    responsive: trueValue,
    rowReorder: trueValue,
    scrollX: trueValue,
    columns: [
        { data: "BranchCode", name: "BranchCode" },
        { data: "EmployeeCode", name: "EmployeeCode" },
        { data: "EmployeeName", name: "EmployeeName" },
        { data: "DeptName", name: "DeptName" },
        { data: "TimesheetTypeName", name: "TimesheetTypeName" },
        { data: "start", name: "start" },
        { data: "end", name: "end" },
        { data: "Description", name: "Description" },
        { data: "action", name: "action" },
    ],
    ordering: falseValue,
    order: {
        name: "DocDate",
        dir: "desc",
    },
    language: {
        paginate: {
            previous: '<i class="fas fa-caret-left"></i>',
            next: '<i class="fas fa-caret-right"></i>',
        },
        emptyTable: "Danh sách hiện tại đang trống",
        info: "Đang hiển thị trang _PAGE_ trên tổng _PAGES_ trang, _PAGES_ trang này có tổng _TOTAL_ bản ghi",
        lengthMenu:
            '<select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">' +
            '<option value="10">10 đề nghị</option>' +
            '<option value="20">20 đề nghị</option>' +
            '<option value="30">30 đề nghị</option>' +
            '<option value="40">40 đề nghị</option>' +
            '<option value="50">50 đề nghị</option>' +
            '<option value="-1">tất cả đề nghị</option>' +
            "</select>",
        search: "_INPUT_",
        searchPlaceholder: "Tìm kiếm",
        zeroRecords: "Dữ liệu tìm kiếm không tồn tại",
        loadingRecords: "Đang tải dữ liệu...",
    },
    initComplete: function () {
        var api = this.api();
        var len = api.page.len();
        var numRows = api.rows().count();
        if (numRows <= len) {
            $('#additional_work_and_on_leave_wrapper').children('.row:last').remove();
            $('#additional_work_and_on_leave_wrapper').children('.row:first').remove();
        }
    },
});

$(document).on("click", "#approve", function () {
    const RowId = $(this).attr('RowId');
    const DocCode = $(this).attr('DocCode');
    const BranchCode = $(this).attr('BranchCode');
    Swal.fire({
        showCancelButton: trueValue,
        showLoaderOnConfirm: trueValue,
        buttonsStyling: falseValue,
        confirmButtonText: 'Phê duyệt',
        cancelButtonText: 'Hủy',
        width: "306px",
        html: 'Phê duyệt bổ sung/nghỉ phép ?',
        customClass: {
            confirmButton: 'btn btn-primary shadow-sm m-2',
            cancelButton: 'btn btn-danger shadow-sm m-2',
        },
        preConfirm: async () => {
            $.ajax({
                url: linkTimekeeping + "approve",
                type: "PUT",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: {
                    DocCode: DocCode,
                    RowId: RowId,
                    BranchCode: BranchCode
                },
                success: function (success) {
                    ToastTopRight.fire({
                        icon: success.status,
                        title: success.msg,
                    });
                    listAdditionalWorkAndOnLeave.ajax.reload();
                },
                error: function (error) {
                    let errors = error.responseJSON.errors;
                    ToastTopRight.fire({
                        icon: errors.status,
                        title: errors.msg,
                    });
                },
            });
        },
    });
});

$(document).on("click", "#cancel", function () {
    const RowId = $(this).attr('RowId');
    const BranchCode = $(this).attr('BranchCode');
    Swal.fire({
        showCancelButton: trueValue,
        showLoaderOnConfirm: trueValue,
        buttonsStyling: falseValue,
        confirmButtonText: 'Từ chối',
        cancelButtonText: 'Hủy',
        width: "16%",
        html: 'Từ chối bổ sung/nghỉ phép ?',
        customClass: {
            confirmButton: 'btn btn-primary shadow-sm m-2',
            cancelButton: 'btn btn-danger shadow-sm m-2',
        },
        preConfirm: async () => {
            $.ajax({
                url: linkTimekeeping + "cancel",
                type: "PUT",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: {
                    RowId: RowId,
                    BranchCode: BranchCode
                },
                success: function (success) {
                    ToastTopRight.fire({
                        icon: success.status,
                        title: success.msg,
                    });
                    listAdditionalWorkAndOnLeave.ajax.reload();
                },
                error: function (error) {
                    let errors = error.responseJSON.errors;
                    ToastTopRight.fire({
                        icon: errors.status,
                        title: errors.msg,
                    });
                },
            });
        },
    });
});