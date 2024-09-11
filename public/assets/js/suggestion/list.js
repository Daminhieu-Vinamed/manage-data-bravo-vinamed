var listPaymentOrder = $("#suggestion").DataTable({
    ajax: {
        type: "get",
        url: linkSuggestion + "get-data" + location.search,
    },
    responsive: trueValue,
    rowReorder: trueValue,
    scrollX: trueValue,
    ordering: falseValue,
    columns: [
        { data: "BranchCode", name: "BranchCode" },
        { data: "DocNo", name: "DocNo" },
        { data: "CustomerName", name: "CustomerName" },
        { data: "EmployeeName", name: "EmployeeName" },
        { data: "TotalAmount", name: "TotalAmount" },
        { data: "DocDate", name: "DocDate" },
        { data: "_StatusTT", name: "_StatusTT" },
        { data: "action", name: "action" },
    ],
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
            $('#suggestion_wrapper').children('.row:last').remove();
            $('#suggestion_wrapper').children('.row:first').remove();
        }
    },
});

$(document).on("click", ".printed-sample", function () {
    const Id = $(this).attr("id");
    const BranchCode = $(this).attr("branch_code");
    $.ajax({
        url: linkSuggestion + "show-printed-sample",
        type: "GET",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
        data: {
            Id: Id,
            BranchCode: BranchCode
        },
        success: function (success) {
            ToastTopRight.fire({
                icon: success.status,
                title: success.msg,
            });
            listPaymentOrder.ajax.reload();
        },
        error: function (error) {
            console.log(error);
        },
    });
});