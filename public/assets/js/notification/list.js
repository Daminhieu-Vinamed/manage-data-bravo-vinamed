$("#notification").DataTable({
    ajax: {
        type: "get",
        url: linkNotification + "get-data",
    },
    responsive: trueValue,
    rowReorder: trueValue,
    scrollX: trueValue,
    columns: [
        { data: "name", name: "name" },
        { data: "type", name: "type" },
        { data: "date", name: "date" },
        { data: "time", name: "time" },
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
            $('#notification_wrapper').children('.row:last').remove();
            $('#notification_wrapper').children('.row:first').remove();
        }
    },
});