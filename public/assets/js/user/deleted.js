var listUser = $("#user_deleted").DataTable({
    ajax: {
        type: "get",
        url: linkUser + "get-data-deleted",
    },
    responsive: trueValue,
    rowReorder: trueValue,
    scrollX: trueValue,
    ordering: falseValue,
    columns: [
        { data: "EmployeeCode", name: "EmployeeCode" },
        { data: "username", name: "username" },
        { data: "name", name: "name" },
        { data: "email", name: "email" },
        { data: "role", name: "role" },
        { data: "parent_user_id", name: "parent_user_id" },
        { data: "company", name: "company" },
        { data: "deleted_at", name: "deleted_at" },
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
            '<option value="10">10 tài khoản</option>' +
            '<option value="20">20 tài khoản</option>' +
            '<option value="30">30 tài khoản</option>' +
            '<option value="40">40 tài khoản</option>' +
            '<option value="50">50 tài khoản</option>' +
            '<option value="-1">tất cả tài khoản</option>' +
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
            $('#user_deleted_wrapper').children('.row:last').remove();
            $('#user_deleted_wrapper').children('.row:first').remove();
        }
    },
});

$(document).on("click", ".restore_user", function () {
    const id = $(this).attr("id");
    $.ajax({
        url: linkUser + "restore",
        type: "POST",
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

$(document).on("click", ".destroy_user", function () {
    const id = $(this).attr("id");
    $.ajax({
        url: linkUser + "destroy",
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
