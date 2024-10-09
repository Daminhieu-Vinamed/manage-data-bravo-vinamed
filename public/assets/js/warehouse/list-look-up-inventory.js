$(document).ready(function () {
    $("#tableWarehouse").DataTable({
        pageLength : fiveConst,
        responsive: trueValue,
        rowReorder: trueValue,
        scrollX: trueValue,
        ordering: falseValue,
        drawCallback: function () {
            var api = this.api();
            var len = api.page.len();
            var numRows = api.rows().count();
            if (numRows <= len) {
                $('#' + $(this).attr('id') + '_wrapper').children('.row:last').remove();
                $('#' + $(this).attr('id') + '_wrapper').children('.row:first').remove();
            }
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
                '<option value="5">5 bản ghi</option>' +
                '<option value="10">10 bản ghi</option>' +
                '<option value="20">20 bản ghi</option>' +
                '<option value="30">30 bản ghi</option>' +
                '<option value="40">40 bản ghi</option>' +
                '<option value="-1">tất cả bản ghi</option>' +
                "</select>",
            search: "_INPUT_",
            searchPlaceholder: "Tìm kiếm",
            zeroRecords: "Dữ liệu tìm kiếm không tồn tại",
            loadingRecords: "Đang tải dữ liệu...",
        }
    })

    $('#tableWarehouse_length').appendTo('#filterWarehouse .lengthInTable');
    $('#tableWarehouse_filter').appendTo('#filterWarehouse .searchInTable');
})