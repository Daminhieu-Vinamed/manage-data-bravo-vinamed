var listUser = $("#users").DataTable({
    ajax: {
        type: "get",
        url: linkUser + "get-data",
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
        { data: "status", name: "status" },
        { data: "action", name: "action" },
        { data: "company", name: "company" },
        { data: "avatar", name: "avatar" },
        { data: "gender", name: "gender" },
        { data: "deptCode", name: "deptCode" },
        { data: "id", name: "id" },
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
            $('#users_wrapper').children('.row:last').remove();
            $('#users_wrapper').children('.row:first').remove();
        }
    },
});
